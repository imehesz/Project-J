<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TblJobs extends Doctrine_Migration_Base
{
    private $name = 'tbl_jobs';

    public function up()
    {
        $columns = array(
            'id'    => array(
                    'type'      => 'integer',
                    'unsigned'  => 1,
                    'notnull'   => 1,
                    'autoincrement'   => true,
            ),

            'user_id'   => array(
                    'type'      => 'integer',
                    'notnull'   => 1,
                    'default'   => 0,
            ),

            'company'   => array(
                    'type'   => 'string',
                    'notnull'   => 1,
                    'length'    => 100,
            ),

            'company_link'   => array(
                    'type'   => 'string',
                    'notnull'   => 1,
                    'length'    => 255,
            ),

            'contact_email'   => array(
                    'type'   => 'string',
                    'notnull'   => 1,
                    'length'    => 100,
            ),

            'status'   => array(
                    'type'      => 'integer',
                    'notnull'   => 1,
                    'default'   => 0,
            ),


            'logo'      => array(
                    'type'  => 'string',
                    'notnull'   => 1,
                    'length'    => 100,
            ),

            'confidential'  => array(
                    'type'  => 'boolean',
                    'notnull'   => 1,
                    'lentgh'    => 1,
            ),

            'featured'  => array(
                    'type'  => 'boolean',
                    'notnull'   => 1,
                    'lentgh'    => 1,
            ),

            'location'   => array(
                    'type'   => 'string',
                    'notnull'   => 1,
                    'length'    => 255,
            ),

            'company'   => array(
                    'type'   => 'string',
                    'notnull'   => 1,
                    'length'    => 100,
            ),
            
            'job_type'  => array(
                    'type'  => 'string',
                    'notnull'   => 1,
                    'length'    => 255,
            ),

            'php_type'  => array(
                    'type'      => 'string',
                    'notnull'   => 1,
                    'length'    => 20,
            ),

            'created_at'    => array(
                    'type'  => 'integer',
                    'notnull'   => 1,
                    'default'   => 0,
            ),
            
            'expires_at'    => array(
                    'type'  => 'integer',
                    'notnull'   => 1,
                    'default'   => 0,
            ),
        );

        $this->createTable( $this->name, $columns );
    }

    public function down()
    {
        $this->dropTable( $this->name );
    }
}