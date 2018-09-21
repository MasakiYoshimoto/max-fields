;<?php exit() ?>
; SVN FILE: $Id: acl.ini.php 25 2012-12-04 02:11:44Z arms $
;/**
; * Test App Ini Based Acl Config File
; *
; *
; * PHP versions 4 and 5
; *
; * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
; * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
; *
; *  Licensed under The MIT License
; *  Redistributions of files must retain the above copyright notice.
; *
;; * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
; * @link          http://cakephp.org CakePHP(tm) Project
; * @package       cake
; * @subpackage    cake.app.config
; * @since         CakePHP(tm) v 0.10.0.1076
; * @version       $Revision: 25 $
; * @modifiedby    $LastChangedBy: arms $
; * @lastmodified  $Date: 2012-12-04 11:11:44 +0900 (火, 04 12 2012) $
; * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
; */

;-------------------------------------
;Users
;-------------------------------------

[admin]
groups = administrators
allow =
deny = ads

[paul]
groups = users
allow =
deny =

[jenny]
groups = users
allow = ads
deny = images, files

[nobody]
groups = anonymous
allow =
deny =

;-------------------------------------
;Groups
;-------------------------------------

[administrators]
deny =
allow = posts, comments, images, files, stats, ads

[users]
allow = posts, comments, images, files
deny = stats, ads

[anonymous]
allow =
deny = posts, comments, images, files, stats, ads