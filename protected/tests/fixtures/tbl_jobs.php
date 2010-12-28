<?php

/**
 * we set a default time and we compare everything from it later
 */
$now = strtotime( '12/25/2010 18:00:00' );

defined( 'HOUR' ) or define( 'HOUR', 60*60 );
defined( 'DAY' ) or define( 'DAY', HOUR * 24 );
defined( 'DAY30' ) or define( 'DAY30', DAY * 30 );
defined( 'WEEK' ) or define( 'WEEK', DAY * 7 );
defined( 'WEEK2' ) or define( 'WEEK2', DAY * 14 );

return array(
	// simple sample, expires in a week
	'sample1'=>array(
		'user_id' => '1',
		'company' => 'Google',
		'company_link' => 'http://google.com',
		'contact_email' => 'info@google.com',
		'position'	=> 'Lead Hairdresser',
		'description'	=> 'Will lead a team of 5 ppl',
		'status' => '1',
		'logo' => 'Google logo',
		'confidential' => '0',
		'featured' => '0',
		'location' => 'Silicon Valley',
		'job_type' => 'FT;IH',
		'php_type' => 'yii',
		'created_at' => $now,
		'expires_at' => $now + WEEK,
		'package_type'	=> 7,
	),
	// expires sample(expired yesterday!)
	'sample2'=>array(
		'user_id' => '1',
		'company' => 'Facebook',
		'company_link' => 'http://facebook.com',
		'contact_email' => 'info@facebook.com',
		'position'	=> 'Hair Tester',
		'description'	=> 'The main role of a hair tester is ...',
		'status' => '1',
		'logo' => 'FB logo',
		'confidential' => '0',
		'featured' => '0',
		'location' => 'Silicon Valley',
		'job_type' => 'PT',
		'php_type' => 'yii',
		'created_at' => $now,
		'expires_at' => $now - DAY,
		'package_type'	=> 1,
	),
	// not expired, BUT now active - didn't pay!
	'sample3'=>array(
		'user_id' => '1',
		'company' => 'HP',
		'company_link' => 'http://hp.com',
		'contact_email' => 'info@hp.com',
		'position'	=>	'Highschool Stylist',
		'description'	=> 'Are you out of school? You wanna learn how to cut, prepare etc ...',
		'status' => '0',
		'logo' => 'HP logo',
		'confidential' => '0',
		'featured' => '0',
		'location' => 'Somewhere East',
		'job_type' => 'PT;FT',
		'php_type' => 'yii',
		'created_at' => $now,
		'expires_at' => $now + DAY30,
		'package_type'	=> 30,
	),
	'sample4'=>array(
		'user_id' => '1',
		'company' => 'Google',
		'company_link' => 'http://google.com',
		'contact_email' => 'info@google.com',
		'position'	=> 'Doorman',
		'description'	=> 'You have to stand at a door. Thats all.',
		'status' => '1',
		'logo' => 'Google logo',
		'confidential' => '0',
		'featured' => '0',
		'location' => 'Silicon Foley',
		'job_type' => 'FT',
		'php_type' => 'yii',
		'created_at' => $now,
		'expires_at' => $now + DAY30,
		'package_type'	=> 30,
	),

);
