<?php

defined( '_JEXEC' ) or die ( 'Restricted access' );


class TOOLBAR_chem
{

    function _DEFAULT() {
        JToolBarHelper::title( JTEXT::_('Chem component'), 'cpanel.png' );
        JToolBarHelper::deleteList();
        JToolBarHelper::addNewX();
//        JToolBarHelper::custom('config', 'config.png', 'config_f2.png', 'Settings', false, false);
        JToolBarHelper::preferences('com_chem', '500');
    }


}