<?php
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');


class ChemViewChem extends JView
{
    function display($tpl = null)
    {
        global $mainframe;

        $id = JRequest::getVar('id',null,'', 'string');
        $model = &$this->getModel();

        if(is_null($id))
            $mainframe->redirect('index.php', JText::_('Id param is mising') );

        $document =& JFactory::getDocument();
        $params = $mainframe->getParams();
        $document->setTitle( $params->get( 'page_title' ) );

        $chem = $model->getChem($id);

        $this->setLayout('jsme');
        $this->assignRef('request', $chem);
        $this->assignRef('params',	$params);

        parent::display($tpl);
    }
}

?>