<?php
/**
 * Short description.
 * 
 * @author  CU 
 * @version 1.0
 * @package main
 */


/**
 * Short description.
 * @author     xdr xuduorui@qq.com
 * @subpackage  classes
 * @abstract    Classes defined as abstract may not be instantiated
 */
class Apitool
{
    public $apiUrl = 'http://apis.baidu.com/apistore/';
    public $apiParam = array();
    public $apiMap = array(
        'ipquery'=>array(
            'subUrl'=>'iplookupservice/iplookup',
            'apikey'=>'208148e191ba17a6297b31f18116d52a',
            'paramKeys'=> array('ip'),
            'ext'=>array(),
        ),
        'weather'=>array(
            'subUrl'=>'weatherservice/citylist',
            'apikey'=>'208148e191ba17a6297b31f18116d52a',
            'paramKeys'=> array('ip'),
            'ext'=>array(),
        ),
    );
    public function ipquery($ip) {
        $apiParam = array('ip'=>$ip);
        $apiUrl = $this->apiUrl . $this->apiMap[__FUNCTION__]['subUrl']. '?' . http_build_query($apiParam);
        //require_once('Curl.php');
        //$curl = new Curl;
        $curl = Yii::app()->curl;
        //$curl->addHeader(array('apikey', $this->apiMap['ipquery']['apikey']));
        $curl->setOption(CURLOPT_HTTPHEADER, array('apikey: '. $this->apiMap[__FUNCTION__]['apikey']));
        $ret = $curl->get($apiUrl);
        if ($ret) {
            $ret = json_decode($ret, true);
            //$ret['headers'] = $curl->getHeaders();
        }
        return $ret;
    }
    public function weather($cityName=null) {
        if ($cityName == null) {
            $ip = $_SERVER['REMOTE_ADDR'];
            if (empty($ip)) {
                return false;
            }
            $ipInfo = $this->ipquery($ip);
            $cityName = $ret['retData']['city'];
            if (empty($cityName)) {
                $cityName = '北京';
            }
        }
        $apiParam = array('cityname'=>$cityName);
        $apiUrl = $this->apiUrl . $this->apiMap[__FUNCTION__]['subUrl']. '?' . http_build_query($apiParam);
        $ret = Yii::app()->curl->setOption(CURLOPT_HTTPHEADER, array('apikey: '. $this->apiMap[__FUNCTION__]['apikey']));
        $ret = Yii::app()->curl->get($apiUrl);
        //$ret = $curl->get($apiUrl);
        if ($ret) {
            $ret = json_decode($ret, true);
            //$ret['headers'] = $curl->getHeaders();
        }
        return $ret;
    }

    public function init()
    {
        return;
    }

} // end class
