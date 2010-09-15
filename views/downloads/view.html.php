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
			$downloads =& $model->getDownloads();
			$this->assignRef('downloads', $downloads);

			$downloadFiles = array();
			foreach ($downloads as $download) {
				$files =& $model->getFiles($download->dlid);
				$downloadFiles[$download->dlid] = $files;
			}
			$this->assignRef('downloadFiles', $downloadFiles);

	        parent::display($tpl);
	    }
	}
