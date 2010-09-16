<?php
defined('_JEXEC') or die('Restricted access');

class TableDownloadsFiles extends JTable
{
    /**
     * Primary Key
     * @var int
     */
    var $rid = null;
    /**
     * Foreign Key
     * @var int download id
     */
    var $gid = null;
    /**
     * Foreign Key
     * @var int download id
     */
    var $cid = null;
    var $add = null;
    var $editown = null;
    var $edit = null;
    var $approve = null;
    var $remove = null;
    var $isadmin = null;

    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__downloads_perms', 'rid', $db);
    }
}
