<?php
/**
* 
* author: xdr
* date:   2016-01-26
* cmd:    php protected/commands/index.php picset --deep=1 --dir=/data/wwwroot/myyiicms/uploads/NTUxNTY/cXHNt8_x --webroot=/data/wwwroot/myyiicms --cata=1
*/
class PicsetCommand  extends CConsoleCommand 
{
    private $configuredPicset;
    private $selectedPicset;

    public function init() {
        Yii::import('application.common.extensions.*');
        Yii::import('application.common.components.*');
        //Yii::import('application.common.extensions.wechatlib.*');
        //Yii::import('application.common.extensions.util.*');

    }

/*    
    public function run($args) {
        echo __METHOD__."\n";
    }
*/

    public function actionIndex($dir = '.', $deep = 1, $webroot = '', $cata = 0, $saveLimit = 10) {
        Yii::log('will start dir='.$dir.' deep='.$deep.' webroot='.$webroot, 'warning', __METHOD__);
        
        echo "this function at cwd=".getcwd()." target dir=$dir deep=$deep webroot=$webroot\n";

        $this->configuredPicset = array();
        $this->selectedPicset = [];
        $configuredPicset = &$this->configuredPicset;
        
        // 扫描目录结构
        $allDirs = $this->scanAllDir($dir, $deep, function ($path, $deep) use (&$configuredPicset) {
            if (basename($path) == 'config.json') {
                $configuredPicset[] = $path;
            }
            
        });

        echo 'all='.json_encode($allDirs)."\n";
        echo 'config.json from scan='.count($this->configuredPicset).' 0='.$this->configuredPicset[0]."\n";
        
        // 扫描目录结构中的图集
        $this->selectPicsetFromDir($dir, $allDirs);
        echo 'selectedPicset='.count($this->selectedPicset).' 0='.json_encode($this->selectedPicset[0])."\n";
        
        // 处理相对路径
        $picsets = [];
        $webrootLen = strlen($webroot);
        foreach ($this->selectedPicset as &$picset) {
            if ($webrootLen && substr($picset['thumb'], 0, $webrootLen) == $webroot) {
                //str_replace
                $picset['thumb'] = substr($picset['thumb'], $webrootLen);
            }
            foreach ($picset['images'] as &$imageUrl) {
                if ($webrootLen && substr($imageUrl, 0, $webrootLen) == $webroot) {
                    
                    $imageUrl = substr($imageUrl, $webrootLen);
                    //echo 'replaced image='.$imageUrl."\n";
                }
                $picset['image_list'][] = [
                    'fileId' => '',
                    'file' => $imageUrl,//str_replace
                    'thumb' => '',
                    'desc' => '',
                    'url' => '',
                ];
            }
            $picsets[] = $picset;
        }
        
        
        // 将图集入库
        if ($saveLimit > 0)
        $this->savePicsets($picsets, $cata, $saveLimit);
    }
    

    // filefunc dirfuncBefore dirfuncAfter: function($path, $deep)
    function scanAllDir($dir, $deep = 1, callable $filefunc = null, callable $dirfuncBefore = null, callable $dirfuncAfter = null)  { 
        if ($deep < 0) {
            return;
        }
        //echo "will scan $dir\n";
        
        $dirfuncBefore && call_user_func($dirfuncBefore, $dir, $deep);
        
        $listDir = array();
        // 读在更改同级目录时会有问题
        if($subdirs = scandir($dir)) { 
            foreach ($subdirs as $sub) { 
                if ($sub != '.' && $sub != '..' ) { 
                    //echo "got a sub:$dir/$sub\n";
                    if(is_file($dir.DS.$sub)) { 
                        $filefunc && call_user_func($filefunc, $dir.DS.$sub, $deep);
                        $listDir[$sub] = filesize($dir.DS.$sub); 
                    }elseif(is_dir($dir.DS.$sub)){ 
                        $listDir[$sub] = $this->scanAllDir($dir.DS.$sub, $deep-1, $filefunc, $dirfuncBefore, $dirfuncAfter); 
                    }
                    
                } 
            }
            
        }
        
        echo "dir will done: $dir\n";
        $dirfuncAfter && call_user_func($dirfuncAfter, $dir, $deep, $listDir);
        return $listDir;    
    }     
    
