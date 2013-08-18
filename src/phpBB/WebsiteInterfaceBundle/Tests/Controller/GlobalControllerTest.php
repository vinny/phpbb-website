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

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GlobalControllerTest extends WebTestCase
{
	public function testIndex()
	{
		$client = static::createClient();
		$client->enableProfiler();
		$crawler = $client->request('GET', '/');
		$response = $client->getResponse();

		// Title Check
		$expectedTitle = array('phpBB', 'Free and Open Source Forum Software');

		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()),$expectedTitle[0]) !== false, 'Title contains phpBB');
		$this->assertTrue(strpos(($crawler->filter('title')->first()->text()),$expectedTitle[1]) !== false, 'Title contains Free and Open Source Forum Software');

		// Standard All Page Checks
		$this->reusableTests($client, $crawler, $response);
	}

	private function reusableTests($client, $crawler, $response, $status = 200, $queries = 20, $time = 50000)
	{
		// Footer Check
		$this->assertTrue($crawler->filter('html:contains("phpBB Limited")')->count() > 0);

		// Header Check
		$this->assertTrue($crawler->filter('html:contains("About")')->count() > 0);

		// Ads Check
		$this->assertTrue($crawler->filter('html:contains("advertisements")')->count() > 0);

		// Response Check
		$this->assertEquals($response->getStatusCode(), $status);

		if ($profile = $client->getProfile())
		{
			// Shouldn't really have more than 20 queries on any page
			$this->assertLessThan(
				$queries,
				$profile->getCollector('db')->getQueryCount(),
				('Checks that query count is less than' . $queries . ' (token ' .  $profile->getToken() .')')
			);

			// Time spent in framework. Set for slow machines.
			// If it's longer than $this ever we have a problem.
			$this->assertLessThan(
				$time,
				$profile->getCollector('time')->getDuration(),
				('Checks that $time is less than' . $time . ' (token ' .  $profile->getToken() .')')
			);
		}
	}
}
