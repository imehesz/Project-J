<?php

class JobTest extends CDbTestCase
{
	public $fixtures=array(
		'jobs'=>'Job',
	);

	public function testCreate()
	{

	}

	public function testCount()
	{
		$this->assertEquals( 4,sizeof( $this->jobs  ) );
	}
}
