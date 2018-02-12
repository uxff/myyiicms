<?php if (CHtml::errorSummary($model)):?>
<table id="tips">
  <tr>
    <td><div class="erro_div"><span class="error_message"> <?php echo CHtml::errorSummary($model); ?> </span></div></td>
  </tr>
</table>
<?php endif?>
<script type="text/javascript" src="<?php echo $this->_static_public?>/js/jscolor/jscolor.js"></script>
<?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','htmlOptions'=>array('name'=>'xform','enctype'=>'multipart/form-data'))); ?>
<table class="form_table">
  <tr>
    <td class="tb_title" ><?php echo Yii::t('admin','Customer Name');?>：</td>
  </tr>
  <tr >
    <td >
    	<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128, 'class'=>'validate[required]')); ?>     
      </td>
  </tr> 
 
  <tr>
    <td class="tb_title"><?php echo Yii::t('admin','Contact Type');?>：</td>
  </tr>
  <tr >
    <td >
    <?php echo $form->dropDownList($model,'type',$model->getTypes(), array('options'=>array($model->type=>array('selected'=>true)))); ?>
     </td>
  </tr>
  <tr>
    <td class="tb_title"><?php echo Yii::t('admin','Contact Way');?>：</td>
  </tr>
  <tr >
    <td >
    	<?php echo $form->textField($model,'description',array('size'=>15,'maxlength'=>200, 'class'=>'validate[required]')); ?>     
      </td>
  </tr>
  <tr>
    <td class="tb_title"><?php echo Yii::t('admin','Sort Order');?>：</td>
  </tr>
  <tr >
    <td >
    	<?php echo $form->textField($model,'listorder',array('size'=>5,'maxlength'=>10, 'class'=>'validate[required]')); ?>     
      </td>
  </tr>
  
  <tr>
    <td class="tb_title"><?php echo Yii::t('admin','Remark');?>：</td>
  </tr>
  <tr >
    <td >
    	<?php echo $form->textField($model,'remark',array('size'=>50,'maxlength'=>10)); ?>     
     </td>
  </tr> 
  
  <tr >
    <td class="tb_title"><?php echo Yii::t('admin','Status');?>：</td>
  </tr>
  <tr >
    <td ><?php echo $form->dropDownList($model,'status',array('1'=>Yii::t('admin','Enable'), '0'=>Yii::t('admin','Disable'))); ?></td>
  </tr>
 
  <tr class="submit">
    <td colspan="2" >
      <input type="submit" name="editsubmit" value="<?php echo Yii::t('common','Submit');?>" class="button" tabindex="3" /></td>
  </tr>
</table>
<script type="text/javascript">
$(function(){
	$("#xform").validationEngine();
});
</script>
<?php $form=$this->endWidget(); ?>
<script>
function changeCatalog(ths){
	$.post("<?php echo $this->createUrl('ajax/attr2content')?>", {catalog:ths.value}, function(res){
		if(res.state == 'success'){
			$("#attr2cotnent").html(res.text);
			$("#attrArea").show();
		}else{
			$("#attrArea").hide();
			$("#attr2cotnent").html('');
		}
	},'json');
}
</script>