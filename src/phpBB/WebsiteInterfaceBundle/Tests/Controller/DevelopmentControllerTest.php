<?php
/**
 *
 * @package phpBBWebsiteInterfaceBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace phpBB\WebsiteInterfaceBundle\Tests\Controller;

use phpBB\WebsiteInterfaceBundle\Tests\Controller;

class DevelopmentControllerTest extends BootstrapTestSuite
{
	public function testDevelopmentMain()
	{
		$client = static::createClient();
		$this->setClient($client);
		$client->enableProfiler();
		$crawler = $client->request('GET', '/development/');
		$response = $client->getResponse();
		$this->setupBootstrapping($client, $crawler, $response);

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Development') !== false, 'Title contains Development');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("bug tracker, testing infrastructure, a wiki, a discussion board and various other helpful development tools. Visit this site to get involved in phpBB development.")')->count() > 0, 'Development Home Content Check');

		// Sidebar Check
		$this->assertTrue($crawler->filter('html:contains("To receive information on new releases of phpBB as they become available you are advised to subscribe to our mailing list.")')->count() > 0, 'Development Home Sidebar Check 1');
		$this->assertTrue($crawler->filter('html:contains("Designing prosilver")')->count() > 0, 'Development Home Sidebar Check 2');
		$this->assertTrue($crawler->filter('html:contains("check out our sponsor")')->count() > 0, 'Development Home Sidebar Check 3');
		$this->assertTrue($crawler->filter('div.carbonad')->count() == 1, 'Check for Carbon Ads');

		// Standard All Page Checks
		$this->globalTests();

		// @TODO Test the Release Notification Box
	}
}
