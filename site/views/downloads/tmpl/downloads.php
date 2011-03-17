<?php defined('_JEXEC') or die('Restricted access');
//! expects $this->categories, ->downloads, ->downloadFiles ?>

<div id="com_download_wrap">
	<h1><?php echo JText::_('Downloads'); ?></h1>

	<h2><?php echo JText::_('Unter-Kategorien'); ?></h2>
	<?php if (count($this->categories) > 0) { ?>
		<ul class="dl_cat_list">
			<?php $this->printCategoryTree($this->categories); ?>
		</ul>
	<?php } ?>


	<?php
		if (!empty( $this->downloads )) {
			foreach ($this->downloads as $download) {
				include dirname(__FILE__).DS.'download.php';
			}
		}
		else {
			echo '<p>' . JText::_('No Downloads here yet.') . '</p>';
		}
	?>
</div>
<script type="text/javascript">
	/*<![CDATA[*/
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
	/*]]>*/
</script>
