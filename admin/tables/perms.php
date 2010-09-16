<?php
defined('_JEXEC') or die('Restricted access');

class TableDownloadsFiles extends JTable
{
    /**
     * Primary Key
     * @var int
     */
    var $fid = null;
    /**
     * Foreign Key
     * @var int download id
     */
    var $dlid = null;
    /**
     * @var string
     */
    var $name = null;
    /**
     * @var string
     */
    var $filename = null;
    /**
     * @var string
     */
    var $url = null;
    /**
     * @var string
     */
    var $filepath = null;
    /**
     * @var int
     */
    var $size = null;
    /**
     * @var string
     */
    var $version = null;
    /**
     * @var string
     */
    var $platform = null;
    /**
     * @var int
     */
    var $order = null;
    /**
     * @var int
     */
    var $hits = null;
    /**
     * @var int
     */
    var $uid = null;
    /**
     * @var int
     */
    var $date = null;

    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__downloads_files', 'cid', $db);
    }
}
