<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.vendor.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'Pa55word',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
//REST AP
                'gii' => 'gii',
                'gii/<controller:\w+>' => 'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
                array('<controller>/options', 'pattern' => '<controller>', 'verb' => 'OPTIONS'),
                array('<controller>/options', 'pattern' => '<controller>/<id>', 'verb' => 'OPTIONS'),
                array('<controller>/', 'pattern' => '<controller>', 'verb' => 'GET'),
                array('<controller>/create', 'pattern' => '<controller>', 'verb' => 'POST'),
                array('<controller>/read', 'pattern' => '<controller>/<id>', 'verb' => 'GET'),
                array('<controller>/update', 'pattern' => '<controller>/<id>', 'verb' => 'PUT'),
                array('<controller>/delete', 'pattern' => '<controller>/<id>', 'verb' => 'DELETE'),
            )
        ),
        'db' => array(
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=xiaoqiaonz',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'Pa55word',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
        'session' => array(
            'sessionName' => 'WebSession',
            'class' => 'CDbHttpSession',
            'autoCreateSessionTable' => false,
            'connectionID' => 'db',
            'sessionTableName' => 'sessionTable',
            //  'useTransparentSessionID' => ($_POST['PHPSESSID']) ? true : false,
            'autoStart' => 'false',
            'cookieMode' => 'only',
            'timeout' => 2 * 3600
        )
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'diskpath' => '/work/NetBeansProjects/xiaoqiao/app/api'
    ),
);
