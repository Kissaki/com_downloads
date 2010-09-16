<?php

class ComDownloadsHelper {
	public static function formatBytes($bytes) {
		$formatted = '';
		if ($bytes > pow(2, 10)) {
			if ($bytes > pow(2, 20)) {
				$formatted .= number_format(($bytes / pow(2, 20)), 2);
				$formatted .= " MB";
			}
			else {
				$formatted .= number_format(($bytes / pow(2, 10)), 2);
				$formatted .= " KB";
			}
		}
		else {
			$formatted .= (string) $bytes." Bytes";
		}
		return $formatted;
	}
}
