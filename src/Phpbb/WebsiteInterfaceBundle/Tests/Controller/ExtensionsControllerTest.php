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
        $this->assertTrue($crawler->filter('html:contains("Extensions are the natural successor to modifications")')->count() > 0, 'Extensions Home Content Check');
        $this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

        // Standard All Page Checks
        $this->globalTests();
    }

    public function testExtensionsRules()
    {
        $objs = $this->setupTest('/extensions/rules-and-guidelines/');
        $crawler = $objs['crawler'];

        // Title Check
        $this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Rules and Guidelines') !== false, 'Title contains Extensions Rules and Guidelines');

        // Content Check
        $this->assertTrue($crawler->filter('html:contains("Licensing your Extension")')->count() > 0, 'Extensions Home Content Check');
        $this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

        // Standard All Page Checks
        $this->globalTests();
    }

    public function testExtensionsRecDevs()
    {
        $objs = $this->setupTest('/extensions/recognised-developer/');
        $crawler = $objs['crawler'];

        // Title Check
        $this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Recognised Extension Developer') !== false, 'Title contains Recognised Extension Developer');

        // Content Check
        $this->assertTrue($crawler->filter('html:contains("Do you write great code?")')->count() > 0, 'Extensions Home Content Check');
        $this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

        // Standard All Page Checks
        $this->globalTests();
    }

    public function testExtensionsOfficialExts()
    {
        $objs = $this->setupTest('/extensions/official-extensions/');
        $crawler = $objs['crawler'];

        // Title Check
        $this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Official Extensions') !== false, 'Title contains Official Extensions');

        // Content Check
        $this->assertTrue($crawler->filter('html:contains("These are extensions created and maintained by the")')->count() > 0, 'Extensions Home Content Check');
        $this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

        // Standard All Page Checks
        $this->globalTests();
    }

    public function testExtensionsOfficialExtsTeam()
    {
        $objs = $this->setupTest('/extensions/official-extensions/team/');
        $crawler = $objs['crawler'];

        // Title Check
        $this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Extensions Development Team') !== false, 'Title contains Extensions Development Team');

        // Content Check
        $this->assertTrue($crawler->filter('html:contains("The Extensions Development Team are extension Authors that work under the mentorship of the Extensions Team to create")')->count() > 0, 'Extensions Home Content Check');
        $this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

        // Standard All Page Checks
        $this->globalTests();
    }

    public function testExtensionsInstalling()
    {
        $objs = $this->setupTest('/extensions/installing/');
        $crawler = $objs['crawler'];

        // Title Check
        $this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Installing Extensions') !== false, 'Title contains Installing Extensions');

        // Content Check
        $this->assertTrue($crawler->filter('html:contains("Installing an Extension")')->count() > 0, 'Extensions Home Content Check');
        $this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

        // Standard All Page Checks
        $this->globalTests();
    }

    public function testExtensionsWriting()
    {
        $objs = $this->setupTest('/extensions/writing/');
        $crawler = $objs['crawler'];

        // Title Check
        $this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Writing Extensions') !== false, 'Title contains Writing Extensions');

        // Content Check
        $this->assertTrue($crawler->filter('html:contains("How to write an extension")')->count() > 0, 'Extensions Home Content Check');
        $this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

        // Standard All Page Checks
        $this->globalTests();
    }

    public function testExtensionsTeamOverViews()
    {
        $objs = $this->setupTest('/extensions/team-overview/');
        $crawler = $objs['crawler'];

        // Title Check
        $this->assertTrue(strpos(($crawler->filter('title')->first()->text()), 'Extensions Team Overview') !== false, 'Title contains Extensions Team Overview');

        // Content Check
        $this->assertTrue($crawler->filter('html:contains("The Extensions Team oversees all activities on phpBB.com with relation to extensions")')->count() > 0, 'Extensions Home Content Check');
        $this->assertTrue($crawler->filter('html:contains("Extensions Team")')->count() > 0, 'Extensions Sidebar Check');

        // Standard All Page Checks
        $this->globalTests();
    }
}
