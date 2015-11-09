<?php

defined( '_JEXEC' ) or die ( 'Restricted access' );


class TOOLBAR_chem
{

    function _DEFAULT() {

        JToolBarHelper::title('Chem component','molecule');

        JToolBarHelper::deleteList();
        JToolBarHelper::addNewX();
//        JToolBarHelper::custom('config', 'config.png', 'config_f2.png', 'Settings', false, false);
        JToolBarHelper::preferences('com_chem', '500');
    }

    function _PACKAGEDELETE() {

        JToolBarHelper::title( JText::_( 'Chem component' ) .': <small><small>[ '. JText::_( 'Package delete') .' ]</small></small>', 'molecule' );


//        JToolBarHelper::deleteList();
        JToolBarHelper::custom('deletepackage', 'delete.png', 'delete_f2.png', 'Delete Package', false, false);
      //  JToolBarHelper::addNewX();
//        JToolBarHelper::custom('config', 'config.png', 'config_f2.png', 'Settings', false, false);
      //  JToolBarHelper::preferences('com_chem', '500');

        JToolBarHelper::cancel( 'cancel', 'Close' );
    }


    function _EDIT($edit) {
    //    $cid = JRequest::getVar( 'cid', array(0), '', 'array' );

        $text = ( $edit ? JText::_( 'Edit molecule' ) : JText::_( 'New molecule' ) );

        JToolBarHelper::title( JText::_( 'Chem component' ) .': <small><small>[ '. $text .' ]</small></small>', 'molecule' );


        //JToolBarHelper::custom( 'save2new', 'new.png', 'new_f2.png', 'Save & New', false,  false );
        //JToolBarHelper::custom( 'save2copy', 'copy.png', 'copy_f2.png', 'Save To Copy', false,  false );
        JToolBarHelper::save();
        JToolBarHelper::apply();
        if ( $edit ) {
            // for existing items the button is renamed `close`
            JToolBarHelper::cancel( 'cancel', 'Close' );
        } else {
            JToolBarHelper::cancel();
        }
//        JToolBarHelper::help( 'screen.contactmanager.edit' );
    }


}