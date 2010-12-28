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
		$newjob->setAttribute( 'contact_email', 'test@testamony.com');
        $newjob->setAttribute( 'company', 'Mehesz.net' );
        $newjob->setAttribute( 'position', 'Developer' );
		$newjob->validate();

		$this->assertTrue( $newjob->created_at > strtotime( '04/10/1978 20:00:00' ) );
		$this->assertTrue( $newjob->expires_at > strtotime( '04/10/1978 20:00:00' ) );

        // also the expires_at date cannot be bigger than the created_at + 30 days        
        $this->assertTrue( $newjob->expires_at < ($newjob->created_at + (60*60*24*30) + 1 ) );
		$this->assertTrue( $newjob->user_id > 0, 'Wrong `user_id` value!' );
        $this->assertTrue( $newjob->save() );
        unset( $newjob );

        // if the package type is featured we need to set the featured tag
        $newjob2 = new Job;
        $newjob2->setAttribute( 'contact_email', 'test@testamony.com' );
        $newjob2->setAttribute( 'company', 'Mehesz.net' );
        $newjob2->setAttribute( 'position', 'Developer #2' );

        $newjob2->package_type = Job::PACKAGEFEAT;
		$newjob2->validate();

        $this->assertEquals( $newjob2->featured, 1 );
        $this->assertTrue( $newjob2->save() );
	}
}
