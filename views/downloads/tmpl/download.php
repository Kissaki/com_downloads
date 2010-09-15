<?php defined('_JEXEC') or die('Restricted access'); ?>
<div class="dl_download">
	<?php $dlDate = new JDate($download->date); ?>
	<div class="dl_topline">
		<div style="float: right;"><?php echo $download->nr_files; ?> Files, Last Update: <?php echo $dlDate->toFormat(); ?></div>
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
			<div class="dl_actions" style="float: right;">
				<a title="<?php echo JText::_('edit download'); ?>" href="<?php echo JRoute::_('index.php?task=editdownload&dlid=' . $download->dlid); ?>">
					<?php echo JText::_('edit'); ?>
				</a>
				<a title="<?php echo JText::_('remove download'); ?>" href="<?php echo JRoute::_('index.php?task=removedownload&dlid=' . $download->dlid); ?>">
					<?php echo JText::_('remove'); ?>
				</a>
			</div>
			<img alt="Platform:" src="http://dooc-clan.de/modules/mydownloads/images/platform.gif"/>
			<?php echo $download->platform; ?>
			<img alt="Homepage:" src="http://dooc-clan.de/modules/mydownloads/images/home.gif"/>
			<a rel="external" title="homepage of CCCP &ndash; Combined Community Codec Pack" href="http://www.cccp-project.net/" target="_blank">http://www.cccp-project.net/</a>
		</div>
		<hr style="border-top: 1px solid black;">
		<div style="margin-left: 4px;" class="dl_files">
			Files (1):
			<ul>
				<li style="border-top: 1px solid black;"><div style="float: right;"><a title="edit file Combined Community Codec Pack 2009-09-09" href="edit.php?fid=210">edit</a> <a title="remove file Combined Community Codec Pack 2009-09-09" href="remove.php?fid=210">remove</a></div><div style="height: 16px; line-height: 16px; background-image: url(&quot;images/download.png&quot;); background-repeat: no-repeat; padding-left: 20px;" class="dl_file">
									<a rel="nofollow" title="download Combined Community Codec Pack 2009-09-09" href="download.php?fid=210">Combined Community Codec Pack 2009-09-09</a>
								</div>
								<div style="margin-left: 20px;"><span style="font-weight: bold;">Version:</span> 2009-09-09 <span style="font-weight: bold;"><img alt="Size:" src="images/size.gif"></span> 5.95 MB <span style="font-weight: bold;"><img alt="Hits:" src="images/counter.gif"></span> 2</div>
							</li>					</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
	function toggle_dl(id) {
		if (document.getElementById(id)) {
			if (document.getElementById(id).style.display == 'block') {
				document.getElementById(id).style.display = 'none';
			}
			else {
				document.getElementById(id).style.display = 'block';
			}
		}
	}
	function collapse_all(classname) {
		var els = document.getElementsByTagName('div');
		for (var i=0; i < els.length; i++) {
			if (els[i].className == classname) {
				els[i].style.display = 'none';
			}
		}
	}
	function expand_all(classname) {
		var els = document.getElementsByTagName('div');
		for (var i=0; i < els.length; i++) {
			if (els[i].className == classname) {
				els[i].style.display = 'block';
			}
		}
	}
</script>
