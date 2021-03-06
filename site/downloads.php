<?php
	// No direct access
	defined('_JEXEC') or die('Restricted access');

	// dependencies / include common classes / helpers
	include_once JPATH_ADMINISTRATOR . '/components/com_downloads/helpers/helper.php';

	// Require the base controller
	require_once(JPATH_COMPONENT.DS.'controller.php');

	// Require specific controller if requested
	if ($controller = JRequest::getWord('controller')) {
		$path = JPATH_COMPONENT.DS . 'controllers'.DS . $controller.'.php';
		if (file_exists($path)) {
			require_once $path;
		}
		else {
			$controller = '';
		}
	}


	JHTML::_('stylesheet', 'component.css', JURI::base() .'/components/com_downloads/css/');


	// Create the controller
	$cClassname = 'DownloadsController'.$controller;
	$controller = new $cClassname();

	// Perform the Request task – passed task or display
	$controller->execute(JRequest::getWord('task'));

	// Redirect if set by the controller
	$controller->redirect();
