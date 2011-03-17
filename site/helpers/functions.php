<?php

class DownloadsHelper
{
	function getCategories($cid=0){
		$categories = array();
		$query = 'SELECT * FROM '.TABLE_PREFIX.'categories WHERE `pid` = '.mysql_real_escape_string((int)$cid).';';
		$result = mysql_query($query);
		while($row = mysql_fetch_assoc($result))
			$categories[] = $row;
		return $categories;
	}

	function getCategoriesArray($cid=0){
		$categories = array();
		$query = 'SELECT * FROM '.TABLE_PREFIX.'categories WHERE `pid` = '.mysql_real_escape_string((int)$cid).';';
		$result = mysql_query($query);
		while($row = mysql_fetch_assoc($result)){
			$subs = getCategoriesArray($row['cid']);
			if(count($subs)>0)
				$row['subcategories'] = $subs;
			$categories[] = $row;
		}
		return $categories;
	}

	function getCategoryParents($cid){
		if(!isset($cid))return;
		$query = 'SELECT cid, name, pid FROM '.TABLE_PREFIX.'categories WHERE `cid` = '.mysql_real_escape_string((int)$cid).';';
		$result = mysql_query($query) or die(mysql_error());
		if($row = mysql_fetch_assoc($result))
			return getCategoryParents($row['pid']).' -> <a href="index.php?cid='.$row['cid'].'">'.$row['name'].'</a>';
		else
			return '<a href="index.php?cid=0">Downloads</a>';
	}

	function list_categories($categories, $mylevel=0){
		foreach($categories AS $key=>$tmp_cat){
			$level = $mylevel * 4;
			echo '<ul class="dl_cat_list" style="border-left:1px solid orange; margin-left:8px; padding-left:2px;">';
			echo '<li><a href="?cat='.$tmp_cat['cid'].'">'.$tmp_cat['name'].'</a></li>';
			if(isset($tmp_cat['subcategories']))
				list_categories($tmp_cat['subcategories'], $mylevel+1);
			echo '</ul>';
		}
	}

	function list_categories_checkeddlcid($categories, $dl_cid, $mylevel=0){
		foreach($categories AS $key=>$tmp_cat){
			$level = $mylevel;
			echo '<option value="'.$tmp_cat['cid'].'"'; if($tmp_cat['cid']==$dl_cid)echo ' selected=""'; echo '>'; while($level>0){ echo'--'; $level--; } echo$tmp_cat['name'].'</option>';
			if(isset($tmp_cat['subcategories']))
				list_categories_checkeddlcid($tmp_cat['subcategories'], $dl_cid, $mylevel+1);
		}
	}

	/*function listCategories($parse_string, $parse_name, $cid=0){
		$categories = array();
		$categories[] = getCategories($cid);
		if(count($categories)>0){
			foreach($categories AS $key=>eval("return \$$parse_name;")){
				eval($parse_string);
				listCategories($parse_string, $parse_name, eval("return \$$parse_name;")['cid']);
			}
		}
	}*/

	function getDownloadIdList(){
		$query_orderby = 'name';
		$query_order = 'DESC';
		$query = 'SELECT dlid, name FROM '.TABLE_PREFIX.'downloads ORDER BY '.$query_orderby.' '.$query_order.';';
		$result = mysql_query($query) or die(mysql_error());
		while($row = mysql_fetch_assoc($result)){
			$downloads[] = $row;
		}
		return $downloads;
	}

	function getDownloadOptionList($downloads, $dlid){
		foreach($downloads AS $key=>$dl){
			echo '<option value="'.$dl['dlid'].'"'; if($dl['dlid']==$dlid) echo 'selected=""'; echo '>'.$dl['name'].'</option>';
		}
	}

	function getDownloads($cid=''){
		$query_cat = ''; if($_GET['cat']!='') $query_cat = 'WHERE `cid`='.mysql_real_escape_string($_GET['cat']);
		$query_orderby = 'name'; if($_GET['orderby']!='') $query_orderby = mysql_real_escape_string($_GET['orderby']);
		$query_order = 'ASC'; if($_GET['order']!='') $query_order = mysql_real_escape_string($_GET['order']);
		$query = 'SELECT * FROM '.TABLE_PREFIX.'downloads '.$query_cat.' ORDER BY '.$query_orderby.' '.$query_order.';';
		$result = mysql_query($query) or die(mysql_error());
		while($row = mysql_fetch_assoc($result)){
			$result_f = mysql_query('SELECT * FROM '.TABLE_PREFIX.'files WHERE `dlid` = '.$row['dlid'].' ORDER BY version DESC, `order` DESC;');
			unset($files);
			while($row_f = mysql_fetch_assoc($result_f))
				$files[] = $row_f;
			$row['files'] = $files;
			$downloads[] = $row;
		}
		return $downloads;
	}

	function getRecentDownloads($nr=10){
		$query_orderby = 'date';
		$query_order = 'DESC';
		$query = 'SELECT * FROM '.TABLE_PREFIX.'downloads ORDER BY '.$query_orderby.' '.$query_order.' LIMIT '.$nr.';';
		$result = mysql_query($query) or die(mysql_error());
		while($row = mysql_fetch_assoc($result)){
			$result_f = mysql_query('SELECT * FROM '.TABLE_PREFIX.'files WHERE `dlid` = '.$row['dlid'].' ORDER BY `order` ASC, version DESC;');
			unset($files);
			while($row_f = mysql_fetch_assoc($result_f))
				$files[] = $row_f;
			$row['files'] = $files;
			$downloads[] = $row;
		}
		return $downloads;
	}

	function getDownload($dlid){
		if(!isset($dlid))return;
		$query = 'SELECT * FROM '.TABLE_PREFIX.'downloads WHERE dlid = '.mysql_real_escape_string($dlid).';';
		$result = mysql_query($query) or die(mysql_error());
		$download = mysql_fetch_assoc($result);

		$result_f = mysql_query('SELECT * FROM '.TABLE_PREFIX.'files WHERE `dlid` = '.$download['dlid'].' ORDER BY `order` ASC, version DESC;') or die(mysql_error());
		unset($files);
		while($row_f = mysql_fetch_assoc($result_f))
			$files[] = $row_f;
		$download['files'] = $files;
		return $download;
	}

	function getDownloadName($dlid){
		if(!isset($dlid))return;
		$query = 'SELECT name FROM '.TABLE_PREFIX.'downloads WHERE dlid = '.mysql_real_escape_string($dlid).' LIMIT 1;';
		$result = mysql_query($query) or die(mysql_error());
		$download = mysql_fetch_assoc($result);
		return $download['name'];
	}

	function getFileName($fid){
		if(!isset($dlid))return;
		$query = 'SELECT name FROM '.TABLE_PREFIX.'files WHERE fid = '.mysql_real_escape_string($fid).';';
		$result = mysql_query($query) or die(mysql_error());
		$file = mysql_fetch_assoc($result);
		return $file['name'];
	}

	function byte2($bytes) {
		if ($bytes > pow(2,10)){
			if ($bytes > pow(2,20)){
				$size = number_format(($bytes / pow(2,20)), 2);
				$size .= " MB";
				return $size;
			}else{
				$size = number_format(($bytes / pow(2,10)), 2);
				$size .= " KB";
				return $size;
			}
		}else{
			$size = (string)$bytes . " Bytes";
			return $size;
		}
	}
}