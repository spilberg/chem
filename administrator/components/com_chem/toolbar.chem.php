<?php

defined( '_JEXEC' ) or die('Restricted access');

require_once( JApplicationHelper::getPath('toolbar_html'));

JHTML::stylesheet('admin.stylesheet.css','administrator/components/com_chem/css/');

switch ( $task ) {

    case 'add'  :
        TOOLBAR_chem::_EDIT(false);
        break;
    case 'edit' :
    case 'editA':
        TOOLBAR_chem::_EDIT(true);
        break;

    case 'packagedelete':
    case 'deletepackage':
        TOOLBAR_chem::_PACKAGEDELETE($task);
        break;

    case 'listoffiles':
    case 'listofsdf':
        TOOLBAR_chem::_LISTOFFILES();
        break;

    case 'importdb':
    case 'importdbprocess':
        TOOLBAR_chem::_IMPORTDB($task);
        break;

    case 'exportdb':
        TOOLBAR_chem::_EXPORTDB($task);
        break;

    case 'about':
        TOOLBAR_chem::_DEFAULT($task);
        break;

    default:
        TOOLBAR_chem::_DEFAULT();
        break;
}