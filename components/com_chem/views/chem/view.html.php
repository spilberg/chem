<?php
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');


class ChemViewChem extends JView
{
    function display($tpl = null)
    {
        global $mainframe;

        $db 	  =& JFactory::getDBO();
        $document =& JFactory::getDocument();
        $pathway  =& $mainframe->getPathway();

        // Adds parameter handling
        $params = $mainframe->getParams();

        //Set page title information
        $menus	= &JSite::getMenu();
        $menu	= $menus->getActive();

        $params->set('page_title','Chem');
        $document->setTitle( $params->get( 'page_title' ) );

        $params->def( 'show_page_title', 1 );
        $params->def( 'page_title', 'Chem Title' );


        $query = 'SELECT * '
            . ' FROM #__chem a';
        $db->setQuery( $query );
        $chem = $db->loadObjectList();


        $request = "test chem";
        $this->assignRef('request', $chem);
        $this->assignRef('params',	$params);
        parent::display($tpl);
    }
}

?>