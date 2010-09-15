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