    function selectPicsetFromDir($dirPath, $dirItems) {
        $imageParams = [
            'title' => basename($dirPath),
            'thumb' => '',//$dirPath.DS.'thumb.jpg',
            'images' => [],
        ];
        
        // sub is thumbs dir
        if (basename($dirPath) == 'thumbs') {
            return false;
        }
        
        //$images = [];

        //echo "will go $dirPath items=".json_encode($dirItems)."\n";

        foreach ($dirItems as $subItemName=>$subItem) {
            
            // sub is dir
            if (is_array($subItem)) {
                $this->selectPicsetFromDir($dirPath.DS.$subItemName, $subItem);
                continue;
            }
            
            // sub is file, select file into picset
            $suffixs = explode('.', $subItemName);
            if (count($suffixs) > 1) {
                if (in_array(strtolower($suffixs[count($suffixs)-1]), ['jpg', 'gif', 'png', 'jpeg'])) {
                    if ($suffixs[0] == 'thumb') {
                        $imageParams['thumb'] = $dirPath.DS.$subItemName;
                    } else {
                        $imageParams['images'][] = $dirPath.DS.$subItemName;
                    }
                }
            }
            
        }
        
        if (file_exists($dirPath.DS.'config.json')) {
            $configData = json_decode(file_get_contents($dirPath.DS.'config.json'), true);
            $imageParams['title'] = $configData['title'];
        }
        
        // sub images is not empty, be selected
        if (count($imageParams['images']) > 0) {
            if (empty($imageParams['thumb'])) {
                $imageParams['images'][0];
            }
            $this->selectedPicset[] = $imageParams;
        }
    }
    
    public function savePicsets(array $picsets, $cata = 0, $limit = 10) {
        $i = 0;
        echo "all ".count($picsets)." will be saved!\n";
        foreach ($picsets as $picset) {
            
            if ($i >= $limit) {
                break;
            }

            $model = new Image();
            $model->create_time = time();
            $model->update_time = $model->create_time;
            //$model->tags = implode(',',$explodeTags);
            $model->image_list = $picset['image_list'];
            $model->title = $picset['title'];
            $model->title_second = $picset['title'];
            $model->seo_title = $model->title;
            $model->seo_description = $model->title_second;
            $model->content = '&nbsp;';
            $model->copy_from = '';
            $model->catalog_id = $cata ? $cata : 0;
            $model->attach_file = '';
            $model->attach_thumb = $picset['thumb'] ? : $picset['image_list'][0]['file'];
            $ret = $model->save();
            if (!$ret) {
                echo "save i=$i {$picset['title']} error:\n";
                $error = $model->getErrors();
                print_r($error);
            }
            
            ++$i;
            if ($i%100 == 0) {
                echo "$i saved\n";
            }
            //break;
        }
        echo "all {$i} saved.\n";
        
    }

    static public function base64url_encode( $data ){
      return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
    }

    static public function base64url_decode( $data ){
      return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
    }

