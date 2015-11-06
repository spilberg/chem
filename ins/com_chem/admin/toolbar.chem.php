<?php

defined( '_JEXEC' ) or die('Restricted access');

require_once( JApplicationHelper::getPath('toolbar_html'));

switch ( $task ) {

    case 'add'  :
        TOOLBAR_chem::_EDIT(false);
        break;
    case 'edit' :
    case 'editA':
        TOOLBAR_chem::_EDIT(true);
        break;

    default:
        TOOLBAR_chem::_DEFAULT();
        break;
}