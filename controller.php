<?php
	// No direct access
	defined( '_JEXEC' ) or die( 'Restricted access' );

	jimport('joomla.application.component.controller');

	class DownloadsController extends JController
	{
		/**
		 * Method to display the view
		 * @access public
		 */
		function display()
		{
			JRequest::setVar( 'view',   'downloads' );
			JRequest::setVar( 'layout', 'downloads' );
			parent::display();
		}
	}
