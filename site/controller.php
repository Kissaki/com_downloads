<?php
	// No direct access
	defined( '_JEXEC' ) or die( 'Restricted access' );

	jimport('joomla.application.component.controller');

	class DownloadsController extends JController
	{
		function __construct($config = array())
		{
			parent::__construct($config);
			$this->_addBreadCrumb();
		}
		function _addBreadCrumb()
		{
			$app = JFactory::getApplication();
			$pathway = $app->getPathway();
			// add breadcrumb if category id or download id is passed
			$categoryId = JRequest::getInt('cid', null);
			// if categoryId is not passed, try to get it from selected download
			if ($categoryId == null) {
				$downloadId = JRequest::getInt('dlid', null);
				if ($downloadId !== null) {
					$model = $this->getModel('downloads');
					if ($model !== null) {
						$download = $model->getDownload($downloadId);
						if ($download !== null && !empty($download->cid)) {
							$categoryId = $download->cid;
						}
					}
				}
			}
			$elements = array();
			if ($categoryId !== null) {
				do {
					// get category
					$model = $this->getModel( 'downloads' );
					$category = $model->getCategory( $categoryId );
					// add bread only if category exists / was found
					if (!empty($category)) {
						$elements[] = array(
							'name'=>$category->name,
							'route'=>JRoute::_( 'index.php?cid=' . $categoryId ),
						);
						//$pathway->addItem( $category->name, JRoute::_( 'index.php?cid=' . $categoryId ) );
					}
					$categoryId = $category->pid;
				} while ($categoryId != 0);
			}
			$elements = array_reverse($elements);
			foreach ($elements as $el) {
				$pathway->addItem( $el['name'], $el['route'] );
			}
			
			// add download if selected
			if (!empty($download)) {
				//TODO add correct URI (this is only valid on last pathway element, which is not linked anyway, which currently is always but may change)
				$pathway->addItem(htmlspecialchars($download->name), JRequest::getURI());
			}
		}

		/**
		 * Method to display the view
		 * @access public
		 */
		function display($cachable = false, $urlparams = false)
		{
			JRequest::setVar( 'view',   'downloads' );
//			if (JRequest::getInt('dlid', null) != null) {
//				JRequest::setVar( 'layout', 'download' );
//			} else {
				JRequest::setVar( 'layout', 'downloads' );
//			}
			parent::display();
		}

		function download() {
			$fid = JRequest::getInt( 'fid' );
			if ( !empty($fid)) {
				$model =& $this->getModel( 'downloads' );
				$file =& $model->getFile( $fid );
				if ( !empty($file)) {
					// UPDATE HITS
					$query = 'UPDATE #__' . DownloadsModelDownloads::TABLENAME_FILES . ' SET hits = hits+1 WHERE fid = ' . $fid . ';';
					if (!empty($file->filepath)) {
						// PARSE FILE
						$filepath = $file->filepath . $file->filename;
						if (file_exists( $filepath )) {
							//XXX: check if this works
							//header( 'Content-Disposition: attachment; filename="' . $file->filename . '"' );
							//header( 'Content-Length: ' . filesize( $filepath ) );
							//readfile( $filepath );
							JResponse::setHeader( 'Content-Disposition', 'attachment; filename="' . $file->filename . '"' );
							JResponse::setHeader( 'Content-Length', filesize( $filepath ) );
							JResponse::setBody (file_get_contents($filepath));
							global $mainframe;
							$mainframe->stop();
						}
						else {
							if (!empty( $file->url )) {
								// REDIRECT TO FILE
								$this->setRedirect( $file->url );
								$this->redirect();
							}
							else {
								$msg = JText::_( 'The Download is broken. Please inform a webmaster.' );
								$link = 'index.php?option=com_downloads';
								$this->setRedirect( $link, $msg );
								$this->redirect();
							}
						}
					}
					else {
						if (!empty( $file->url )) {
							// REDIRECT TO FILE
							$this->setRedirect( $file->url );
							$this->redirect();
						}
						else {
							$msg = JText::_( 'The Download is broken. Please inform a webmaster.' );
							$link = 'index.php?option=com_downloads';
							$this->setRedirect( $link, $msg );
							$this->redirect();
						}
					}
				}
				else {
					$msg = JText::_( 'Invalid ID' );
					$link = 'index.php?option=com_downloads';
					$this->setRedirect( $link, $msg );
					$this->redirect();
				}
			}
			else {
				$msg = JText::_( 'Invalid Call' );
				$link = 'index.php?option=com_downloads';
				$this->setRedirect( $link, $msg );
				$this->redirect();
			}

			$msg = JText::_('There was a problem requesting this file for download.');
			$link = 'index.php?option=com_downloads';
			$this->setRedirect( $link, $msg );
			$this->redirect();
			//TODO remove commented out code
			//JRequest::setVar( 'format', 'raw' );
			//JRequest::setVar( 'view',   'downloads' );
			//JRequest::setVar( 'layout', 'downloads' );
			//parent::display();
		}
	}
