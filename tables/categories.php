<?php
defined('_JEXEC') or die('Restricted access');

class TableDownloadsCategories extends JTable
{
    /**
     * Primary Key
     * @var int
     */
    var $cid = null;
    /**
     * @var int
     */
	var $pid = null;
	/**
	 * @var string
	 */
	var $name = null;
	var $img = null;
	var $desc = null;

    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__downloads_categories', 'cid', $db);
    }
}
