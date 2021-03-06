<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TblProfiles extends Doctrine_Migration_Base
{
	private $name = 'tbl_profiles';

    public function up()
    {
		$columns = array(
					'user_id' => array(
						'type' => 'integer',
						'unsigned' => 1,
						'notnull' => 1,
						'default' => 0,
					),	
					'lastname'	=> array(
						'type'	=> 'string',
						'length'=> 50 
					),
					'firstname'	=> array(
						'type'	=> 'string',
						'length'=> 50 
					),
					'birthday'	=> array(
						'type'	=> 'date',
						'default'=> '0000-00-00'
					),
		);

		$this->createTable( $this->name, $columns );
    }

    public function down()
    {
		$this->dropTable( $this->name );
    }
}
