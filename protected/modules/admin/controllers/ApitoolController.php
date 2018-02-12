<?php
/**
 * api 工具管理
 * 
 * @author         xdr <uxff@qq.com>
 * @copyright     Copyright (c) 2014-2015. All rights reserved.
 * 
 */
class ApitoolController extends Backend
{

    /**
     * !CodeTemplates.overridecomment.nonjd!
     * @see CController::beforeAction()
     */
    public function beforeAction($action){
    	$controller = Yii::app()->getController()->id;
    	$action = $action->id;
    	if(!$this->checkAcl($controller.'/'.$action)){
    		$this->message('error',Yii::t('common','Access Deny'),'','',true);
    		return false;
    	}
    	return true;
    }
    /**
     * !CodeTemplates.overridecomment.nonjd!
     * @see CController::beforeAction()
     */
    public function actionIndex(){
        $this->render('index', array());
    }
    /**
     * !CodeTemplates.overridecomment.nonjd!
     * @see CController::beforeAction()
     */
    public function actionIpquery(){
        $ip = $this->_request->getParam('ip');
        if ($ip) {
            //$queryUrl = 'http://'.$_SERVER['HTTP_HOST'].'/'.$_SERVER[''];
//            $this->render('ipquery', array());
            //$ret = file_get_contents('http://localhost/yiifcms');
            //$ret = Yii::app()->curl->get('http://localhost/yiifcms/README.md');
            //print_r($ret);
            $ret = Yii::app()->apitool->ipquery($ip);
            print_r($ret);
            $this->message('success', '成功提交ip:'.$ip, $this->createUrl('index'), 500);
        } else {
            $this->message('error', 'ip 参数不能为空');
        }
    }
    /**
     * !CodeTemplates.overridecomment.nonjd!
     * @see CController::beforeAction()
     */
    public function actionWeather(){
        $cityName = $this->_request->getParam('cityName');
        if (TRUE || $cityName) {
            $ret = Yii::app()->apitool->weather($cityName);
            //print_r($ret);
            $dataFmt = $this->_request->getParam('dataFmt');
            if ($dataFmt == 'json') {
                //$this->renderPartial('', $ret);
                //header('Content-type: text/json;charset=utf8');
                header('Content-Type:application/json;charset=utf8');
                //echo CJavaScript::encode($ret);
                //echo CJSON::encode($ret);
                echo json_encode($ret);
            }
            else {
                $this->message('success', '成功提交:'.$cityName, $this->createUrl('index'), 500);
            }

        } else {
            $this->message('error', 'cityName 参数不能为空');
        }
    }

}
