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

    // in this test we're gonna test the active 
    // jobs
    public function testActive()
    {
        $active_jobs = Job::model()->active()->findAll();

        // what the full count should be
        $this->assertEquals( 2, sizeof($active_jobs) );
        
        // the last object should be 4
        $latest_active = $active_jobs[1];
        $this->assertEquals( 4, $latest_active->id );
    }

    /**
     * we're gonna check for job types
     * (in the future it will be more as we grow)
     */
    public function testPhpType()
    {
        // we only gonna check for yii right now
        // TODO make this general
        $yii_jobs = Job::model()->phptype('yii')->findAll();
        $this->assertEquals( 4, sizeof( $yii_jobs ) );
    }

    /**
     * little more complex, we're gonna
     * test for the job type
     */
    public function testJobType()
    {
        $this->assertEquals( 1, sizeof(Job::model()->jobtype( JOB::INHOUSE )->active()->findAll()) );
        $this->assertEquals( 2, sizeof(Job::model()->jobtype( JOB::FULLTIME )->active()->findAll()) );
        $this->assertEquals( 0, sizeof(Job::model()->jobtype( JOB::PARTTIME )->active()->findAll()) );
        $this->assertEquals( 0, sizeof(Job::model()->jobtype( JOB::REMOTE )->active()->findAll()) );

        $this->assertEquals( 1, sizeof( Job::model()->jobtype( array( JOB::INHOUSE, JOB::FULLTIME ) )->active()->findAll() ) );
    }


	/**
	 * here we're gonna test some stuff befor validation
	 */
	public function testBeforeValidateStuff()
	{
		$newjob = new Job;
		$newjob->validate();

		$this->assertTrue( $newjob->created_at > strtotime( '04/10/1978 20:00:00' ) );
	}

	public function testAfterValidate()
	{
		$newjob = new Job;
		$newjob->setAttribute( 'contact_email', 'test@testamony.com');
		$newjob->validate();

		$this->assertTrue( $newjob->user_id > 0, 'Wrong `user_id` value!' );
	}
}
