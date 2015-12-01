<?php
defined('_JEXEC') or die('Restricted access');

/*
 * Make sure the user is authorized to view this page
 */
$user = &JFactory::getUser();
//if (!$user->authorize( 'com_chem', 'manage' )) {
//    $mainframe->redirect( 'index.php', JText::_('ALERTNOTAUTH') );
//}

require_once(JApplicationHelper::getPath('admin_html'));
// Set the table directory
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_chem'.DS.'tables');

$task = JRequest::getCmd('task');
$id = JRequest::getVar('id', 0, 'get', 'int');
$cid = JRequest::getVar('cid', array(0), 'post', 'array');
$fid = JRequest::getVar('fid',array(),'post','array');
JArrayHelper::toInteger($cid, array(0));


switch ($task) {

    case 'add' :
        editMolecule(false);
        break;
    case 'edit':
        editMolecule(true);
        break;

    case 'apply':
    case 'save':
    case 'save2new':
    case 'save2copy':
        saveMolecule( $task );
        break;

    case 'remove':
        removeMolecules( $cid );
        break;

    case 'packagedelete':
        packageDelete($option);
        break;

    case 'deletepackage':
        pakageDeleteProcess();
        break;

    case 'cancel':
        cancelMolecule();
        break;

    case 'about':
        aboutComponent();
        break;

    case 'exportdb':
        exportDB();
        break;

    case 'importdb':
        importDB($option);
        break;

    case 'importdbprocess':
        importDBProcess();
        break;

    case 'listoffiles':
        listOfFiles($option);
        break;

    case 'viewlog':
        showLogFile();
        break;

    case 'delfiles':
        delFiles($fid);
        break;

    default:
        showMolecules($option);
        break;

}


/**
 * Creates a new or edits and existing user record
 * @param int The id of the record, 0 if a new entry
 * @param string The current GET/POST option
 */
function editMolecule($edit )
{
    $cid 	= JRequest::getVar('cid', array(0), '', 'array');
    $option = JRequest::getCmd('option');

    JArrayHelper::toInteger($cid, array(0));

    $row =& JTable::getInstance('chem', 'Table');
    // load the row from the db table
    if($edit)
        $row->load( $cid[0] );

//    HTML_chem::editMolecule( $row, $lists, $option, $params );
    HTML_chem::editMolecule( $row, $option );
}

/**
 * List the records
 * @param string The current GET/POST option
 */
function showMolecules($option)
{
    global $mainframe;

    $db =& JFactory::getDBO();
    $filter_order = $mainframe->getUserStateFromRequest($option . 'filter_order', 'filter_order', 'ch.id', 'cmd');
    $filter_order_Dir = $mainframe->getUserStateFromRequest($option . 'filter_order_Dir', 'filter_order_Dir', '', 'word');
//    $filter_state = $mainframe->getUserStateFromRequest($option . 'filter_state', 'filter_state', '', 'word');
//    $filter_catid = $mainframe->getUserStateFromRequest($option . 'filter_catid', 'filter_catid', 0, 'int');
    $search = $mainframe->getUserStateFromRequest($option . 'search', 'search', '', 'string');
    if (strpos($search, '"') !== false) {
        $search = str_replace(array('=', '<'), '', $search);
    }
    $search = JString::strtolower($search);

    $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
    $limitstart = $mainframe->getUserStateFromRequest($option . '.limitstart', 'limitstart', 0, 'int');

    $where = array();

    if ($search) {
        $where[] = 'ch.cat_namber LIKE ' . $db->Quote('%' . $db->getEscaped($search, true) . '%', false);
    }

    // sanitize $filter_order
    if (!in_array($filter_order, array('ch.cat_namber','ch.mol_weigh','ch.mass','ch.id'))) {
        $filter_order = 'ch.id';
    }

    if (!in_array(strtoupper($filter_order_Dir), array('ASC', 'DESC'))) {
        $filter_order_Dir = '';
    }

    $where = (count($where) ? ' WHERE ' . implode(' AND ', $where) : '');
    if ($filter_order == 'ch.id') {
        $orderby = ' ORDER BY ch.id '. ' ' .$filter_order_Dir;
    } else {
        $orderby = ' ORDER BY ' . $filter_order . ' ' . $filter_order_Dir;
    }

    // get the total number of records
    $query = 'SELECT COUNT(*)'
        . ' FROM #__chem AS ch'
        . $where;
    $db->setQuery($query);
    $total = $db->loadResult();

    jimport('joomla.html.pagination');
    $pageNav = new JPagination($total, $limitstart, $limit);

    // get the subset (based on limits) of required records
    $query = 'SELECT ch.* '
        . ' FROM #__chem AS ch'
        . $where
        . $orderby;

    $db->setQuery($query, $pageNav->limitstart, $pageNav->limit);
    $rows = $db->loadObjectList();

    // table ordering
    $lists['order_Dir'] = $filter_order_Dir;
    $lists['order'] = $filter_order;

    // search filter
    $lists['search'] = $search;

    HTML_chem::showMolecules($rows, $pageNav, $option, $lists);
}


