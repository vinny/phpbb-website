<?php
/**
 * Created by PhpStorm.
 * User: battye
 * Date: 28/06/2014
 * Time: 4:47 PM
 */

namespace Phpbb\WebsiteInterfaceBundle\Helper\Extensions;

// A simple helper class to help us iterate through officially sanctioned extensions
class OfficialExtension
{
    protected $name;
    protected $description;
    protected $descriptionForDevelopers;
    protected $contribution;
    protected $github;

    public function __construct($name, $description, $descriptionForDevelopers, $contribution, $github)
    {
        $this->name = $name;
        $this->description = $description;
        $this->descriptionForDevelopers = $descriptionForDevelopers;
        $this->contribution = $contribution;
        $this->github = $github;
    }

    // Name of the extension
    public function getName()
    {
        return $this->name;
    }

    // Description of the extension
    public function getDescription()
    {
        return $this->description;
    }

    // Extra information for developers
    public function getDescriptionForDevelopers()
    {
        return $this->descriptionForDevelopers;
    }

    // Link to the contribution page
    public function getContribution()
    {
        return $this->contribution;
    }

    // Link to the GitHub repository
    public function getGithub()
    {
        return $this->github;
    }
} 