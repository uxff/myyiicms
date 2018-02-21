--
--  安装必要数据
--  @author zhao jinhan <qq:326196998>
--  @date 2014年12月22日
--  @link http://www.yiifcms.com/
--  @version 1.4.1

-- 栏目 --
INSERT INTO `#@__catalog` VALUES('1','1','0','资讯','','','','','','','0','0','Y','','1379545020','1418373077');
INSERT INTO `#@__catalog` VALUES('2','1','1','社会新闻','','','','','','','2','0','Y','','1379545199','1404109846');
INSERT INTO `#@__catalog` VALUES('3','1','1','科技新闻','','','','','','','1','0','Y','','1379545248','1407122169');
INSERT INTO `#@__catalog` VALUES('4','5','0','美女','','','','','','','0','0','N','','1379545330','1394517482');
INSERT INTO `#@__catalog` VALUES('5','5','4','美女写真','','','','','','','1','0','N','','1379545388','1394517482');
INSERT INTO `#@__catalog` VALUES('6','5','4','明星图片','','','','','','','0','0','N','','1379545435','1394517482');
INSERT INTO `#@__catalog` VALUES('8','2','0','动漫','','','','','','','0','0','Y','','0','1399616730');
INSERT INTO `#@__catalog` VALUES('9','2','8','动漫图片','','','','','','','0','0','Y','','0','1399616723');
INSERT INTO `#@__catalog` VALUES('10','3','0','风景','','','','','','','0','0','Y','','1400489000','1407117706');
INSERT INTO `#@__catalog` VALUES('11','3','0','搞笑','','','','','','','0','0','Y','','1400489000','1407117706');
INSERT INTO `#@__catalog` VALUES('12','4','0','创意','','','','','','','0','0','Y','','1400828336','1407120434');

-- 导航 --
INSERT INTO `#@__menu` VALUES('1','首页','index.php','index','Y','0','0','N');
INSERT INTO `#@__menu` VALUES('2','资讯新闻','?r=post/index','post','Y','0','0','N');
INSERT INTO `#@__menu` VALUES('3','美女写真','?r=image/index','image','Y','0','0','N');
INSERT INTO `#@__menu` VALUES('4','动漫图片','?r=soft/index','soft','Y','0','0','N');
INSERT INTO `#@__menu` VALUES('5','风景壁纸','?r=video/index','video','N','0','0','N');
INSERT INTO `#@__menu` VALUES('6','搞笑内涵','?r=page/guide','guide','Y','0','6','N');
INSERT INTO `#@__menu` VALUES('7','创意奇趣','?r=question/index','question','N','0','0','N');
INSERT INTO `#@__menu` VALUES('8','讨论区','http://bbs.yiifcms.com/','bbs','Y','0','0','Y');

-- 内容模型 --
INSERT INTO `#@__model_type` VALUES('1','post','文章','Post','Y','最新最优秀的IT文章IT资讯','IT，程序员，工程师，文章，博文，资讯，最新，优秀，php，mysql，html，yii，framework，js，jquery，web，mvc，开发','聚合了优质的IT文章，无论你是前端工程师，还是后端程序员，都可以找到你想了解的知识和资讯，更多内容尽在yiifcms。');
INSERT INTO `#@__model_type` VALUES('2','image','图集','Image','Y','最新最全的热门图集、精品爆图、美图','图片，图集，最新，热门，精品，最全，美女，爆料，搞笑','展示了用户最喜爱的美女图片、爆料图片、搞笑图片，惊爆眼球，更多内容尽在yiifcms。');
INSERT INTO `#@__model_type` VALUES('3','soft','软件','Soft','Y','最新发布的yiifcms、热门手册、精品下载、建站工具','yii，cms，版本，下载，最新，热门，最全，精品，建站，工具，安全，稳定','提供了web开发人员的建站工具和yiifcms发布版本，供感兴趣的用户下载和使用，详情了解尽在yiifcms。');
INSERT INTO `#@__model_type` VALUES('4','video','视频','Video','Y','最新上映的电影、热门视频、热播电视剧、下载视频','视频，电影，微电影，电视剧，MV，MTV，最新，热门，热播，高清，下载','聚合了用户最喜爱的视频，尽在yiifcms。');
INSERT INTO `#@__model_type` VALUES('5','goods','商品','Goods','Y','ds','dd','d');

-- 第三方授权表 --
INSERT INTO `#@__oauth` VALUES('qq','QQ','{\"appid\":\"\",\"appkey\":\"\",\"callback\":\"http:\\/\\/www.yiifcms.com\\/oAuth\\/qq_callback\",\"scope\":\"get_user_info,add_t,del_t,get_info\",\"errorReport\":true,\"storageType\":\"file\"}','Y');
INSERT INTO `#@__oauth` VALUES('sinawb','新浪微博','{\"wb_akey\":\"\",\"wb_skey\":\"\",\"callback\":\"http:\\/\\/www.yiifcms.com\\/oAuth\\/sinawb_callback\"}','Y');
INSERT INTO `#@__oauth` VALUES('weixin','微信','2821796254','N');
INSERT INTO `#@__oauth` VALUES('renren','人人网','{\"app_key\":\"\",\"app_secret\":\"\",\"callback\":\"http:\\/\\/www.yiifcms.com\\/oAuth\\/renren_callback\"}','Y');