    public function actionCheckdir($dir = '.', $out='filecheck.list.csv') {
        
        $csvFile = fopen($out, 'w');
        
        fputcsv($csvFile, ['md5','size','filepath']);
        $fileCount = 0;
        $byteCount = 0;

        $this->configuredPicset = array();
        $this->selectedPicset = [];
        $selectedThumbGif = [];
        
        $this->scanAllDir($dir, 100, function ($path, $deep) use (&$csvFile, &$fileCount, &$byteCount, &$selectedThumbGif) {

            if (($fileCount+1)%1000==0) {
                echo date('Y-m-d H:i:s ')."checking ".($fileCount+1).", bytes=$byteCount\n";
                fflush($csvFile);
                //unset($this->configuredPicset);
                //unset($this->selectedPicset);
            }
            
            //// will rm the thumb.gif , filesize==43
            //if (strtolower(substr($path, strlen($path)-9, 9)) == 'thumb.gif') {
            //    
            //    ++$fileCount;
            //    $fileMd5 = ''; //$fileMd5 = md5_file($path);
            //    $fileSize = filesize($path);
            //    $byteCount += $fileSize;
            //    if ($fileSize <= 43) {
            //        fputcsv($csvFile, [$fileMd5, $fileSize, $path]);
            //        //unlink($path);
            //        $selectedThumbGif[] = $path;
            //    }
            //}
            //return;

            // will calc md5 and insert into db
            $suffixs = explode('.', $path);
            if (count($suffixs) > 1) {
                if (in_array(strtolower($suffixs[count($suffixs)-1]), ['jpg', 'gif', 'png', 'jpeg'])) {
                    ++$fileCount;
                    $fileMd5 = md5_file($path);
                    $fileSize = filesize($path);
                    $byteCount += $fileSize;
                    fputcsv($csvFile, [$fileMd5, $fileSize, $path]);

                    $sql = 'insert into yii_filecheck (filepath, md5, filesize) values(?,?,?)';
                    //Yii::app()->db->createCommand($sql, array($path, $fileMd5, $fileSize))/*->bindParam()*/->execute();
                    Yii::app()->db->createCommand()->insert('yii_filecheck', [
                        'filepath' => mb_convert_encoding($path, 'utf8', 'gbk'),
                        'md5' => $fileMd5,
                        'filesize' => $fileSize,
                    ]);
                }
            }

        });
        
        echo date('Y-m-d H:i:s ')."all checked file:$fileCount byte:$byteCount"."\n";
        
        fclose($csvFile);
        
        //foreach ($selectedThumbGif as $gifFile) {
        //    unlink($gifFile);
        //}
    }
    // rename dir, make config.json; if exist config.json, return
    // php protected/commands/index.php --dir=/data/wwwroot/myyiicms
    public function actionRenamedir($dir = '.', $deep = 10) {
        
        Yii::log('will start dir='.$dir.' deep='.$deep, 'warning', __METHOD__);
        
        echo "this function at cwd=".getcwd()." target dir=$dir deep=$deep os=".PHP_OS." \n";

        $allDirs = $this->scanAllDir($dir, $deep, null, null, function ($path, $deep, $subDirs)  {
            $listDir = $subDirs;//scandir($path);

            if (count($listDir) == 0 || count($listDir) == 1 && substr($listDir[0], 0, 6) == 'thumb.') {
                echo "only one file:".json_encode($listDir)." and remove\n";
                //rmdir($path);
                return;
            }
            
            // this will change dir, you should delete this
            $title = basename($path);
            $titleFile = 'title.'.$title.'.txt';
            
            if (file_exists($path.DS.'config.json')) {
                $config = json_decode(file_get_contents($path.DS.'config.json'), true);
                if ($config['title']) {
                    echo "no need to rename because $path/config.json exist title:{$config['title']}\n";
                    return;
                }
            }
            
            file_put_contents($path.DS.$titleFile, $title);
            
            $dirBase64Name = $this->base64url_encode($title);
            $titleBasedFile = 'titlebase64.'.$dirBase64Name.'.txt';
            
            $titleUtf8 = mb_convert_encoding($title, 'utf8', 'gbk');
            file_put_contents($path.DS.'config.json', json_encode(['title'=>$titleUtf8]));
            
            file_put_contents($path.DS.$titleBasedFile, $title);
            
            rename($path, dirname($path).DS.$dirBase64Name);
        });
        

        echo 'all count='.count($allDirs)."\n";
    }
}
