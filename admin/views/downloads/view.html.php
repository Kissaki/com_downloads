<?php

	// no direct access
	defined('_JEXEC') or die('Restricted access');

	jimport('joomla.application.component.view');

	/**
	 * HTML View class for the HelloWorld Component
	 * @package Profile
	 */
	class DownloadsViewDownloads extends JView {
		function display($tpl = null) {
			JToolBarHelper::title(JText::_('Profiles Manager'), 'generic.png');
			JToolBarHelper::deleteList( JText::_('Are you sure you wish to remove these?') );
			JToolBarHelper::editListX();
			JToolBarHelper::addNewX();

			$user =& JFactory::getUser();
			$this->assignRef('user', $user);

			$model     =& $this->getModel('downloads');
			$downloads =& $model->getDownloads();
			$this->assignRef('downloads', $downloads);

			parent::display($tpl);
		}
	}
