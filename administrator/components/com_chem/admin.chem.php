<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

/*
 * Make sure the user is authorized to view this page
 */
$user = & JFactory::getUser();
//if (!$user->authorize( 'com_chem', 'manage' )) {
//    $mainframe->redirect( 'index.php', JText::_('ALERTNOTAUTH') );
//}

require_once( JApplicationHelper::getPath( 'admin_html' ) );
// Set the table directory
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_chem'.DS.'tables');

$task	= JRequest::getCmd('task');
$id 	= JRequest::getVar('id', 0, 'get', 'int');
$cid 	= JRequest::getVar('cid', array(0), 'post', 'array');
JArrayHelper::toInteger($cid, array(0));


switch ($task) {

    default:
        showMolecules( $option );
        break;

}


/**
 * List the records
 * @param string The current GET/POST option
 */
function showMolecules( $option )
{
    global $mainframe;

    $db					=& JFactory::getDBO();
    $filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order', 		'filter_order', 	'cd.ordering',	'cmd' );
    $filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
    $filter_state 		= $mainframe->getUserStateFromRequest( $option.'filter_state', 		'filter_state', 	'',				'word' );
    $filter_catid 		= $mainframe->getUserStateFromRequest( $option.'filter_catid', 		'filter_catid',		0,				'int' );
    $search 			= $mainframe->getUserStateFromRequest( $option.'search', 			'search', 			'',				'string' );
    if (strpos($search, '"') !== false) {
        $search = str_replace(array('=', '<'), '', $search);
    }
    $search = JString::strtolower($search);

    $limit		= $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
    $limitstart	= $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');

    $where = array();

    if ( $search ) {
        $where[] = 'cd.name LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
    }
    if ( $filter_catid ) {
        $where[] = 'cd.catid = '.(int) $filter_catid;
    }
    if ( $filter_state ) {
        if ( $filter_state == 'P' ) {
            $where[] = 'cd.published = 1';
        } else if ($filter_state == 'U' ) {
            $where[] = 'cd.published = 0';
        }
    }

    // sanitize $filter_order
    if (!in_array($filter_order, array('cd.name', 'cd.published', 'cd.ordering', 'cd.access', 'category', 'user', 'cd.id'))) {
        $filter_order = 'cd.ordering';
    }

    if (!in_array(strtoupper($filter_order_Dir), array('ASC', 'DESC'))) {
        $filter_order_Dir = '';
    }

    $where 		= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
    if ($filter_order == 'cd.ordering'){
        $orderby 	= ' ORDER BY category, cd.ordering';
    } else {
        $orderby 	= ' ORDER BY '. $filter_order .' '. $filter_order_Dir .', category, cd.ordering';
    }

    // get the total number of records
    $query = 'SELECT COUNT(*)'
        . ' FROM #__contact_details AS cd'
        . $where
    ;
    $db->setQuery( $query );
    $total = $db->loadResult();

    jimport('joomla.html.pagination');
    $pageNav = new JPagination( $total, $limitstart, $limit );

    // get the subset (based on limits) of required records
    $query = 'SELECT cd.*, cc.title AS category, u.name AS user, v.name as editor, g.name AS groupname'
        . ' FROM #__contact_details AS cd'
        . ' LEFT JOIN #__groups AS g ON g.id = cd.access'
        . ' LEFT JOIN #__categories AS cc ON cc.id = cd.catid'
        . ' LEFT JOIN #__users AS u ON u.id = cd.user_id'
        . ' LEFT JOIN #__users AS v ON v.id = cd.checked_out'
        . $where
        . $orderby
    ;
    $db->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
    $rows = $db->loadObjectList();

    // build list of categories
    $javascript = 'onchange="document.adminForm.submit();"';
    $lists['catid'] = JHTML::_('list.category',  'filter_catid', 'com_contact_details', intval( $filter_catid ), $javascript );

    // state filter
    $lists['state']	= JHTML::_('grid.state',  $filter_state );

    // table ordering
    $lists['order_Dir']	= $filter_order_Dir;
    $lists['order']		= $filter_order;

    // search filter
    $lists['search']= $search;

    HTML_chem::showMolecules( $rows, $pageNav, $option, $lists );
}