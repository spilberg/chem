<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.model');

class ChemModelChem extends JModel{

    function getChem($catid){

        $db 	  =& JFactory::getDBO();

        $where = ' where cat_number='.$catid;

        $query = 'SELECT * '
            . ' FROM #__chem a'
            . $where;
        $db->setQuery( $query );
        $chem = $db->loadObjectList();

        return $chem;
    }
}

