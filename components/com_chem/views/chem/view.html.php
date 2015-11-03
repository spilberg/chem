<?php
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');


class ChemViewChem extends JView
{
    function display($tpl = null)
    {
        global $mainframe;

        $id = JRequest::getVar('id',	0,'', 'int');

        $chemOptions = new JObject();
        $chemOptions->set('carbonLabelVisible', JRequest::getVar('carbonLabelVisible', 0, '', 'int' ));
        $chemOptions->set('cpkColoring', JRequest::getVar('cpkColoring', 1, '', 'int'));
        $chemOptions->set('implicitHydrogen', JRequest::getVar('implicitHydrogen', 'TERMINAL_AND_HETERO', '', 'string'));
        $chemOptions->set('displayMode', JREquest::getVar('displayMode', 'WIREFRAME', '' , 'string'));
        $chemOptions->set('bgrcolor', JRequest::getVar('bgrcolor', '#ffffff', '', 'string'));
        $chemOptions->set('zoomMode', JRequest::getVar('zoomMode', 'fit', '', 'string'));
        $chemOptions->set('width', JRequest::getVar('width', 300, '', 'int'));
        $chemOptions->set('height', JRequest::getVar('height', 300, '', 'int'));


        $this->setLayout('jsme');

        $db 	  =& JFactory::getDBO();
        $document =& JFactory::getDocument();
        $pathway  =& $mainframe->getPathway();

        // Adds parameter handling
        $params = $mainframe->getParams();

        //Set page title information
        $menus	= &JSite::getMenu();
        $menu	= $menus->getActive();

       // $params->set('page_title','Chem');
        $document->setTitle( $params->get( 'page_title' ) );

        $params->def( 'show_page_title', 1 );
        //$params->def( 'page_title', 'Chem Title' );


        $where = ($id!==0) ? ' where id='.$id : '';

        $query = 'SELECT * '
            . ' FROM #__chem a'
            . $where;
        $db->setQuery( $query );
        $chem = $db->loadObjectList();

        $this->assignRef('request', $chem);
        $this->assignRef('params',	$params);
        $this->assignRef('chemoptions', $chemOptions);

        parent::display($tpl);
    }
}

?>