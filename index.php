<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../../yii-1.1.5.r2654/framework/yii.php';

defined( 'ENV' ) or define( 'ENV', 'development' );

if( ENV != 'prod' && ENV != 'production')
{
		error_reporting (E_ALL);
		ini_set("display_errors", 1);

		$config=dirname(__FILE__).'/protected/config/development.php';
		defined('YII_DEBUG') or define('YII_DEBUG',true);
}
else
{
		$config=dirname(__FILE__).'/protected/config/production.php';
		defined('YII_DEBUG') or define('YII_DEBUG',false);
}

// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
