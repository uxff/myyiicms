<?php
/**
 * 单页内容控制器
 *
 * @author        zhao jinhan <326196998@qq.com>
 * @copyright     Copyright (c) 2014-2015 . All rights reserved. 
 */
class PageController extends FrontBase
{	
	protected $_menu_unique;
	
 /**
  *  详情
  */
  public function actionIndex($id) {   	
  	  $page = Page::model()->find('id=:id AND status=:status' , array(':id'=>$id, ':status'=>'Y'));
      if(!$page){      	
      	throw new CHttpException(404, Yii::t('common','The requested page does not exist.'));
      }
      
      //加载css,js
      Yii::app()->clientScript->registerCssFile($this->_stylePath . "/css/page.css");
      Yii::app()->clientScript->registerScriptFile($this->_static_public . "/js/jquery/jquery.js");
      //SEO
      $this->_seoTitle = $page->seo_title?$page->seo_title:$page->title.' - '.$this->_setting['site_name'];
      $this->_seoKeywords = $page->seo_keywords;
      $this->_seoDescription = $page->seo_description;
      
      //更新浏览次数
      $page->updateCounters(array ('view_count' => 1 ), 'id=:id', array ('id' => $id ));
      
      //所有单页
      $pagelists = Page::model()->findAll('status=:status ORDER BY sort_order, id' , array(':status'=>'Y'));
      $this->_menu_unique = $id;
      
      //导航
      $navs[] = array('url'=>$this->_request->getUrl(),'name'=>$page->title);
      $this->render('index', array('page'=>$page, 'navs'=>$navs, 'pagelists'=>$pagelists));
  }

  /**
   * Short description.
   * @param   type    $varname    description
   * @return  type    description
   * @access  public or private
   * @static  makes the class property accessible without needing an instantiation of the class
   */
  public function actionShowIP($ip)
  {
      //Yii::app()->1;
		  $hello = 'hello';
	  $helllo = 'hello';
	  $hello = "hllo)";
	  $hello = sprintf('hello');
	  $hello = sprintf('echo ');

  } // end func
  public 
  /**
   * Short description.
   * @param   type    $varname    description
   * @return  type    description
   * @access  public or private
   * @static  makes the class property accessible without needing an instantiation of the class
   */
  function hello()
  {
      echo '';//echo (__CLASS__,__FUNCTION__,__METHOD__);
      __LINE__;
      sprintf('hello');//public function getAction () {};
	echo 'vim edited';
		echo 'hello';echo ('');sprintf($yes);
  } // end func
  
  function hello2 () {
	echo '	  hello '.'hello';
  }
  function hello3() {
	  echo 1;
;
  }
}
