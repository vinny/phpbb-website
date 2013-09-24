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

class GlobalControllerTest extends BootstrapTestSuite
{
	public function testIndexMain()
	{
		$client = static::createClient();
		$this->setClient($client);

		$symfony_tables = array();
		$phpbb_tables = array('community_topics', 'community_posts');
		$this->setupDatabase($symfony_tables, $phpbb_tables);

		$client->enableProfiler();
		$crawler = $client->request('GET', '/');
		$response = $client->getResponse();
		$this->setupBootstrapping($client, $crawler, $response);

		// Title Check
		$expectedTitle = array('phpBB', 'Free and Open Source Forum Software');

		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), $expectedTitle[0]) !== false, 'Title contains phpBB');
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()), $expectedTitle[1]) !== false, 'Title contains Free and Open Source Forum Software');

		// Content Check
		$this->assertTrue($crawler->filter('html:contains("THE #1 FREE, OPEN SOURCE BULLETIN BOARD SOFTWARE")')->count() > 0, 'Homepage Content Check');

		// Standard All Page Checks
		$this->globalTests();
	}

	/**
	 * @depends testIndexMain
	 */
	public function testIndexAnnouncements()
	{
		$client = static::createClient();
		$this->setClient($client);

		$symfony_tables = array();
		$phpbb_tables = array('community_topics', 'community_posts');
		$this->setupDatabase($symfony_tables, $phpbb_tables);

		$client->enableProfiler();
		$crawler = $client->request('GET', '/');
		$response = $client->getResponse();
		$this->setupBootstrapping($client, $crawler, $response);

		$this->assertTrue($crawler->filter('html:contains("Lorem ipsum dolor sit amet")')->count() > 0, 'Announcement Content Check');
		$this->assertTrue($crawler->filter('html:contains("another")')->count() > 0, 'Announcement Title Check 1');
		$this->assertTrue($crawler->filter('html:contains("third")')->count() > 0, 'Announcement Title Check 2');
		$this->assertTrue($crawler->filter('html:contains("show")')->count() > 0, 'Announcement Title Check 3');
		$this->assertFalse($crawler->filter('html:contains("this should not show if it does die")')->count() > 0, 'Announcement Only Three Check');
	}
}
