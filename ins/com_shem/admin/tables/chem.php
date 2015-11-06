<?php

defined('_JEXEC') or die( 'Restricted access' );

class TableChem extends JTable
{

    /** @var  int */
    var $cat_namber = null; // char(20) DEFAULT NULL,
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

    /**
     * @param database A database connector object
     */
    function __construct(&$db)
    {
        parent::__construct( '#__chem', 'id', $db );
    }


}