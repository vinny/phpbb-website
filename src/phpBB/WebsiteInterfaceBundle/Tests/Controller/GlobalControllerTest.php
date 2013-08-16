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

        $crawler = $client->request('GET', '/');

        // Title Check
        $expectedTitle = array('phpBB', 'Free and Open Source Forum Software');

        $this->assertTrue(strpos(($crawler->filter('title')->first()->text()),
        	$expectedTitle[0]) !== false);
        $this->assertTrue(strpos(($crawler->filter('title')->first()->text()),
        	$expectedTitle[1]) !== false);

        // Standard All Page Checks
        // Footer Check
        $this->assertTrue($crawler->filter('html:contains("phpBB Limited")')->count() > 0);

        // Header Check
        $this->assertTrue($crawler->filter('html:contains("About")')->count() > 0);

        // Response Check
        $this->assertEquals($client->getResponse()->getStatusCode(), 200);
    }
}
