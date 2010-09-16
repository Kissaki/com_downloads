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
		const TABLENAME_CATEGORIES = 'downloads_categories';
		const TABLENAME_DOWNLOADS  = 'downloads_downloads';
		const TABLENAME_FILES      = 'downloads_files';

		static $columnsDownloads = array('dlid', 'name', 'desc', 'cid', 'homepage', 'platform', 'image', 'rating', 'nr_ratings', 'nr_files', 'nr_comments', 'uid', 'date');
		static $columnsFiles = array('fid', 'dlid', 'name', 'filename', 'url', 'filepath', 'size', 'version', 'platform', 'order', 'hits', 'uid', 'date');

		function getDownloads($categoryId=null){
			if($categoryId !== null) {
				$queryCat = 'WHERE `cid`=' . intval($categoryId);
			}
			else {
				$queryCat = '';
			}

			$orderBy = 'date';
			$inOB = JRequest::getString( 'orderby', null );
			if (!empty($inOB) && in_array($inOB, self::$columns)) {
				$orderBy = mysql_real_escape_string($_GET['orderby']);
			}

			$orderDir = 'DESC';
			$inAD = JRequest::getString( 'orderby', null );
			if($inAD != null) {
				$orderDir .= mysql_real_escape_string($_GET['order']);
			}

			$query = 'SELECT * FROM #__' . self::TABLENAME_DOWNLOADS . ' ' . $queryCat . ' ORDER BY ' . $orderBy . ' ' . $orderDir . ';';
			$downloadsList = $this->_getList($query);
			return $downloadsList;
		}


		function getDownload($downloadId)
		{
			$downloadId = intval($downloadId);
			$query = 'SELECT * FROM #__' . self::TABLENAME_DOWNLOADS . ' WHERE dlid = ' . $downloadId . ' LIMIT 1;';
			$download = $this->_getList($query);
			return (count($download) == 1? $download : null);
		}

		function getFiles($downloadId)
		{
			$downloadId = intval($downloadId);

			$query = 'SELECT * FROM #__' . self::TABLENAME_FILES . ' WHERE dlid = ' . $downloadId . ' ORDER BY `order` ASC, version DESC';
			$files =& $this->_getList($query);
			return $files;
		}

		function getFile($fileId)
		{
			$fileId = intval($fileId);

			$query = 'SELECT * FROM #__' . self::TABLENAME_FILES . ' WHERE fid = ' . $fileId . ' LIMIT 1';
			$files = $this->_getList($query);
			return (count($files) > 0 ? $files[0] : null);
		}

		function getCategories($parentCategoryId=0)
		{
			$parentCategoryId = intval($parentCategoryId);
			$query = 'SELECT * FROM #__' . self::TABLENAME_CATEGORIES . ' WHERE `pid` = ' . $parentCategoryId . ';';
			$categories =& $this->_getList($query);
			return $categories;
		}
		function getCategory($categoryId)
		{
			$categoryId = intval($categoryId);
			$query = 'SELECT * FROM #__' . self::TABLENAME_CATEGORIES . ' WHERE `cid` = ' . $categoryId . ' LIMIT 1;';
			$categories =& $this->_getList($query);
			return (count($categories) > 0 ? $categories[0] : null);
		}
		function getCategoryTree($parentCategoryId=0)
		{
			$categories =& $this->getCategories($parentCategoryId);
			foreach ($categories as $category) {
				$subCategories =& $this->getCategories($category->cid);
				$category->childs = $subCategories;
			}
			return $categories;
		}

	}
