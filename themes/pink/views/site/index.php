	<div id="intro">
       <!--    
		<div class="intro_title">
			<h1><?php echo $this->_setting['site_name'];?></h1>
			<p class="intro_desc"><?php echo $this->_setting['seo_description'];?></p>
		</div>
        -->
		<div class="intro_title">
           <p>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">清纯美女</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">明星写真</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">校园甜美</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">唯美系列</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">动漫图片</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">热辣美女</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">娱乐八卦</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">搞笑图片</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">乡村爱情</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">都市白领</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">自然归真</a>
                <a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>">气质女神</a>
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
       <!--
		<ul class="intro_box clear">
			<li>
				<div class="ico_one"></div>
				<h2>安全可靠</h2>
				<p>xx币是基于某某主流的区块链2.0技术实现，该技术相比上一代区块链技术更加安全可靠，并由某某基金会、某某机构监管下运行，运行机制公开透明。</p>
				<a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>" target="_blank"><?php echo Yii::t('common','Read Details')?></a>
			</li>
			<li>
				<div class="ico_one ico_two"></div>
				<h2>去中心化</h2>
				<p>xx币项目没有中心节点，所有节点平等，所有交易记录将备份在每个节点上，不依赖某中心服务器存储。没有权力机构干预，行情由市场自动调节。</p>
				<a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>" target="_blank"><?php echo Yii::t('common','Read Details')?></a>
			</li>
			<li>
				<div class="ico_one ico_three"></div>
				<h2>开放源码</h2>
				<p>xx币(xxcoin)是一个开源项目，你可以基于源码建立你的应用，也可以向开发团队贡献你的代码。</p>
				<a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>" target="_blank"><?php echo Yii::t('common','Read Details')?></a>
			</li>
			<li class="last">
				<div class="ico_one ico_four"></div>
				<h2>自由交易</h2>
				<p>任何安装xx币客户端的PC或手机，都可以成为xx币网络的节点，进行自由交易，并且手续费低廉。</p>
				<a href="<?php echo $this->createUrl('page/index', array('id'=>'feature'))?>" target="_blank"><?php echo Yii::t('common','Read Details')?></a>
			</li>
		</ul>
        -->
	</div>
	
	<!-- 首页中部banner -->
	<?php if( false && $index_mid_banner):?>	
	<a class="banner index_mid_banner" title="<?php echo $index_mid_banner->title;?>" href="<?php echo $index_mid_banner->link_url;?>" target="_blank">
		<img alt="<?php echo $index_mid_banner->title;?>" width="<?php echo $index_mid_banner->width; ?>" height="<?php echo $index_mid_banner->height;?>" src="<?php echo $index_mid_banner->image_url?$index_mid_banner->image_url:$index_mid_banner->attach_file;?>" />
	</a>
	<?php endif;?>
	
	
	<!-- 推荐图集区开始 -->
	<div class="tab_container">
		<ul class="etabs text_align_left">			
			<li class="tab"><a href="#tab_image1">性感美女</a></li>
			<li class="tab"><a href="#tab_image2">热辣美女</a></li>
		</ul>	
		
		<div class="panel_container">			
			<ul id="tab_image1" class="tab_image clear">
				<?php foreach((array)$image_new as $in):?>				
				<li>
					<a href="<?php echo $this->createUrl('image/view', array('id'=>$in->id));?>">	
						<img width="200" src="<?php echo $in->attach_thumb;?>" alt="<?php echo $in->title;?>" />
						<em class="black_bg"><span><?php echo Helper::truncate_utf8_string($in->title, 20);?></span></em>
					</a>					
				</li>
				<?php endforeach;?>
			</ul>
			<ul id="tab_image2" class="tab_image clear">
				<?php foreach((array)$image_new as $in):?>				
				<li>
					<a href="<?php echo $this->createUrl('image/view', array('id'=>$in->id));?>">	
						<img width="200" src="<?php echo $in->attach_thumb;?>" alt="<?php echo $in->title;?>" />
						<em class="black_bg"><span><?php echo Helper::truncate_utf8_string($in->title, 20);?></span></em>
					</a>					
				</li>
				<?php endforeach;?>				
			</ul>
		</div>	
	</div>
	<!-- 推荐图集区结束 -->
	
	<!-- 推荐图集区开始 -->
	<div class="tab_container">
		<ul class="etabs text_align_left">			
			<li class="tab"><a href="#tab_image1">清纯甜美</a></li>
			<li class="tab"><a href="#tab_image2">校花女神</a></li>
		</ul>	
		
		<div class="panel_container">			
			<ul id="tab_image1" class="tab_image clear">
				<?php foreach((array)$image_hot as $ih):?>
				<li>
					<a href="<?php echo $this->createUrl('image/view', array('id'=>$ih->id));?>">	
						<img width="200" src="<?php echo $ih->attach_thumb;?>" alt="<?php echo $ih->title;?>" />
						<em class="black_bg"><span><?php echo Helper::truncate_utf8_string($ih->title, 20);?></span></em>
					</a>
				</li>
				<?php endforeach;?>
			</ul>
			<ul id="tab_image2" class="tab_image clear">
				<?php foreach((array)$image_hot as $ih):?>
				<li>
					<a href="<?php echo $this->createUrl('image/view', array('id'=>$ih->id));?>">	
						<img width="200" src="<?php echo $ih->attach_thumb;?>" alt="<?php echo $ih->title;?>" />
						<em class="black_bg"><span><?php echo Helper::truncate_utf8_string($ih->title, 20);?></span></em>
					</a>					
				</li>
				<?php endforeach;?>			
			</ul>
		</div>	
	</div>
	<!-- 推荐图集区结束 -->
	
	<!-- 推荐图集区开始 -->
	<div class="tab_container">
		<ul class="etabs text_align_left">			
			<li class="tab"><a href="#tab_image1">明星写真</a></li>
			<li class="tab"><a href="#tab_image2">时尚伊人</a></li>
		</ul>	
		
		<div class="panel_container">			
			<ul id="tab_image1" class="tab_image clear">
				<?php foreach((array)$image_hot as $ih):?>				
				<li>
					<a href="<?php echo $this->createUrl('image/view', array('id'=>$ih->id));?>">	
						<img width="200" src="<?php echo $ih->attach_thumb;?>" alt="<?php echo $ih->title;?>" />
						<em class="black_bg"><span><?php echo Helper::truncate_utf8_string($ih->title, 20);?></span></em>
					</a>					
				</li>
				<?php endforeach;?>			
			</ul>
			<ul id="tab_image2" class="tab_image clear">
				<?php foreach((array)$image_hot as $ih):?>				
				<li>
					<a href="<?php echo $this->createUrl('image/view', array('id'=>$ih->id));?>">	
						<img width="200" src="<?php echo $ih->attach_thumb;?>" alt="<?php echo $ih->title;?>" />
						<em class="black_bg"><span><?php echo Helper::truncate_utf8_string($ih->title, 20);?></span></em>
					</a>					
				</li>
				<?php endforeach;?>			
			</ul>
		</div>	
	</div>
	<!-- 推荐图集区结束 -->
	
	<!-- 推荐图集区开始 -->
	<div class="tab_container">
		<ul class="etabs text_align_left">			
			<li class="tab"><a href="#tab_image1">动漫图片</a></li>
			<li class="tab"><a href="#tab_image2">唯美系列</a></li>
		</ul>	
		
		<div class="panel_container">			
			<ul id="tab_image1" class="tab_image clear">
				<?php foreach((array)$image_hot as $ih):?>				
				<li>
					<a href="<?php echo $this->createUrl('image/view', array('id'=>$ih->id));?>">	
						<img width="200" src="<?php echo $ih->attach_thumb;?>" alt="<?php echo $ih->title;?>" />
						<em class="black_bg"><span><?php echo Helper::truncate_utf8_string($ih->title, 20);?></span></em>
					</a>					
				</li>
				<?php endforeach;?>			
			</ul>
			<ul id="tab_image2" class="tab_image clear">
				<?php foreach((array)$image_hot as $ih):?>				
				<li>
					<a href="<?php echo $this->createUrl('image/view', array('id'=>$ih->id));?>">	
						<img width="200" src="<?php echo $ih->attach_thumb;?>" alt="<?php echo $ih->title;?>" />
						<em class="black_bg"><span><?php echo Helper::truncate_utf8_string($ih->title, 20);?></span></em>
					</a>					
				</li>
				<?php endforeach;?>			
			</ul>
		</div>	
	</div>
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
	
	<!-- 推荐下载区开始 -->
	<div class="tab_container">
		<ul class="etabs text_align_left">
			<li class="tab"><a href="#tab_soft1">最新下载</a></li>
			<li class="tab"><a href="#tab_soft2">热门下载</a></li>		
		</ul>	
		
		<div class="panel_container">
			<ul id="tab_soft1" class="tab_soft clear">
				<?php foreach((array)$soft_new as $sn):?>
				<li>
					<a href="<?php echo $this->createUrl('soft/view', array('id'=>$sn->id));?>" title="<?php echo $sn->title;?>">
						<img class="dl_img" alt="<?php echo $sn->title;?>" src="<?php echo $sn->soft_icon;?>" width="70" height="70"/>											
					</a>		
					<a href="<?php echo $this->createUrl('soft/view', array('id'=>$sn->id));?>"><?php echo Helper::truncate_utf8_string($sn->title, 4);?></a>
					<a href="<?php echo $this->createUrl('soft/download', array('id'=>$sn->id));?>" class="dl_btn" target="_blank">下载</a>			
				</li>
				<?php endforeach;?>				
			</ul>	
			
			<ul id="tab_soft2" class="tab_soft clear">
				<?php foreach((array)$soft_hot as $sh):?>
				<li>
					<a href="<?php echo $this->createUrl('soft/view', array('id'=>$sh->id));?>" title="<?php echo $sh->title;?>">
						<img class="dl_img" alt="<?php echo $sh->title;?>" src="<?php echo $sh->soft_icon;?>" width="70" height="70"/>											
					</a>		
					<a href="<?php echo $this->createUrl('soft/view', array('id'=>$sh->id));?>"><?php echo Helper::truncate_utf8_string($sh->title, 4);?></a>
					<a href="<?php echo $this->createUrl('soft/download', array('id'=>$sh->id));?>" class="dl_btn" target="_blank">下载</a>			
				</li>
				<?php endforeach;?>	
			</ul>		
		</div>		
	</div>
	<!-- 推荐下载区开始 -->
	
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
		<ul class="client_head clear">
			<li class="client_title">友情链接</li>
			<li class="client_line"><img width="1088" src="<?php echo $this->_stylePath;?>/images/grey_line_x.png" /></li>			
		</ul>
		
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
