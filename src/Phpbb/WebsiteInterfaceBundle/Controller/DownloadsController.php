<?php
/**
 *
 * @package PhpbbWebsiteInterfaceBundle
 * @copyright (c) 2014 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace Phpbb\WebsiteInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Phpbb\WebsiteInterfaceBundle\Utilities\DownloadManager;
use Symfony\Component\HttpFoundation\Request;

class DownloadsController extends Controller
{
	public function downloadsAction(Request $request, $branch = '3.1')
	{
		$downloadManager = new DownloadManager;
		$downloadManager->setBranch($branch);

		$templateVariables = array(
			'header_css_image'      => 'downloads',
		);

		// Find out if we are updating files and if we are, from what version
		$mode = ($request->get('update', 0)) ? 'update' : 'stable';

		$selected_version = $request->get('version', '');
		if (!empty($selected_version) && $mode == 'update')
		{
			$downloadManager->setUpdate($selected_version);
		}

		$downloadLink = 'https://www.phpbb.com/downloads/download/';
		$downloadManager->setDownloadLink($downloadLink);

		$versions = $downloadManager->getAvailableUpdateFromVersions();
		$packages = $downloadManager->generatePackages();

		//TODO: Get language pack details

		return $this->render('PhpbbWebsiteInterfaceBundle::downloads.html.twig', $templateVariables);
	}

	public function downloadHandler(Request $request, $package)
	{
	}

	public function downloadRedirectHandler(Request $request, $branch = 'latest')
	{
		$downloadManager = new DownloadManager;
		$branch = ($branch == 'latest') : '3.1' ? $branch;
		$downloadManager->setBranch($branch);
		return $this->downloadHandler($request, $this->downloadManager->getMainPackageName)
	}
}
