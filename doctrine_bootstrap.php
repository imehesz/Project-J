<?php
		/**
		 * Bootstrap Doctrine.php, register autoloader specify
		 * configuration attributes and load models.
		 */

		require_once(dirname(__FILE__) . '/protected/vendors/doctrine/Doctrine.php');
		spl_autoload_register(array('Doctrine', 'autoload'));
		$manager = Doctrine_Manager::getInstance();

		$dsn = 'sqlite:' . dirname( __FILE__ ) . '/protected/data/projectj.sqlite';

		$dbh = new PDO($dsn);
		$conn = Doctrine_Manager::connection($dbh);

