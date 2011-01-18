<?php
class MainMenu extends CWidget
{
	public $menutype;
	public $activemenu;
	public $currentProject;
	public $items;

	public function run()
	{
		$this->render('mainMenu', array( 'items' => $this->items ) );
	}
}
