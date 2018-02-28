	<div id="intro">
       <!--    
		<div class="intro_title">
			<h1><?php echo $this->_setting['site_name'];?></h1>
			<p class="intro_desc"><?php echo $this->_setting['seo_description'];?></p>
		</div>
        -->
		<div class="intro_title">
            <p data-line="first line">
            <?php foreach ($image_cat2 as $k=>$image_cat):?>
                <a href="<?php echo $image_cat['redirect_url'] ? :$this->createUrl('image/index', array('catalog_id'=>$image_cat['id']))?>"><?=$image_cat['catalog_name']?></a>
            <?php endforeach;?>
            </p>
            <p>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">山东美女</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">江苏美女</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">浙江美女</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">天津美女</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">福建美女</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">广东美女</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">海南美女</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">上海美女</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">湖北美女</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">云南美女</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">四川美女</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">重庆美女</a>
            </p>
		</div>
		<!-- 首页头部banner开始 -->
		<?php if($index_top_banner):?>	
		<a class="banner index_mid_banner" title="<?php echo $index_top_banner->title;?>" href="<?php echo $index_top_banner->link_url;?>" target="_blank">
		<img alt="<?php echo $index_top_banner->title;?>" width="<?php echo $index_top_banner->width; ?>" height="<?php echo $index_top_banner->height;?>" src="<?php echo $index_top_banner->image_url?$index_top_banner->image_url:$index_top_banner->attach_file;?>" />
		</a>
		<?php endif;?>
		<!-- 首页头部banner结束 -->	
	</div>
	
	<!-- 首页中部banner -->
	<?php if( false && $index_mid_banner):?>	
	<a class="banner index_mid_banner" title="<?php echo $index_mid_banner->title;?>" href="<?php echo $index_mid_banner->link_url;?>" target="_blank">
		<img alt="<?php echo $index_mid_banner->title;?>" width="<?php echo $index_mid_banner->width; ?>" height="<?php echo $index_mid_banner->height;?>" src="<?php echo $index_mid_banner->image_url?$index_mid_banner->image_url:$index_mid_banner->attach_file;?>" />
	</a>
	<?php endif;?>
	
	
	<!-- 推荐图集区开始 -->
    <?php for ($i=0; $i<intval(count($picsets)/2); ++$i):?>
	<div class="tab_container">
		<ul class="etabs text_align_left">			
			<li class="tab"><a href="#tab_image1"><?=$image_cat2[$i*2]['catalog_name']?></a></li>
			<li class="tab"><a href="#tab_image2"><?=$image_cat2[$i*2+1]['catalog_name']?></a></li>
		</ul>	
		
		<div class="panel_container">			
			<ul id="tab_image1" class="tab_image clear">
				<?php foreach((array)$picsets[$i*2] as $in):?>				
				<li>
					<a href="<?php echo $this->createUrl('image/index', array('id'=>$in->id));?>">	
						<img src="<?php echo $in->attach_thumb;?>" style="width:auto;height:auto;max-width:200px;" alt="<?php echo $in->title;?>" />
						<em class="black_bg"><span><?php echo Helper::truncate_utf8_string($in->title, 20);?></span></em>
					</a>					
				</li>
				<?php endforeach;?>
			</ul>
			<ul id="tab_image2" class="tab_image clear">
				<?php foreach((array)$picsets[$i*2+1] as $in):?>				
				<li>
					<a href="<?php echo $this->createUrl('image/index', array('id'=>$in->id));?>">	
						<img src="<?php echo $in->attach_thumb;?>" style="width:auto;height:auto;max-width:200px;" alt="<?php echo $in->title;?>" />
						<em class="black_bg"><span><?php echo Helper::truncate_utf8_string($in->title, 20);?></span></em>
					</a>					
				</li>
				<?php endforeach;?>				
			</ul>
		</div>	
	</div>
    <?php endfor;?>
	<!-- 推荐图集区结束 -->
	

	
	<!-- 推荐阅读区开始 -->
    <!--
	<div class="tab_container">
		<ul class="etabs text_align_left">
			<li class="tab"><a href="#tab_post1">最新阅读</a></li>
			<li class="tab"><a href="#tab_post2">热门阅读</a></li>			
		</ul>	
		
		<div class="panel_container">
			<ul id="tab_post1" class="tab_post clear">
				<?php foreach((array)$news_new as $nn):?>
				<li><a href="<?php echo $this->createUrl('post/view', array('id'=>$nn->id));?>" title="<?php echo $nn->title;?>"><?php echo Helper::truncate_utf8_string($nn->title, 20);?></a></li>
				<?php endforeach;?>				
			</ul>
			
			<ul id="tab_post2" class="tab_post clear">
				<?php foreach((array)$news_hot as $nh):?>
				<li><a href="<?php echo $this->createUrl('post/view', array('id'=>$nh->id));?>" title="<?php echo $nh->title;?>"><?php echo Helper::truncate_utf8_string($nh->title, 20);?></a></li>
				<?php endforeach;?>
			</ul>			
		</div>			
	</div>
    -->
	<!-- 推荐阅读区结束 -->
	
	
	<!-- 推荐教程区开始 -->
	<?php if($video_new):?>
	<div class="tab_container">
		<ul class="etabs text_align_right">
			<li class="tab"><a href="#tab_video1">最新教程</a></li>
			<li class="tab"><a href="#tab_video2">热门教程</a></li>		
		</ul>	
		
		<div class="panel_container">
			<ul id="tab_video1" class="tab_video clear">
				<?php foreach((array)$video_new as $vn):?>
				<li>
					<a href="<?php echo $this->createUrl('video/view', array('id'=>$vn->id));?>" class="video_a">
						<img width="150" height="200" src="<?php echo $vn->cover_image;?>" />						
						<span class="v_play_mask"></span>
						<span class="v_play_icon"></span>
					</a>
					<span class="video_title"><?php echo Helper::truncate_utf8_string($vn->title, 8);?></span>
				</li>
				<?php endforeach;?>			
			</ul>	
			
			<ul id="tab_video2" class="tab_video clear">
				<?php foreach((array)$video_hot as $vh):?>
				<li>
					<a href="<?php echo $this->createUrl('video/view', array('id'=>$vh->id));?>" class="video_a">
						<img width="150" height="200" src="<?php echo $vh->cover_image;?>" />						
						<span class="v_play_mask"></span>
						<span class="v_play_icon"></span>
					</a>
					<span class="video_title"><?php echo Helper::truncate_utf8_string($vh->title, 8);?></span>
				</li>
				<?php endforeach;?>			
			</ul>		
		</div>		
	</div>
    <?php endif;?>
	<!-- 推荐教程区结束 -->
	
	
		
	<script type="text/javascript">
		$(function() {
		    $('.tab_container').easytabs();
		});
  	</script>
	
	<!-- 首页底部banner开始 -->
	<?php if($index_bottom_banner):?>	
	<a class="banner index_mid_banner" title="<?php echo $index_bottom_banner->title;?>" href="<?php echo $index_bottom_banner->link_url;?>" target="_blank">
	<img alt="<?php echo $index_bottom_banner->title;?>" width="<?php echo $index_bottom_banner->width; ?>" height="<?php echo $index_bottom_banner->height;?>" src="<?php echo $index_bottom_banner->image_url?$index_bottom_banner->image_url:$index_bottom_banner->attach_file;?>" />
	</a>
	<?php endif;?>
	<!-- 首页底部banner结束 -->	


	<div id="clients">
		<?php if($link_logos && $link_texts):?>
		<ul class="client_head clear">
			<li class="client_title">友情链接</li>
			<li class="client_line"><img width="1088" src="<?php echo $this->_stylePath;?>/images/grey_line_x.png" /></li>			
		</ul>
		<?php endif;?>
		
		<?php if($link_logos):?>
		<ul class="client_body clear">
			<?php foreach($link_logos as $lg):?>
			<li><a href="<?php echo $lg->link;?>" title="<?php echo $lg->title;?>" target="_blank"><img width="170" height="90" src="<?php echo $lg->logo;?>" /></a></li>
			<?php endforeach;?>			
		</ul>
		<?php endif;?>
		
		<?php if($link_texts):?>
		<ul class="client_foot clear">
			<?php foreach($link_texts as $lt):?>
			<li><a href="<?php echo $lt->attributes['link'];?>" title="<?php echo $lt->attributes['title'];?>" target="_blank"><?php echo $lt->title;?> </a></li>
			<?php endforeach;?>			
		</ul>
		<?php endif;?>
	</div>
