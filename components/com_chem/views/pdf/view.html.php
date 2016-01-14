<?php
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');


class ChemViewPdf extends JView
{

    function display($tpl = null)
    {
//        global $mainframe;
//
//        $id = JRequest::getVar('id',null,'', 'string');
//        $model = &$this->getModel();
//
//        if(is_null($id))
//            $mainframe->redirect('index.php', JText::_('Id param is mising') );
//
//        $document =& JFactory::getDocument();
//        $params = $mainframe->getParams();
//        $document->setTitle( $params->get( 'page_title' ) );
//
//        $chem = $model->getChem($id);
//
//        if($chem[0]->cat_number == null) $mainframe->redirect('index.php' );
//
//
//        $this->setLayout('jsme');
//        $this->assignRef('request', $chem);
//        $this->assignRef('params',	$params);
//        echo "<pre>";
//print_r($this); echo "</pre>"; exit;


        parent::display($tpl);
    }
}

?>