<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../',	
	'name' =>'yiifcms',
	'language'=>'zh_cn',
	'timeZone'=>'Asia/Shanghai',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
		'admin'=>array(
			'class' => 'application.modules.admin.AdminModule'		
		)
		
	),

	// application components
	'components'=>array(
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
				'class'=>'system.db.CDbConnection',				
				'connectionString'=>'mysql:host=127.0.0.1;port=3306;dbname=yiifcms',
				'username'=>'www',
				'password'=>'123x456',
				'emulatePrepare'=>true,  // needed by some MySQL installations
				'charset'=>'utf8',
				'tablePrefix' => 'yiif_',
		),
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(	
	),
);