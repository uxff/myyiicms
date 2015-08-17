<?php
/**
 * 客服列表
 * 
 * @author        uxff <uxff@qq.com>
 * @copyright     Copyright (c) 2014-2015. All rights reserved.
 */

class CustomerController extends Backend
{
	
	public function init(){
		parent::init();
		
	}
	
	/**
	 * !CodeTemplates.overridecomment.nonjd!
	 * @see CController::beforeAction()
	 */
	public function beforeAction($action){
		$controller = Yii::app()->getController()->id;
		$action = $action->id;
		if(!$this->checkAcl($controller.'/'.$action)){
			$this->message('error',Yii::t('common','Access Deny'),$this->createUrl('index'),'',true);
			return false;
		}
		return true;
	}
    /**
     * 首页
     *
     */
	
    public function actionIndex() {
        $model = new Customer();
        $criteria = new CDbCriteria();
        //$condition = "type = ".$this->_type;
        $type = trim( $this->_request->getParam( 'type' ) );
        $title = trim( $this->_request->getParam( 'title' ) );
        $title && $condition .= ' AND title LIKE \'%' . $title . '%\'';
        $type && $condition .= ' AND type= "' . $type . '"';
        $criteria->condition = $condition;
        $criteria->order = 't.listorder ';
        //$criteria->with = array ( 'catalog' );
        $count = $model->count( $criteria );
        $pages = new CPagination( $count );
        $pageSize = (int)$this->_request->getParam('pageSize', 20);
        $pages->pageSize = $pageSize;
        //根据goods_name,catelogId查询
        $pageParams = $this->buildCondition( $_GET, array ( 'type' , 'title') );
        $pages->params = is_array( $pageParams ) ? $pageParams : array ();
        $criteria->limit = $pages->pageSize;
        $criteria->offset = $pages->currentPage * $pages->pageSize;
        $result = $model->findAll( $criteria );

        $list = array();
        foreach ($result as $key=>$row) {
            //$result[$key]->anchor = $this->getButtonHtml($row);
            $attributes = $row->attributes;
            $attributes['anchor'] = $this->getButtonHtml($row);
            $list[] = $attributes;
        }
        $this->render( 'index', array ( 'datalist' => $list, 'pagebar' => $pages) );
    }
    protected function getButtonHtml($item) {
        $type = $item['type'];
        $html = $item['description'];
        switch ($type) {
            case 'qq':
                $html = '<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='.$item['description'].'&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:'.$item['description'].':45" alt="'.$item['title'].'" title="'.$item['title'].'"></a>';
            break;
            case 'wangwang':
                $html = '<a target="_blank" href="http://www.taobao.com/webww/ww.php?ver=3&touid='.urlencode($item['description'])
                .'&siteid=cntaobao&status=1&charset=utf-8"><img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid='.urlencode($item['description'])
                .'&site=cntaobao&s=1&charset=utf-8" alt="'.$item['title'].'" /></a>';
                break;
            case 'email':
                $html = '<a href="mailto:'.$item['description'].'"><img border=0 align=absMiddle src="'.Yii::app()->theme->baseUrl.'/styles/images/email.gif'.'"></a>
                         <a href="mailto:'.$item['description'].'">'.$item['title'].'</a>';
                break;
            case 'mobile':
                $html = $item['description'];
                break;
        }
        return $html;
    }
}