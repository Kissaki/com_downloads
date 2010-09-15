<?php defined('_JEXEC') or die('Restricted access'); ?>
<div class="dl_download">
	<?php $dlDate = new JDate($download->date); ?>
	<?php $imgPath = JURI::base() . '/components/com_downloads/images'; ?>
	<div class="dl_topline">
		<div class="dl_topline_nfo">
			<?php echo $download->nr_files; ?> <?php echo JText::_('Files'); ?>,
			<?php echo JText::_('Last Update'); ?>: <?php echo $dlDate->toFormat(); ?>
		</div>
		<a href="javascript:toggle_dl('dl<?php echo $download->dlid; ?>');">+</a>
		<span class="dl_title">
			<a title="view <?php echo $download->name; ?>" href="<?php echo JRoute::_('index.php?option=com_downloads&dlid=' . $download->dlid); ?>">
				<?php echo $download->name; ?>
			</a>
		</span>
	</div>
	<div class="dl_info" id="dl<?php echo $download->dlid; ?>">
		<div class="dl_desc">
			<?php echo $download->desc; ?>
		</div>
		<div class="dl_bottomline">
			<!--<div class="dl_actions">
				<a title="<?php echo JText::_('edit download'); ?>" href="<?php echo JRoute::_('index.php?task=editdownload&dlid=' . $download->dlid); ?>">
					<?php echo JText::_('edit'); ?>
				</a>
				<a title="<?php echo JText::_('remove download'); ?>" href="<?php echo JRoute::_('index.php?task=removedownload&dlid=' . $download->dlid); ?>">
					<?php echo JText::_('remove'); ?>
				</a>
				<?php //TODO report download functionality ?>
			</div>-->
			<img alt="<?php echo JText::_('Platform:'); ?>" src="<?php echo $imgPath; ?>/platform.gif" />
			<?php echo $download->platform; ?>
			<img alt="<?php echo JText::_('Homepage:'); ?>" src="<?php echo $imgPath; ?>/home.gif" />
			<a rel="external" href="<?php echo $download->homepage; ?>"><?php echo $download->homepage; ?></a>
		</div>
		<hr />
		<div class="dl_files">
			<?php echo JText::_('Files'); ?> (<?php echo $download->nr_files; ?>):
			<?php if (count($this->downloadFiles[$download->dlid]) > 0) { ?>
				<ul>
					<?php foreach ($this->downloadFiles[$download->dlid] as $file) { ?>
						<li class="dl_file">
							<!--<div class="dl_file_actions">
								<a title="<?php echo JText::_('edit file'); ?>" href="<?php echo JRoute::_('index.php?task=editfile&fid=' . $file->fid); ?>">
									<?php echo JText::_('edit'); ?>
								</a>
								<a title="<?php echo JText::_('remove file'); ?>" href="<?php echo JRoute::_('index.php?task=removefile&fid=' . $file->fid); ?>">
									<?php echo JText::_('remove'); ?>
								</a>
								<?php //TODO report file functionality ?>
							</div>-->
							<div class="dl_file_head">
								<a rel="nofollow" title="<?php echo JText::_('download this file'); ?>" href="<?php echo JRoute::_('index.php?task=download&fid=' . $file->fid); ?>">
									<?php echo $file->name; ?>
								</a>
							</div>
							<div class="dl_file_nfo">
								<span class="dl_file_nfo_label">
									<?php echo JText::_('Version:'); ?>
								</span>
								<?php echo $file->version; ?>
								<span class="dl_file_nfo_label">
									<img alt="<?php echo JText::_('Size:'); ?>" src="<?php echo $imgPath; ?>/size.gif" />
								</span>
								<?php echo ComDownloadsHelper::formatBytes($file->size); ?>
								<span class="dl_file_nfo_label">
									<img alt="<?php echo JText::_('Hits:'); ?>" src="<?php echo $imgPath; ?>/counter.gif" />
								</span>
								<?php echo $file->hits; ?>
							</div>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
	</div>
</div>
