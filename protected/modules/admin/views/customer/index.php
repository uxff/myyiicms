<div id="contentHeader">
  <h3><?php echo Yii::t('admin','Customer Manage');?></h3>
  <div class="searchArea">
    <ul class="action left">
      <li><a href="<?php echo $this->createUrl('create')?>" class="actionBtn"><span><?php echo Yii::t('admin','add');?></span></a></li>
    </ul>
    <div class="search right">
      <?php $form = $this->beginWidget('CActiveForm',array('id'=>'searchForm','method'=>'get','action'=>array('index'),'htmlOptions'=>array('name'=>'xform', 'class'=>'right '))); ?>
      <select name="catalogId" id="catalogId">
        <option value="">=<?php echo Yii::t('admin','All Content');?>=</option>
      </select>
  <?php echo Yii::t('admin','Customer Name');?>
      <input id="goods_name" type="text" name="goods_name" value="" class="txt" size="15"/> 
    
      <input name="searchsubmit" type="submit"  value="<?php echo Yii::t('admin','Query');?>" class="button "/>
      <input name="searchsubmit" type="reset"  value="<?php echo Yii::t('admin','Reset');?>" class="button "/>     
      <?php $form=$this->endWidget(); ?>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#goods_name").val('<?php echo Yii::app()->request->getParam('title')?>');
	//$("#catalogId").val('<?php echo Yii::app()->request->getParam('catalogId')?>');
});
</script>
<form method="post" action="<?php echo $this->createUrl('batch')?>" name="cpform" >
<table border="0" cellpadding="0" cellspacing="0" class="content_list"> 
    <thead>
      <tr class="tb_header">
        <th width="10%">ID</th>
        <th><?php echo Yii::t('admin','Customer Name');?></th>
        <th width="8%"><?php echo Yii::t('admin','Preview');?></th>
        <th width="12%"><?php echo Yii::t('admin','Categorys');?></th>
        <th width="8%"><?php echo Yii::t('admin','Contact Way');?></th>
        <th width="15%"><?php echo Yii::t('admin','Status');?></th>
        <th width="8%"><?php echo Yii::t('admin','Sort Order');?></th>
        <th width="8%"><?php echo Yii::t('admin','Remark');?></th>
        <th><?php echo Yii::t('admin','Operate');?></th>
      </tr>
    </thead>
    <?php foreach ($datalist as $row):?>
    <?php $row = (object)$row;?>
    <tr class="tb_list" <?php if($row->status=='1'):?>style=" background:#F0F7FC"<?php endif?>>
      <td ><input type="checkbox" name="id[]" value="<?php echo $row->id?>"><?php echo $row->id?></td>
      <td ><?php echo $row->title?></td>
      <td ><?php echo $row->anchor?></td>
      <td ><?php echo $row->type?></td>
      <td><span ><?php echo $row->description?></span></td>
      <td><?php if($row->status == '1'){echo Yii::t('admin','Enable');}else{echo "<span class='red'>".Yii::t('admin','Disable')."</span>";}?></td>
      <td><?php $row->listorder?></td>
      <td ><?php echo $row->remark?></td>
      <td >
      	<a href="<?php echo  $this->createUrl('update',array('id'=>$row->id))?>"><img src="<?php echo $this->module->assetsUrl;?>/images/update.png" align="absmiddle" /></a>&nbsp;&nbsp;
      	<a href="<?php echo  $this->createUrl('batch',array('command'=>'delete','id'=>$row->id))?>" class="confirmSubmit"><img src="<?php echo $this->module->assetsUrl;?>/images/delete.png" align="absmiddle" /></a>&nbsp;&nbsp;
      </td>
    </tr>
    <?php endforeach;?>
    <tr class="operate">
      <td colspan="6">
        <div class="cuspages right">
          <?php $this->widget('CLinkPager',array('pages'=>$pagebar));?>
        </div>
        <div class="fixsel">
          <input type="checkbox" name="chkall" id="chkall" onClick="checkAll(this.form, 'id')" />
          <label for="chkall"><?php echo Yii::t('admin','Check All');?></label>
          <select name="command">
            <option><?php echo Yii::t('admin','Select Operate');?></option>
            <option value="delete"><?php echo Yii::t('admin','Delete');?></option>
          </select>
          <input id="submit_maskall" class="button confirmSubmit" type="submit" value="<?php echo Yii::t('common','Submit');?>" name="maskall" />
        </div></td>
    </tr>
  </form>
</table>

<!-- //javascript开始 -->
<script type="text/javascript">
$(function(){
	$("#xform").validationEngine();	
	//显示推荐位列表
	$("select[name='command']").change(function(){
		var value = $(this).val();
		if(value == 'commend'){
			$("#recom_list").show();
		}else{
			$("#recom_list").hide();
		}
	});
});
</script>
<!-- //javascript结束 -->
