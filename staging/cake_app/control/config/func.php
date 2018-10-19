<?php

/**
 * rm() -- Vigorously erase files and directories.
 * 
 * @param $fileglob mixed If string, must be a file name (foo.txt), glob pattern (*.txt), or directory name.
 *                        If array, must be an array of file names, glob patterns, or directories.
 */
function rm($fileglob) {
	if (is_string($fileglob)) {
		if (is_file($fileglob)) {
			return unlink($fileglob);
		}
		else if (is_dir($fileglob)) { // ディレクトリは削除しない
			return false;
		}
		else {
			$matching = glob($fileglob);
			if ($matching === false) {
				return false;
			}
			$rcs = array_map('rm', $matching);
			if (in_array(false, $rcs)) {
				return false;
			}
		}
	}
	else if (is_array($fileglob)) {
		$rcs = array_map('rm', $fileglob);
		if (in_array(false, $rcs)) {
			return false;
		}
	}
	else {
		return false;
	}

	return true;
}


?>