<?php
/**
 *
 * @package PhpbbWebsiteInterfaceBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace Phpbb\WebsiteInterfaceBundle\Tests\Controller;

use Phpbb\WebsiteInterfaceBundle\Tests\Controller;

class ExtensionsControllerTest extends BootstrapTestSuite
{
	public function testExtensionsMain()
	{
		$objs = $this->setupTest('/extensions/');
		$crawler = $objs['crawler'];

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Extensions') !== false, 'Title contains Extensions');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Extensions are completely self-contained")')->count() > 0, 'Extensions Home Content Check');
		$this->assertTrue($crawler->filter('html:contains("Extensions Policies")')->count() > 0, 'Extensions Sidebar Check');

		// Standard All Page Checks
		$this->globalTests();
	}
}
