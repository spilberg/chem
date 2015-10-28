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
//JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_chem'.DS.'tables');

$task = JRequest::getCmd('task');
$id = JRequest::getVar('id', 0, 'get', 'int');
$cid = JRequest::getVar('cid', array(0), 'post', 'array');
JArrayHelper::toInteger($cid, array(0));


switch ($task) {

    case 'add' :
        editMolecule(false);
        break;
    case 'edit':
        editMolecule(true);
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
    $db		=& JFactory::getDBO();
    $user 	=& JFactory::getUser();

    $cid 	= JRequest::getVar('cid', array(0), '', 'array');
    $option = JRequest::getCmd('option');

    JArrayHelper::toInteger($cid, array(0));

    $row =& JTable::getInstance('chem', 'Table');
    // load the row from the db table
    if($edit)
        $row->load( $cid[0] );

    if ($edit) {
        // do stuff for existing records
        $row->checkout($user->get('id'));
    } else {
        // do stuff for new records
        $row->imagepos 	= 'top';
        $row->ordering 	= 0;
        $row->published = 1;
    }
    $lists = array();

    // build the html select list for ordering
    $query = 'SELECT ordering AS value, name AS text'
        . ' FROM #__contact_details'
        . ' WHERE published >= 0'
        . ' AND catid = '.(int) $row->catid
        . ' ORDER BY ordering'
    ;
    if($edit)
        $lists['ordering'] 			= JHTML::_('list.specificordering',  $row, $cid[0], $query );
    else
        $lists['ordering'] 			= JHTML::_('list.specificordering',  $row, '', $query );

    // build list of users
    $lists['user_id'] 			= JHTML::_('list.users',  'user_id', $row->user_id, 1, NULL, 'name', 0 );
    // build list of categories
    $lists['catid'] 			= JHTML::_('list.category',  'catid', 'com_contact_details', intval( $row->catid ) );
    // build the html select list for images
    $lists['image'] 			= JHTML::_('list.images',  'image', $row->image );
    // build the html select list for the group access
    $lists['access'] 			= JHTML::_('list.accesslevel',  $row );
    // build the html radio buttons for published
    $lists['published'] 		= JHTML::_('select.booleanlist',  'published', '', $row->published );
    // build the html radio buttons for default
    $lists['default_con'] 		= JHTML::_('select.booleanlist',  'default_con', '', $row->default_con );

    // get params definitions
    $file 	= JPATH_ADMINISTRATOR .'/components/com_contact/contact_items.xml';
    $params = new JParameter( $row->params, $file, 'component' );

    HTML_contact::editcontact( $row, $lists, $option, $params );
}

function showMolecules_2($option)
{
    global $mainframe;

    $db = &JFactory::getBDO();


}

/**
 * List the records
 * @param string The current GET/POST option
 */
function showMolecules($option)
{
    global $mainframe;

    $db =& JFactory::getDBO();
    $filter_order = $mainframe->getUserStateFromRequest($option . 'filter_order', 'filter_order', 'cd.ordering', 'cmd');
    $filter_order_Dir = $mainframe->getUserStateFromRequest($option . 'filter_order_Dir', 'filter_order_Dir', '', 'word');
    $filter_state = $mainframe->getUserStateFromRequest($option . 'filter_state', 'filter_state', '', 'word');
    $filter_catid = $mainframe->getUserStateFromRequest($option . 'filter_catid', 'filter_catid', 0, 'int');
    $search = $mainframe->getUserStateFromRequest($option . 'search', 'search', '', 'string');
    if (strpos($search, '"') !== false) {
        $search = str_replace(array('=', '<'), '', $search);
    }
    $search = JString::strtolower($search);

    $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
    $limitstart = $mainframe->getUserStateFromRequest($option . '.limitstart', 'limitstart', 0, 'int');

    $where = array();

    if ($search) {
        $where[] = 'ch.name LIKE ' . $db->Quote('%' . $db->getEscaped($search, true) . '%', false);
    }

//    if ( $filter_catid ) {
//        $where[] = 'cd.catid = '.(int) $filter_catid;
//    }

    if ($filter_state) {
        if ($filter_state == 'P') {
            $where[] = 'cd.published = 1';
        } else if ($filter_state == 'U') {
            $where[] = 'cd.published = 0';
        }
    }

    // sanitize $filter_order
    if (!in_array($filter_order, array('ch.cat_namber'))) {
        $filter_order = 'ch.cat_namber';
    }

    if (!in_array(strtoupper($filter_order_Dir), array('ASC', 'DESC'))) {
        $filter_order_Dir = '';
    }

    $where = (count($where) ? ' WHERE ' . implode(' AND ', $where) : '');
    if ($filter_order == 'ch.cat_namber') {
        $orderby = ' ORDER BY id, ch.cat_namber';
    } else {
        $orderby = ' ORDER BY ' . $filter_order . ' ' . $filter_order_Dir . ', category, cd.ordering';
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
//    print_r($query); exit;

//    $query = 'SELECT cd.*, cc.title AS category, u.name AS user, v.name as editor, g.name AS groupname'
//        . ' FROM #__contact_details AS cd'
//        . ' LEFT JOIN #__groups AS g ON g.id = cd.access'
//        . ' LEFT JOIN #__categories AS cc ON cc.id = cd.catid'
//        . ' LEFT JOIN #__users AS u ON u.id = cd.user_id'
//        . ' LEFT JOIN #__users AS v ON v.id = cd.checked_out'
//        . $where
//        . $orderby;
    $db->setQuery($query, $pageNav->limitstart, $pageNav->limit);
    $rows = $db->loadObjectList();

//    print_r($rows); exit;

    // build list of categories
    $javascript = 'onchange="document.adminForm.submit();"';
//    $lists['catid'] = JHTML::_('list.category', 'filter_catid', 'com_contact_details', intval($filter_catid), $javascript);

    // state filter
//    $lists['state'] = JHTML::_('grid.state', $filter_state);

    // table ordering
    $lists['order_Dir'] = $filter_order_Dir;
    $lists['order'] = $filter_order;

    // search filter
    $lists['search'] = $search;

    HTML_chem::showMolecules($rows, $pageNav, $option, $lists);
}