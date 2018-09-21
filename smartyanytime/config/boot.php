<?php

	// マルチバイト処理の文字コード設定
	mb_language("japanese");
	mb_internal_encoding('utf-8');
	mb_regex_encoding('utf-8');
	mb_substitute_character(0x25A0);

?>