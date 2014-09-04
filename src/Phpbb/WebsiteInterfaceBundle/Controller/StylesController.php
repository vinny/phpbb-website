<?php
/**
 *
 * @package PhpbbWebsiteInterfaceBundle
 * @copyright (c) 2014 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author PayBas
 *
 */

namespace Phpbb\WebsiteInterfaceBundle\Controller;

use Phpbb\WebsiteInterfaceBundle\Wrappers\PhpbbHandling;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StylesController extends Controller
{
    public function homeAction()
    {
        $templateVariables = array(
            'header_css_image'		=> 'styles',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:Styles:home.html.twig', $templateVariables);
    }

    public function faqAction()
    {
        $templateVariables = array(
            'header_css_image'		=> 'styles faq',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:Styles:faq.html.twig', $templateVariables);
    }

    public function contributeAction()
    {
        $templateVariables = array(
            'header_css_image'		=> 'styles contribute',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:Styles:contribute.html.twig', $templateVariables);
    }

	public function sspAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'styles ssp',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:ssp.html.twig', $templateVariables);
	}

	public function statisticsAction(Request $request)
	{
		$cdb_prefix = 'customise_'; // TODO: get this from parameters.yml?
		$type = 2; // The Titania item type
		$group_ids = array(7332, 228778); // The first item is the primary group (styles team), the others are secondary
		$access_group_ids = array(228778, 7332, 13330, 4); // All groups that have access to the stats page
		$month_sel = $request->request->get('month', (int)date("m"));
		$year_sel  = $request->request->get('year', (int)date("Y"));

		// Only the Styles Team, Dev Team and Management Team/Administrators have access TODO
		/*if (!$user->data['is_registered'] || !group_memberships($access_group_ids, $user->data['user_id'], true))
		{
			trigger_error('You are not authorized to view this page.');
		}*/

		$stats = PhpbbHandling::getValidationStatistics(
			$this->get('doctrine.dbal.phpbb_connection'),
			$this->container->getParameter('phpbb_database_prefix'),
			$cdb_prefix,
			$type,
			$group_ids,
			$month_sel,
			$year_sel
		);

		PhpbbHandling::getDateFormLists($month_sel, $month_list, $year_sel, $year_list);

		$templateVariables = array(
			'header_css_image' => 'styles statistics',
			'month_sel'        => $month_sel,
			'month_list'       => $month_list,
			'year_sel'         => $year_sel,
			'year_list'        => $year_list,
			'stats'            => (isset($stats) && !empty ($stats)) ? $stats : false,
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:statistics.html.twig', $templateVariables);
	}
}
