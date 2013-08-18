<?php

// Theses tests check the test suite as opposed to the actual application

namespace phpBB\WebsiteInterfaceBundle\Tests;

class GeneralTest extends \PHPUnit_Framework_TestCase
{
    public function testGeneral()
    {
        $this->assertEquals(1, 1);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testFailingInclude()
    {
        include 'not_existing_file.php';
    }
}
