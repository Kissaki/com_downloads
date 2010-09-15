<?php
	// No direct access
	defined( '_JEXEC' ) or die( 'Restricted access' );

	jimport( 'joomla.application.component.model' );

	/**
	 * @package    KCode.Downloads
	 * @subpackage Components
	 */
	class DownloadsModelDownloads extends JModel
	{
		static $columns = array('dlid', 'name', 'desc', 'cid', 'homepage', 'platform', 'image', 'rating', 'nr_ratings', 'nr_files', 'nr_comments', 'uid', 'date');

		function getDownloads($categoryId=null){
			//$row =& $this->getTable('downloads');

			if($categoryId !== null) {
				$queryCat = 'WHERE `cid`=' . mysql_real_escape_string($_GET['cat']);
			} else {
				$queryCat = '';
			}

			$orderBy = 'name';
			$inOB = JRequest::getString( 'orderby', null );
			if (!empty($inOB) && in_array($inOB, self::$columns)) {
				$orderBy = mysql_real_escape_string($_GET['orderby']);
			}

			$orderDir = 'ASC';
			$inAD = JRequest::getString( 'orderby', null );
			if($inAD != null) {
				$orderDir .= mysql_real_escape_string($_GET['order']);
			}

			$query = 'SELECT * FROM #__downloads_downloads ' . $queryCat . ' ORDER BY ' . $orderBy . ' ' . $orderDir . ';';
			//$result = mysql_query($query) or JError::raiseError(500, mysql_error());
			$downloadsList = $this->_getList($query);
			return $downloadsList;
		}

	}
