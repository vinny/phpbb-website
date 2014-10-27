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
use Phpbb\WebsiteInterfaceBundle\Entity\Download;

class DownloadsController extends Controller
{
	public function homeAction(Request $request, $branch = '3.1')
	{
		$downloadManager = $this->get('phpbb.downloadManager');
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

		$versions = $downloadManager->getAvailableUpdateFromVersions();
		$packages = $downloadManager->generatePackages();

		$templateVariables += array(
			'versions' => $versions,
			'packages' => $packages,
		);

		return $this->render('PhpbbWebsiteInterfaceBundle::downloads.html.twig', $templateVariables);
	}

	public function downloadHandlerAction(Request $request, $package)
	{
		$download = new Download();
		$download->setConfigurableOptions($package, $request->getClientIp());
		$em = $this->getDoctrine()->getManager();
		$em->persist($download);
		$em->flush();

		return $this->redirect(('https://download.phpbb.com/pub/release/' . $package), 301);
	}

	public function downloadRedirectHandlerAction(Request $request, $branch = 'latest')
	{
		$downloadManager = new DownloadManager();
		$branch = ($branch == 'latest') ? '3.1' : $branch;
		$downloadManager->setBranch($branch);
		return $this->downloadHandlerAction($request, $downloadManager->getMainPackageName);
	}
}
