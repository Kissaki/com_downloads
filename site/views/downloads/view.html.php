<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');
jimport( 'joomla.utilities.date' );

/**
 * HTML View class for the HelloWorld Component
 * @package Profile
 */
class DownloadsViewDownloads extends JView
{
	function display($tpl = null)
	{
		// get models
		$model = $this->getModel('downloads');
		// get request params
		$downloadId = JRequest::getInt( 'dlid', null );
		$categoryId = JRequest::getInt( 'cid', null );

		// assign categories
		$categories = $model->getCategoryTree($categoryId);
		$this->assignRef('categories', $categories);

		// get download/-s
		if ($downloadId !== null) {
			$download = $model->getDownload($downloadId);
			if ($download !== null) {
				$downloads = array($download);
			} else {
				$downloads = array();
				echo JText::_('Download not found!');
			}
		} else {
			$downloads = $model->getDownloads($categoryId);
		}
		// assign downloads
		$this->assignRef('downloads', $downloads);

		// assign download-files
		$downloadFiles = array();
		foreach ($downloads as $download) {
			$files = $model->getFiles($download->dlid);
			$downloadFiles[$download->dlid] = $files;
		}
		$this->assignRef('downloadFiles', $downloadFiles);

		parent::display($tpl);
	}

	function printCategoryTree($categries)
	{
		foreach ($categries as $category) {
			echo '<li>';
			echo '	<a href="' . JRoute::_( 'index.php?cid=' . $category->cid ). '">';
			echo '		' . $category->name;
			echo '	</a>';

			if (!empty($category->childs)) {
				echo '	<ul class="dl_cat_list">';
				$this->printCategoryTree($category->childs);
				echo '	</ul>';
			}
			echo '</li>';
		}
	}
}
