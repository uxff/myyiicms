	<!-- 导航面包屑开始 -->
	<?php $this->renderPartial('/layouts/nav',array('navs'=>$navs));?>
	<!-- 导航面包屑结束 -->
	<div id="content" class="clear">
		<div class="content_left">		
			<div class="list_box image_info clear">				
				<div class="list_body">	
					<h2><?php echo CHtml::encode($post->title);?> (<?=$page_no?>/<?=count($pics)?>张)</h2>
                  <!--来源，标签-->
					<p class="view_info">
                        <?php if ($post->copy_from):?>
						    <span><?php echo Yii::t('common','Copy From')?>： <em><a href="<?=$post->copy_url?>" target="_blank"><?=$post->copy_from?></a></em></span>
                        <?php endif;?>
						<?php $post_tags = $post->tags?explode(',',$post->tags):array(); $tags_len = count($post_tags);?>
						<?php if($tags_len > 0):?>
						<span class="tags">
							<?php $i = 1; foreach((array)$post_tags as $ptag):?>
							<em><a href="<?php echo $this->createUrl('tag/index',array('tag'=>$ptag));?>"><?php echo $ptag;?></a></em>
							<?php $i++;?>
							<?php endforeach;?>								
						</span>
						<?php endif;?>
						<span class="views"><em><?php echo $post->view_count;?></em></span>
					</p>

                  <!--内容-->
					<div class="content_info">
						<?php if($post->image_list):?>
						<div id="show_pics">
                         <?php if ($page_no > 1):?>
							<a href="<?=$this->createUrl('image/page',array('id'=>$post->id, 'page'=>$page_no-1))?>" title="上一个" id="move_prev" class="prev_btn"></a>
                         <?php endif;?>
							<ul class="clear">								
								
								<li><img  id="<?php echo "aimg_".$pic['fileId'];?>" aid="<?php echo $pic['fileId'];?>"  onclick="zoom(this, this.src, 0, 0, 0)" zoomfile="<?php echo $pic['file'];?>" alt="<?php echo $pic['desc'];?>" title="<?php echo $pic['desc'];?>" file="<?php echo $pic['file'];?>" src="<?php echo $pic['file'];?>" /></li>
								
							</ul>		
							<a href="<?=($page_no)<count($post->image_list)?$this->createUrl('image/page',array('id'=>$post->id, 'page'=>$page_no+1)):'javascript:;'?>" title="下一个" id="move_next"  class="prev_btn next_btn"></a>					
						</div>
						<div id="append_parent"></div><div id="ajaxwaitid"></div>
						<?php endif;?>
						<?php echo $post->content;?>
					</div>
                  <div class="page_info" >
                      <!-- 分页开始 -->			
                      <?php $this->renderPartial('/layouts/pager',array('pagebar'=>$pagebar));?>	
                      <!-- 分页结束 -->
                      <br>
                  </div>
					
				</div>
			</div>	
			
			
			<!-- 评论区 -->
			<iframe id="comment_iframe" scrolling="no" marginheight="0" marginwidth="0" frameborder="0" src="<?php echo $this->createUrl('comment/create', array('view_url'=>$this->_request->getUrl(),'topic_id'=>$post->id,'topic_type'=>'image'));?>"></iframe>			
		</div>
		
		<!-- 右侧内容开始 -->
		<?php $this->renderPartial('right',array('last_images'=>$last_images));?>	
		<!-- 右侧内容结束 -->		
		
	</div>
	
	<!-- 返回顶部 -->
	<a href="javascript:;" id="back_top"></a>
	<script type="text/javascript">
		$(function(){
			$(window).scroll(function(){				
				var scrollt = $(this).scrollTop(); //获取滚动后的高度 
				if(scrollt > 200){
					$("#back_top").fadeIn(200);					
				}else{		
					$("#back_top").fadeOut(200);					
				}
			});
			
			$("#back_top").click(function(){						
				$("html,body").animate({scrollTop:"0px"},200);
			});
			
			//图集左右滑动()			
			$("#show_pics li:first").show();
			var pics_num = $("#show_pics li").length;
			$("#move_prev").click(function(){
				var index = $("#show_pics li:visible").index();
				if(index > 0){
					var next = index -1;
					$("#show_pics li:eq('"+index+"')").hide();
					$("#show_pics li:eq('"+next+"')").fadeIn();
				}
			});
			$("#move_next").click(function(){
				var index = $("#show_pics li:visible").index();
				if(index < pics_num -1){
					var next = index + 1;
					$("#show_pics li:eq('"+index+"')").hide();
					$("#show_pics li:eq('"+next+"')").fadeIn();
				}					
			});

			$(".small_pics li").click(function(){
				var index = $(this).index();	
				$("#show_pics li").hide();
				$("#show_pics li:eq('"+index+"')").fadeIn();
			});				
			
		});
	</script>
	<?php if($post->image_list):?>
	<script type="text/javascript" reload="1">
		var IMGDIR = '<?php echo $this->_static_public . "/js/discuz/";?>', VERHASH = 'yii', JSPATH = '<?php echo $this->_static_public . "/js/discuz/";?>';
	    //仿discuz图片滚动放大效果
		zoomstatus = parseInt(1);
		var imagemaxwidth = '500';//控制图片初始宽度
		var aimgcount = new Array();
		var pics = new Array();		
		var count = <?php echo count($pics);?>
		<?php foreach((array) $pics as $pic):?>	
		pics.push('<?php echo $pic['fileId'];?>');
		<?php endforeach;?>	
		aimgcount[count] = pics;	
		attachimggroup(count);
		attachimgshow(count);
		var aimgfid = 0;
	</script>
	<?php endif;?>
	
			