-- 网站设置 -- 
INSERT INTO `#@__setting` VALUES('base','admin_email','admin@126.com');
INSERT INTO `#@__setting` VALUES('base','admin_logger','open');
INSERT INTO `#@__setting` VALUES('base','admin_telephone','180000000');
INSERT INTO `#@__setting` VALUES('email','email_fromname','');
INSERT INTO `#@__setting` VALUES('email','email_host','');
INSERT INTO `#@__setting` VALUES('email','email_password','');
INSERT INTO `#@__setting` VALUES('email','email_port','25');
INSERT INTO `#@__setting` VALUES('email','email_timeout','2');
INSERT INTO `#@__setting` VALUES('email','email_totest','');
INSERT INTO `#@__setting` VALUES('email','email_username','');
INSERT INTO `#@__setting` VALUES('base','safe_str','!(*&%');
INSERT INTO `#@__setting` VALUES('seo','seo_description','yiifcms是基于yii框架开发的内容管理系统，功能强大，运行高效，稳定安全，是学习php和建站的良好选择。');
INSERT INTO `#@__setting` VALUES('seo','seo_keywords','yii,cms,framework,php,mysql,html,nginx,web,js,下载,手册,版本,系统');
INSERT INTO `#@__setting` VALUES('seo','seo_title','yiifcms打造顶级内容管理系统');
INSERT INTO `#@__setting` VALUES('base','site_closed_summary','系统维护中，请稍候......');
INSERT INTO `#@__setting` VALUES('base','site_copyright','Copyright @ 2014-2015');
INSERT INTO `#@__setting` VALUES('base','site_domain','/');
INSERT INTO `#@__setting` VALUES('base','site_icp','京ICP备XXXXXX号-1');
INSERT INTO `#@__setting` VALUES('base','site_name','yiifcms打造顶级内容管理系统');
INSERT INTO `#@__setting` VALUES('base','site_stats','');
INSERT INTO `#@__setting` VALUES('cache','cache_status','open');
INSERT INTO `#@__setting` VALUES('cache','cache_type','filecache');
INSERT INTO `#@__setting` VALUES('cache','setting_filecache','a:2:{s:5:\"class\";s:10:\"CFileCache\";s:14:\"directoryLevel\";s:1:\"2\";}');
INSERT INTO `#@__setting` VALUES('cache','setting_memcache','a:3:{s:5:\"class\";s:9:\"CMemCache\";s:4:\"host\";s:9:\"localhost\";s:4:\"port\";s:5:\"11211\";}');
INSERT INTO `#@__setting` VALUES('cache','setting_rediscache','a:4:{s:5:\"class\";s:21:\"ext.redis.CRedisCache\";s:4:\"host\";s:9:\"localhost\";s:4:\"port\";s:4:\"6379\";s:8:\"database\";i:0;}');
INSERT INTO `#@__setting` VALUES('base','site_status','open');
INSERT INTO `#@__setting` VALUES('base','site_status_intro','网站目前正在维护，请稍后访问，谢谢....');
INSERT INTO `#@__setting` VALUES('template','template','default');
INSERT INTO `#@__setting` VALUES('template','theme','default');
INSERT INTO `#@__setting` VALUES('upload','upload_allow_ext','jpg,gif,bmp,jpeg,png,doc,zip,rar,7z,txt,sql,pdf,chm,avi,mp4,flv,swf');
INSERT INTO `#@__setting` VALUES('upload','upload_max_size','20480');
INSERT INTO `#@__setting` VALUES('upload','upload_water_alpha','50');
INSERT INTO `#@__setting` VALUES('upload','upload_water_pic','public/watermark.png');
INSERT INTO `#@__setting` VALUES('upload','upload_water_scope','100x100');
INSERT INTO `#@__setting` VALUES('upload','upload_water_size','100x100');
INSERT INTO `#@__setting` VALUES('upload','upload_water_status','open');
INSERT INTO `#@__setting` VALUES('base','user_mail_verify','open');
INSERT INTO `#@__setting` VALUES('base','user_status','open');
INSERT INTO `#@__setting` VALUES('custom','_address','北京市朝阳区');
INSERT INTO `#@__setting` VALUES('custom','_fax','传真:XXXXXX');
INSERT INTO `#@__setting` VALUES('custom','_mobile','180000000');
INSERT INTO `#@__setting` VALUES('custom','_telephone','XXXXXXXXXXX');
INSERT INTO `#@__setting` VALUES('access','','');
INSERT INTO `#@__setting` VALUES('email','email_active','close');
INSERT INTO `#@__setting` VALUES('access','deny_register_ip','');
INSERT INTO `#@__setting` VALUES('base','encrypt','md5');
INSERT INTO `#@__setting` VALUES('access','deny_access_ip','192.168.1.1');


-- 用户组 --
INSERT INTO `#@__user_group` VALUES('1','普通用户','');
INSERT INTO `#@__user_group` VALUES('2','VIP①用户','');
INSERT INTO `#@__user_group` VALUES('3','VIP②用户','');
INSERT INTO `#@__user_group` VALUES('4','VIP④用户','');
INSERT INTO `#@__user_group` VALUES('5','VIP⑤用户','');
INSERT INTO `#@__user_group` VALUES('6','VIP⑥用户','');
INSERT INTO `#@__user_group` VALUES('7','VIP⑦用户','');
INSERT INTO `#@__user_group` VALUES('8','VIP⑧用户','');
INSERT INTO `#@__user_group` VALUES('9','网站编辑','default|login,catalog|index,menu|index,special|index,post|index,image|index,soft|index,video|index,goods|index,page|index,comment|index,reply|index,tag|index,recommendPosition|index,user|index,question|index,link|index,adPosition|index,ad|index,attach|index,modeltype|index,database|index,cache|index,maillog|index,oAuth|index');
INSERT INTO `#@__user_group` VALUES('10','系统管理员','Administrator');

