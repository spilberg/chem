<?php

defined('_JEXEC') or die( 'Restricted access' );

class TableChem extends JTable
{

    /** @var  int */
    var $cat_number = null; // char(20) DEFAULT NULL,
    /** @var null  */
    var $id = null;   // ` int(11) DEFAULT NULL,
    /** @var null  */
    var $mol_weigh = null;   //` double DEFAULT NULL,
    /** @var null  */
    var $mass = null;   //` double DEFAULT NULL,
    /** @var string  */
    var $cas_number = null;   //` varchar(50) DEFAULT NULL,
    /** @var string */
    var $mdl_number = null;   //` varchar(50) DEFAULT NULL,
    /** @var string  */
    var $boiling_point = null; //` varchar(50) DEFAULT NULL,
    /** @var string  */
    var $melting_point = null; //` varchar(50) DEFAULT NULL,
    /** @var string */
    var $mdl_form = null;   //` text NOT NULL,
    /** @var int  */
    var $purity = null;   //` int(11) DEFAULT NULL,
    /** @var string  */
    var $smiles = null;   // ` varchar(100) DEFAULT NULL,
    /** @var string  */
    var $status = null;   //` varchar(50) DEFAULT NULL,
    /** @var string  */
    var $molecular_formula = null;   //` varchar(50) DEFAULT NULL,
    /** @var string  */
    var $iupac_name = null;   //` varchar(200) DEFAULT NULL,
    /** @var int  */
    var $price1mg = null;   //` double DEFAULT NULL,
    /** @var int  */
    var $price2mg = null;   //` double DEFAULT NULL,
    /** @var int  */
    var $price3mg = null;   //` double DEFAULT NULL,
    /** @var int  */
    var $price4mg = null;   //` double DEFAULT NULL,
    /** @var int  */
    var $price5mg = null;   //` double DEFAULT NULL,
    /** @var int  */
    var $price10mg = null;   //` double DEFAULT NULL,
    /** @var int  */
    var $price15mg = null;   //` double DEFAULT NULL,
    /** @var int  */
    var $price20mg = null;   //` double DEFAULT NULL,
    /** @var int  */
    var $price25mg = null;   //` double DEFAULT NULL,
    /** @var int  */
    var $price5mmol = null;   //` double DEFAULT NULL,
    /** @var int  */
    var $price10mmol = null;   //` double DEFAULT NULL,
    /** @var int  */
    var $price20mmol = null;   //` double DEFAULT NULL

    var $_log = null;

    var $_format = "{DATE}\t{TIME}\t{C-IP}\t{LEVEL}\t{STATUS}\t{COMMENT}";

    /**
     * @param database A database connector object
     */
    function __construct(&$db)
    {
        parent::__construct( '#__chem', 'id', $db );


        jimport('joomla.error.log');

        $options['format'] = $this->_format;
        $this->_log = & JLog::getInstance('impotrprocess.'.date('Y_m_d').'.php',null, JPATH_ROOT.DS.'logs'.DS);
        $this->_log->setOptions($options);
    }

    /**
     * Inserts a new row if id is zero or updates an existing row in the database table
     *
     * Can be overloaded/supplemented by the child class
     *
     * @access public
     * @param boolean If false, null object variables are not updated
     * @return null|string null if successful otherwise returns and error message
     */

    function storeDB( $updateNulls=false )
    {

//        $log = & JLog::getInstance('impotrprocess.php', null, JPATH_ADMINISTRATOR.DS);

//        $k = $this->_tbl_key;

        $this->_db->setQuery('SELECT count(*) FROM jos_chem Where id ='. $this->id);
        $numrows = $this->_db->loadResult();

        if( $numrows )
        {
            $ret = $this->_db->updateObject( $this->_tbl, $this, $this->_tbl_key, $updateNulls );
            $this->_log->addEntry(array('level' => 'Import DB', 'status' => 'Update', 'comment' => "element with cat_number: " . $this->cat_number));
        }
        else
        {
            // $this->id = null;
            $ret = $this->_db->insertObject( $this->_tbl, $this, $this->_tbl_key );
            $this->_log->addEntry(array('level' => 'Import DB', 'status' => 'Insert', 'comment' => "element with cat_number: " . $this->cat_number));
        }
        if( !$ret )
        {
            $this->setError(get_class( $this ).'::store failed - '.$this->_db->getErrorMsg());
            return false;
        }
        else
        {
            return true;
        }
    }

//    /**
//     * Default delete method
//     *
//     * can be overloaded/supplemented by the child class
//     *
//     * @access public
//     * @return true if successful otherwise returns and error message
//     */
//    function deletePackage( $oid=null )
//    {
//        //if (!$this->canDelete( $msg ))
//        //{
//        //	return $msg;
//        //}
//
//        $k = $this->_tbl_key;
//        if ($oid) {
//            $this->$k = intval( $oid );
//        }
//
//        $query = 'DELETE FROM '.$this->_db->nameQuote( $this->_tbl ).
//            ' WHERE '.$this->_tbl_key.' = '. $this->_db->Quote($this->$k);
//        $this->_db->setQuery( $query );
//
//        if ($this->_db->query())
//        {
//
//            'Try to delete row with id: '. $myid . '&nbsp;&nbsp;&nbsp;&nbsp;--> ' .($db->getAffectedRows() ? ' Row '. $myid .' <span style="color:#00ff00;">delete now</span>' : ' Row '. $myid .' <span style="color:#ff0000;">not delete</span>');
//           // return true;
//        }
//        else
//        {
//            $this->setError($this->_db->getErrorMsg());
//            return false;
//        }
//    }

    function delRec($myid){
//        jimport('joomla.error.log');
//
//        $_format = "{DATE}\t{TIME}\t{C-IP}\t{LEVEL}\t{STATUS}\t{COMMENT}";
//        $options['format'] = $_format;
//        $log = & JLog::getInstance('impotrprocess.'.date('Y_m_d').'.php',null, JPATH_ROOT.DS.'logs'.DS);
//        $log->setOptions($options);
        $retData = '';

      //  $db = & JFactory::getDBO();

        $query = 'DELETE FROM jos_chem WHERE cat_number = '. $myid;
//        $query = 'SELECT * FROM jos_chem WHERE id = '. $myid;

        $this->_db->setQuery($query);

        if($this->_db->query()) {
            $this->_log->addEntry(array('level' => 'Delete Package', 'status' => ($this->_db->getAffectedRows() ? 'delete now' : 'not delete'), 'comment' => ' Cat_numbet '. $myid));
            $retData = 'Try to delete row with Cat_number: '. $myid . '&nbsp;&nbsp;&nbsp;&nbsp;--> ' .($this->_db->getAffectedRows() ? ' Cat_number '. $myid .' <span style="color:#00ff00;">delete now</span>' : ' Row '. $myid .' <span style="color:#ff0000;">not delete</span>');
        } else {
            $retData = 'Errors ';
        }

        return $retData;
    }

    function delAllRecord($count){
        $query = 'TRUNCATE TABLE jos_chem';
//        $query = 'SELECT * FROM jos_chem WHERE id = '. $myid;

        $this->_db->setQuery($query);

        if($this->_db->query()) {
            $this->_log->addEntry(array('level' => 'Delete All', 'status' => 'delete now', 'comment' => ' Count of row '. $count));
            $retData = 'Try to delete '. $count . ' rows: &nbsp;&nbsp;&nbsp;&nbsp;--> ' . $count . ' rows  <span style="color:#00ff00;">delete now</span>';
        } else {
            $retData = 'Errors ';
        }

        return $retData;
    }
}