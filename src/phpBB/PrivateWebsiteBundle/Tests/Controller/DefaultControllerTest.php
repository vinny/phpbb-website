<?php
/**
 * 
 * @package phpBBPrivateWebsiteBundle
 * @copyright (c) 2012 phpBB Group
 * @license Not for re-distribution
 * @author Unknown Bliss
 * 
 */

namespace phpBB\PrivateWebsiteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hello/Fabien');

        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    }
}
