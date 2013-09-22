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

class AboutControllerTest extends BootstrapTestSuite
{
	public function testAboutMain()
	{
		$client = static::createClient();
		$this->setClient($client);
		$client->enableProfiler();
		$crawler = $client->request('GET', '/about/');
		$response = $client->getResponse();
		$this->setupBootstrapping($client, $crawler, $response);

		// Title Check
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'About phpBB') !== false, 'Title contains About phpBB');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("Millions of people use phpBB on a daily basis, making it the most widely used open source bulletin board system in the world.")')->count() > 0, 'About Home Content Check');
		$this->assertTrue($crawler->filter('a:contains("The History")')->count() > 0, 'About Home Sidebar Check');
		$this->assertTrue($crawler->filter('html:contains("Project External Links")')->count() > 0, 'About Home Sidebar Check 2');

		// Standard All Page Checks
		$this->globalTests();
	}
}
