<?php
/* SVN FILE: $Id: campaign_fixture.php 25 2012-12-04 02:11:44Z arms $ */
/**
 * Short description for campaign_fixture.php
 *
 * Long description for campaign_fixture.php
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * @link          http://www.cakephp.org
 * @package       cake
 * @subpackage    cake.tests.fixtures
 * @since         1.2
 * @version       $Revision: 25 $
 * @modifiedby    $LastChangedBy: arms $
 * @lastmodified  $Date: 2012-12-04 11:11:44 +0900 (火, 04 12 2012) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * CampaignFixture class
 *
 * @package       cake
 * @subpackage    cake.tests.fixtures
 */
class CampaignFixture extends CakeTestFixture {
/**
 * name property
 *
 * @var string 'Campaign'
 * @access public
 */
	var $name = 'Campaign';
/**
 * fields property
 *
 * @var array
 * @access public
 */
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'name' => array('type' => 'string', 'length' => 255, 'null' => false),
	);
/**
 * records property
 *
 * @var array
 * @access public
 */
	var $records = array(
		array('name' => 'Hurtigruten'),
		array('name' => 'Colorline'),
		array('name' => 'Queen of Scandinavia')
	);
}

?>