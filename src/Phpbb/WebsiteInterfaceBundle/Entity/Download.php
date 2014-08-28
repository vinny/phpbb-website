<?php
/**
 *
 * @package PhpbbWebsiteInterfaceBundle
 * @copyright (c) 2014 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace Phpbb\WebsiteInterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Download
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Download
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="download_time", type="datetime")
     */
    private $downloadTime;

    /**
     * @var string
     *
     * @ORM\Column(name="package", type="string", length=255)
     */
    private $package;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;

    /**
     * @var integer
     *
     * @ORM\Column(name="branch", type="smallint")
     */
    private $branch;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set downloadTime
     *
     * @param \DateTime $downloadTime
     * @return Download
     */
    public function setDownloadTime($downloadTime)
    {
        $this->downloadTime = $downloadTime;

        return $this;
    }

    /**
     * Get downloadTime
     *
     * @return \DateTime
     */
    public function getDownloadTime()
    {
        return $this->downloadTime;
    }

    /**
     * Set package
     *
     * @param string $package
     * @return Download
     */
    public function setPackage($package)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return string
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Download
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set branch
     *
     * @param integer $branch
     * @return Download
     */
    public function setBranch($branch)
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * Get branch
     *
     * @return integer
     */
    public function getBranch()
    {
        return $this->branch;
    }
}
