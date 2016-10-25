<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
/** @noinspection PhpDuplicateArrayKeysInspection */
return [
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=> ['log'],

	// autoloading model and component classes
	'import'=> [
		'application.models.*',
		'application.components.*',
    ],

	'modules'=> [
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
    ],

	// application components
	'components'=> [

		'user'=> [
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
        ],

		// uncomment the following to enable URLs in path-format

		'urlManager'=> [
			'urlFormat'=>'path',
			'rules'=> [
                'post/<id:\d+>/<title:.*?>'=>'post/view',
                'posts/<tag:.*?>'=>'post/index',
                'post/update/<id:\d+>'=>'post/update',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],

		// database settings are configured in database.php
//		'db'=>require(dirname(__FILE__).'/database.php'),
        'db'=> [
            'connectionString'=>'sqlite:/home/xshadowx/www/blog/protected/data/blog.db',
            'tablePrefix'=>'tbl_',
        ],

		'errorHandler'=> [
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
        ],

		'log'=> [
			'class'=>'CLogRouter',
			'routes'=> [
				[
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
                ],
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
            ],
        ],

    ],

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=> [
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
    ],
];
