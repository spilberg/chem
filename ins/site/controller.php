<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class ChemController extends JController
{
    function display()
    {
        JRequest::setVar('view', 'chem');
        parent::display();
    }

}

?>
