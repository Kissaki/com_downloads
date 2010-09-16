<?php
	// No direct access
	defined( '_JEXEC' ) or die( 'Restricted access' );

	jimport('joomla.application.component.controller');

	class DownloadsController extends JController
	{
		function _addBreadCrumb()
		{
			// add breadcrumb if category id is passed
			$categoryId =& JRequest::getInt( 'cid' );
			if (!empty($categoryId)) {
				// get category
				$model =& $this->getModel( 'downloads' );
				$category =& $model->getCategory( $categoryId );
				// add bread only if category exists / was found
				if (!empty($category)) {
					$pathway =& $mainframe->getPathway();
					$pathway->addItem( $category->name, JURI::_( 'index.php?cid=' . $categoryId ) );
				}
			}
		}

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
							header( 'Content-Disposition: attachment; filename="' . $file->filename . '"' );
							header( 'Content-Length: ' . filesize( $filepath ) );
							readfile( $filepath );
						}
						else {
							// REDIRECT TO FILE
							header( 'Location: ' . $file->url );
						}
					}
					else {
						// REDIRECT TO FILE
						header( 'Location: ' . $file->url );
				}
				}
				else {
					$msg = JText::_( 'Invalid ID' );
					$link = 'index.php?option=com_downloads';
					$this->setRedirect( $link, $msg );
				}
			}
			else {
				$msg = JText::_( 'Invalid Call' );
				$link = 'index.php?option=com_downloads';
				$this->setRedirect( $link, $msg );
			}
		}
	}
