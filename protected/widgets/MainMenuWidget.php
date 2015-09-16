<?php
class MainMenuWidget extends CWidget
{
    public $menu = array();
    
    public function run()
    {
        $this->render('mainmenuwidget', array('menu' => $this->menu));
    }
}