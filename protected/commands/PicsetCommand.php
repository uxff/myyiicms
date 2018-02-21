<?php
/**
* 
* author: xdr
* date:   2016-01-26
* cmd:    php index.php picset index --param=val
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

    public function actionIndex($dir = '.', $deep = 1, $webroot = '', $cata = 0) {
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
        $this->savePicsets($picsets, $cata);
    }
    

    function scanAllDir($dir, $deep = 0)  { 
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
                        $listDir[$sub] = filesize($dir.DS.$sub); 
                    }elseif(is_dir($dir.DS.$sub)){ 
                        $listDir[$sub] = $this->scanAllDir($dir.DS.$sub, $deep-1); 
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
    
    public function savePicsets(array $picsets, $cata = 0) {
        $i = 0;
        echo "all ".count($picsets)." will be saved!\n";
        foreach ($picsets as $picset) {
            
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
            
            if (++$i > 10) {
                break;
            }
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
}