/**
 * Saves the record from an edit form submit
 * @param string The current GET/POST option
 */
function saveMolecule( $task )
{
    global $mainframe;

    // Check for request forgeries
    JRequest::checkToken() or jexit( 'Invalid Token' );

    // Initialize variables
    $row	=& JTable::getInstance('chem', 'Table');
    $post = JRequest::get( 'post' );
    $post['misc'] = JRequest::getVar('misc', '', 'POST', 'string', JREQUEST_ALLOWHTML);

    if (!$row->bind( $post )) {
        JError::raiseError(500, $row->getError() );
    }

    // save to a copy, reset the primary key
//    if ($task == 'save2copy') {
//        $row->id = 0;
//    }

    // pre-save checks
//    if (!$row->check()) {
//        JError::raiseError(500, $row->getError() );
//    }

    // save the changes
    if (!$row->store()) {
        JError::raiseError(500, $row->getError() );
    }

//    $row->checkin();

    switch ($task)
    {
        case 'apply':
        case 'save2copy':
            $msg	= JText::sprintf( 'Changes to X saved', JText::_('Molecule') );
            $link	= 'index.php?option=com_chem&task=edit&cid[]='. $row->id .'';
            break;

        case 'save2new':
            $msg	= JText::sprintf( 'Changes to X saved', JText::_('Molecule') );
            $link	= 'index.php?option=com_chem&task=edit';
            break;

        case 'save':
        default:
            $msg	= JText::_( 'Molecule saved' );
            $link	= 'index.php?option=com_chem';
            break;
    }

    $mainframe->redirect( $link, $msg );
}

/** PT
 * Cancels editing and checks in the record
 */
function cancelMolecule()
{
    global $mainframe;

    // Check for request forgeries
    JRequest::checkToken() or jexit( 'Invalid Token' );

    // Initialize variables

    $row =& JTable::getInstance('chem', 'Table');
    $row->bind( JRequest::get( 'post' ));
    $row->checkin();

    $mainframe->redirect('index.php?option=com_chem');
}

/**
 * Removes records
 * @param array An array of id keys to remove
 * @param string The current GET/POST option
 */
function removeMolecules( &$cid )
{
    global $mainframe;

    // Check for request forgeries
    JRequest::checkToken() or jexit( 'Invalid Token' );

    // Initialize variables
    $db =& JFactory::getDBO();
    JArrayHelper::toInteger($cid);

    if (count( $cid )) {
        $cids = implode( ',', $cid );
        $query = 'DELETE FROM #__chem'
            . ' WHERE id IN ( '. $cids .' )'
        ;
        $db->setQuery( $query );
        if (!$db->query()) {
            echo "<script> alert('".$db->getErrorMsg(true)."'); window.history.go(-1); </script>\n";
        }
    }

    $mainframe->redirect( "index.php?option=com_chem", 'Recording has been deleted!' );
}

function aboutComponent(){
    HTML_chem::aboutComponent();
}

function exportDB(){
    HTML_chem::exportDB();
}

function importDB($option){
    HTML_chem::importDB($option);
}

