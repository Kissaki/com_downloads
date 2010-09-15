<?php defined('_JEXEC') or die('Restricted access'); ?>

<div id="com_download_wrap">
	<h1>Downloads</h1>

	<h2>Kategorien (BSP)</h2>
	<ul class="dl_cat_list">
		<li>
			<a href="index.php">Downloads</a>
			<ul class="dl_cat_list">
				<li><a href="?cat=1">Enemy Territory</a>
						<ul class="dl_cat_list">
							<li><a href="?cat=2">Maps</a></li>
							<li><a href="?cat=11">Mods</a></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>


	<?php
		foreach ($this->downloads as $download) {
			include dirname(__FILE__).DS.'download.php';
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
