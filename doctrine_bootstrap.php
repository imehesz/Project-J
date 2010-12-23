<?php
		/**
		 * Bootstrap Doctrine.php, register autoloader specify
		 * configuration attributes and load models.
		 */

		require_once(dirname(__FILE__) . '/protected/vendors/doctrine/Doctrine.php');
		$config = require_once(dirname(__FILE__) . '/protected/config/development.php');

		spl_autoload_register(array('Doctrine', 'autoload'));
		$manager = Doctrine_Manager::getInstance();

		$dsn = $config['components']['db']['connectionString'];

		$dbh = new PDO($dsn);
		$conn = Doctrine_Manager::connection($dbh);