function importDBProcess(){

    define('RECORD_DELIMITER', "$$$$");
    define('FIELD_DELIMITER', ">  ");

    $mapping_fields  = array('id' => 'id',
                            'Formula' => 'molecular_formula',
                            'Mol Weight' => 'mol_weigh',
                            'Catalog_namber' => 'cat_namber',
                            'Purity' => 'purity',
                            'Molecular_Formula' =>'molecular_formula',
                            'Available_from_stock' => 'mass',
                            'CAS_number' => 'cas_number',
                            'MDL_number' => 'mdl_number',
                            'SMILES' => 'smiles',
                            'Status' => 'status',
                            'iupac_name' => 'iupac_name',
                            'price1mg' => 'price1mg',
                            'price2mg' => 'price2mg',
                            'price3mg' => 'price3mg',
                            'price4mg' => 'price4mg',
                            'price5mg' => 'price5mg',
                            'price10mg' => 'price10mg',
                            'price15mg' => 'price15mg',
                            'price20mg' => 'price20mg',
                            'price25mg' => 'price25mg',
                            'price5umol' => 'price5mmol',
                            'price10umol' => 'price10mmol',
                            'price20umol' => 'price20mmol');

    $array_chem_object = array();

    //read content of file
    $file_to_delete     = JRequest::getVar('filetodelete',null,'FILES');
    $sdf_file         = fopen($file_to_delete['tmp_name'], 'r');
    $sdf_file_content = fread($sdf_file,filesize($file_to_delete['tmp_name']));
    fclose($sdf_file);

    $records_array   = explode(RECORD_DELIMITER,$sdf_file_content);


    for($j=0; $j<count($records_array); $j++){

        $item_array = explode(FIELD_DELIMITER,$records_array[$j]);
        $objItem    = new JObject();

        for($i=0; $i < count($item_array); $i++){
            if($i == 0) {
               // echo "<br/><br/> mdl_file: " . $item_array[$i] . "<br/>";
                $objItem->set('mdl_form',PHP_EOL.PHP_EOL.ltrim($item_array[$i]));
            } else {
                $item = explode(">", trim($item_array[$i], "\n\r<"));
              //  echo $item[0] . ": " . trim($item[1]) . "<br/>";
                if($mapping_fields[$item[0]]) // существует ли такое поле в таблице
                    $objItem->set($mapping_fields[$item[0]],trim($item[1]));
            }
        }

        $array_chem_object[$j] = $objItem;

    }

    HTML_chem::importDBProcess($array_chem_object);
}

function packageDelete($option){
    HTML_chem::pakageDelete($option);
}

function pakageDeleteProcess(){
    $todelete     = JRequest::getVar('itemtodelete');
    $filetodelete = JRequest::getVar('filetodelete',null,'FILES');

    if($filetodelete['name'] !== '') $list_from_file = file($filetodelete['tmp_name']);

    if($todelete !== '') $list_from_field =  explode(PHP_EOL,$todelete);


    if($list_from_field !== '' && !is_null($list_from_file))
        $all_list = array_merge_recursive($list_from_field,$list_from_file);

    if($list_from_field !== '' && $list_from_file == '')
        $all_list = $list_from_field;

    if($list_from_field == '' && $list_from_file !== '')
        $all_list = $list_from_file;


    HTML_chem::pakageDeleteProcess($all_list);
}

function listOfFiles($option){
    jimport('joomla.filesystem.folder');

    $filelist = JFolder::files(JPATH_ROOT.DS.'logs', '.', false, false, array('index.html'));

    HTML_chem::showFileList($filelist, $option);

}

function showLogFile(){
    $fid 	= JRequest::getVar('f');
    $option = JRequest::getCmd('option');

    jimport('joomla.filesystem.file');

    $filecontent = JFile::read(JPATH_ROOT.DS.'logs'.DS.$fid);

    HTML_chem::showLogFile($filecontent);

}

function delFiles(&$fid){
    global $mainframe;

    jimport('joomla.filesystem.file');

    // Check for request forgeries
    JRequest::checkToken() or jexit( 'Invalid Token' );

    array_walk($fid,'glue');


    JFile::delete($fid);


    $mainframe->redirect( "index.php?option=com_chem&amp;task=listoffiles", 'Recording has been deleted!' );

}

function glue(&$value,$key){
    $fp = JPATH_ROOT.DS.'logs'.DS;
    $value = $fp.$value;
}
