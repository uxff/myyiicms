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
        //Yii::import('application.xahoomodels.*');

    }

/*    
    public function run($args) {
        echo __METHOD__."\n";
    }
*/
    

    public function actionIndex($dir = '.', $deep = 1) {
        Yii::log('will start', 'warning', __METHOD__);
        
        echo "this function at cwd=".getcwd()." target dir=$dir\n";

        $this->configuredPicset = array();
        $this->selectedPicset = [];
        
        // 扫描目录结构
        $allDirs = $this->scanAllDir($dir, $deep);

        echo 'all='.json_encode($allDirs)."\n";
        echo 'configuredPicset='.json_encode($this->configuredPicset)."\n";
        
        // 扫描目录结构中的图集
        $this->selectPicsetFromDir($dir, $allDirs);
        echo 'selectedPicset='.json_encode($this->selectedPicset)."\n";
        
        // 将图集入库
        $this->savePicsets($this->selectedPicset);
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
                        [
                            'title' => $sub,
                            'thumb' => $dir.DS.'thumb.jpg',
                            'images' => [],
                        ];
                    }
                } 
            }
            closedir($handler); 
        } else {
            echo "bad dir handler!\n";
        }
        return $listDir;    
    }     
    
    function selectPicsetFromDir($dirPath, $dirItems) {
        $imageParams = [
            'title' => basename($dirPath),
            'thumb' => '',//$dirPath.DS.'thumb.jpg',
            'images' => [],
        ];
        
        //$images = [];

        echo "will go $dirPath items=".json_encode($dirItems)."\n";

        foreach ($dirItems as $subItemName=>$subItem) {
            
            if (is_array($subItem)) {
                $this->selectPicsetFromDir($dirPath.DS.$subItemName, $subItem);
                continue;
            }
            
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
        
        if ($imageParams['title'] == 'thumbs') {
            return false;
        }
        
        if (count($imageParams['images']) > 0) {
            $this->selectedPicset[] = $imageParams;
        }
    }
    
    public function savePicsets(array $picsets) {
        foreach ($picsets as $picset) {
            
        $model = new Image();
        $model->create_time = time();
        $model->update_time = $model->create_time;
        //$model->tags = implode(',',$explodeTags);
        $model->image_list = $picset['images'];
        $model->title = $picset['title'];
        $model->title_second = $picset['title'];
        $model->seo_title = $model->title;
        $model->seo_description = $model->title_second;
        $model->content = '&nbsp;';
        $model->copy_from = '';
        $model->attach_file = '';
        $model->attach_thumb = $picset['thumb'];
        $ret = $model->save();
        if (!$ret) {
            $error = $model->getErrors();
            print_r($error);
        }
        
        break;
        }
        
    }
}
