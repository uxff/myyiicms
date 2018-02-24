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
        
        // 扫描目录结构
        $allDirs = $this->scanAllDir($dir, $deep);

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
        //if (false)
        $this->savePicsets($picsets, $cata, $saveLimit);
    }
    

    function scanAllDir($dir, $deep = 0, callable $filefunc = null, callable $dirfunc = null)  { 
        if ($deep < 0) {
            return;
        }
        //echo "will scan $dir\n";
        $listDir = array();
        if($handler = opendir($dir)) { 
            while (($sub = readdir($handler)) !== FALSE) { 
                if ($sub != '.' && $sub != '..' ) { 
                    //echo "got a sub:$dir/$sub\n";
                    if(is_file($dir.DS.$sub)) { 
                        if ($filefunc != null) {
                            call_user_func($filefunc, $dir.DS.$sub, $deep);
                        }
                        $listDir[$sub] = filesize($dir.DS.$sub); 
                    }elseif(is_dir($dir.DS.$sub)){ 
                        if ($dirfunc != null) {
                            call_user_func($dirfunc, $dir.DS.$sub, $deep);
                        }
                        $listDir[$sub] = $this->scanAllDir($dir.DS.$sub, $deep-1, $filefunc, $dirfunc); 
                    }else {
                        echo "cannot recognize file:$dir/$sub\n";
                    }
                    
                    if ($sub == 'config.json') {
                        $this->configuredPicset[] = $dir.DS.$sub;
                    }
                } 
            }
            closedir($handler); 
            
            if ($rotateName = false) {
                
                // this will change dir, you should delete this
                $title = basename($dir);
                $titleFile = 'title.'.$title.'.txt';
                file_put_contents($dir.DS.$titleFile, $title);
                
                $dirBase64Name = $this->base64url_encode($title);
                $titleBasedFile = 'titlebase64.'.$dirBase64Name.'.txt';
                
                $titleUtf8 = mb_convert_encoding($title, 'utf8', 'gbk');
                file_put_contents($dir.DS.'config.json', json_encode(['title'=>$titleUtf8]));
                
                file_put_contents($dir.DS.$titleBasedFile, $title);
                //file_put_contents()
                
                // write title into config.json
                
                rename($dir, dirname($dir).DS.$dirBase64Name);
            }
            
        }
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

        $this->configuredPicset = array();
        $this->selectedPicset = [];
        
        
        
        $allDirs = $this->scanAllDir($dir, 100, function ($path, $deep) use (&$csvFile, &$fileCount) {
            // file
            
            $fileMd5 = md5_file($path);
            $fileSize = filesize($path);
            fputcsv($csvFile, [$fileMd5, $fileSize, $path]);
            ++$fileCount;
            $sql = 'insert into yii_filecheck (filepath, md5, filesize) values(?,?,?)';
            //Yii::app()->db->createCommand($sql, array($path, $fileMd5, $fileSize))/*->bindParam()*/->execute();
            Yii::app()->db->createCommand()->insert('yii_filecheck', [
                'filepath' => $path,
                'md5' => $fileMd5,
                'filesize' => $fileSize,
            ]);
        });
        
        echo "all checked file:$fileCount "."\n";
        
        fclose($csvFile);
        
    }
}
