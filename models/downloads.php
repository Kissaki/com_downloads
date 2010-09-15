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
		function getDownloads($categoryId=null){
			$row =& $this->getTable('downloads');
			if($categoryId !== null) {
				$queryCat = 'WHERE `cid`='.mysql_real_escape_string($_GET['cat']);
			}
			$queryOrderBy = 'name';
			if($_GET['orderby'] != '') {
				$query_orderby = mysql_real_escape_string($_GET['orderby']);
			}
			$query_order = 'ASC';
			if($_GET['order'] != '') {
				$query_order = mysql_real_escape_string($_GET['order']);
			}

			$query = 'SELECT * FROM #__downloads_downloads ' . $queryCat . ' ORDER BY ' . $query_orderby . ' ' . $query_order . ';';
			$result = mysql_query($query) or JError::raiseError(500, mysql_error());

			while($row = mysql_fetch_assoc($result)){
				$result_f = mysql_query('SELECT * FROM #__downloads_files WHERE `dlid` = '.$row['dlid'].' ORDER BY version DESC, `order` DESC;');
				unset($files);
				while($row_f = mysql_fetch_assoc($result_f))
					$files[] = $row_f;
				$row['files'] = $files;
				$downloads[] = $row;
			}
			return $downloads;
		}

	}
