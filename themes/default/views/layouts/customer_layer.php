<div class="kefu">
<div class="keful"></div>
<div class="kefur">
	<div class="kefutop"><div class="kefucolose"></div></div>
	<div class="kefumiddle"><ul>
	<?php $tmpData 
    //= array();//x6cms_online();
    = Customer::Model()->findAll(array('order'=>'listorder, id','limit'=>10));//getList(array('limit'=>10));
    //echo '$tmpData=';print_r($tmpData);
    ?>
	<?php foreach($tmpData as $item):?>
		<?php if($item['type']=='qq'):?>
		<li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$item['description']?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?=$item['description']?>:45" alt="<?=$item['title']?>" title="<?=$item['title']?>"></a>
		<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$item['description']?>&site=qq&menu=yes"><?=$item['title']?></a></li>
		<?php endif;?>
		<?php if($item['type']=='wangwang'):?>
			<li><a target="_blank" href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?=urlencode($item['description'])?>
&siteid=cntaobao&status=1&charset=utf-8"><img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=<?=urlencode($item['description'])?>
&site=cntaobao&s=1&charset=utf-8" alt="<?=$item['title']?>" /></a></li>
		<?php endif;?>
		<?php if($item['type']=='email'):?>
			<li><a href="mailto:<?=$item['description']?>"><img border=0 align=absMiddle src="<?php echo $this->_stylePath.'/images/email.gif';?>"></a>
			 <a href="mailto:<?=$item['description']?>"><?=$item['title']?></a></li>
		<?php endif;?>
		<?php if($item['type']=='mobile'):?>
			<li><?=$item['description']?></li>
		<?php endif;?>
	<?php endforeach;?>
	<?php unset($tmpData,$item);?>
		</ul>
	</div>
	<div class="kefubottom"></div>
</div>
</div>

<!--客服弹层js-->
<script type="text/javascript" src="<?php echo $this->_stylePath;?>/js/customer.js"></script>
