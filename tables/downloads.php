<?php
defined('_JEXEC') or die('Restricted access');

class TableDownloadsDownloads extends JTable
{
    /**
     * Primary Key
     *
     * @var int
     */
    var $dlid = null;
	var $name = null;
	var $desc = null;
	var $cid = null;
	var $homepage = null;
	var $platform = null;
	var $image = null;
	var $rating = null;
	var $nr_ratings = null;
	var $nr_files = null;
	var $nr_comments = null;
	var $uid = null;
	var $date = null;

    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__downloads_downloads', 'dlid', $db);
    }
}
