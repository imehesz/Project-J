<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addpackagetype2jobs extends Doctrine_Migration_Base
{
	private $name = 'tbl_jobs';

    public function up()
    {
		$this->addColumn($this->name, 'package_type', 'string', 5, array( 'notnull' => 1, 'default' => '1' ) );
    }

    public function down()
    {
		// TODO fix this for SQLite :/ (not supported yet!){
		$this->removeColumn( $this->name, 'package_type' );
    }

}
