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
			$model  =& $this->getModel('downloads');

			$categories =& $model->getCategoryTree();
			$this->assignRef('categories', $categories);

			$categoryId = JRequest::getInt( 'cid', null );
			$downloads =& $model->getDownloads($categoryId);
			$this->assignRef('downloads', $downloads);

			$downloadFiles = array();
			foreach ($downloads as $download) {
				$files =& $model->getFiles($download->dlid);
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
