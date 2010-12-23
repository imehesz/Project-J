<?php
	if( isset( $_SERVER['REMOTE_ADDR'] ) ) die( 'haha' );

	require_once( 'doctrine_bootstrap.php' );

	$migration_path = dirname( __FILE__ ) . '/protected/migrations/';

	$migration = new Doctrine_Migration( $migration_path, $conn );

	if( isset( $argv[1]) && is_numeric( $argv[1] ) )
	{
			$migration->migrate( $argv[1] );
	}
	elseif( isset( $argv[1] ) )
	{
			switch( $argv[1] )
			{
					case 'create':
							if( ! isset($argv[2]) )
							{
								die( 'Missing migration name! (ie: add_user_table)' . "\r\n" );
							}

							Doctrine_Core::generateMigrationClass( $argv[2], $migration_path );
							break;
					case 'down':
							$curr = $migration->getCurrentVersion();
							$migration->migrate( $curr-1 );
							break;
					case 'up':
					default:
							$migration->migrate();
			}
	}
	else
	{
		die( 'Oops! Missing params. Try: doctrine_migrate up|down|<migration_number>' . "\r\n" );
	}

	echo 'Current migration: ' . $migration->getCurrentVersion() . "\r\n";
