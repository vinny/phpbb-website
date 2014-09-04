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
		$group_ids = array('styles_team_id ' => 7332, 'jrstyles_team_id' => 228778);
		$access_group_ids = array(228778, 7332, 13330, 4);
		$month_sel = $request->request->get('month', (int)date("m")); // TODO: test
		$year_sel  = $request->request->get('year', (int)date("Y")); // TODO: test

		// Only the Styles Team, Dev Team and Management Team/Administrators have access TODO
		/*if (!$user->data['is_registered'] || !group_memberships($access_group_ids, $user->data['user_id'], true))
		{
			trigger_error('You are not authorized to view this page.');
		}*/

		$stats = PhpbbHandling::getStyleValidationStatistics(
			$this->get('doctrine.dbal.phpbb_connection'),
			$this->container->getParameter('phpbb_database_prefix'),
			$cdb_prefix,
			$group_ids,
			$month_sel,
			$year_sel
		);

		$this->getDateLists($month_sel, $month_list, $year_sel, $year_list);

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

	private function getDateLists(&$month_sel, &$month_list, &$year_sel, &$year_list)
	{
		$month_list = $year_list = '';

		$months = array(
			1  => 'January',
			2  => 'February',
			3  => 'March',
			4  => 'April',
			5  => 'May',
			6  => 'June',
			7  => 'July',
			8  => 'August',
			9  => 'September',
			10 => 'October',
			11 => 'November',
			12 => 'December'
		);

		foreach ($months as $month_num => $month_name)
		{
			$month_list .= '<option value="' . $month_num . '"' . (($month_num == $month_sel) ? ' selected="selected"' : '') . '>' . $month_name . '</option>';
		}

		// We start at 2010 since that's when Titania went live
		for ($year_start = 2010; $year_start <= date("Y"); $year_start++)
		{
			$year_list .= '<option value="' . $year_start . '"' . (($year_start == $year_sel) ? ' selected="selected"' : '') . '>' . $year_start . '</option>';
		}

		$month_sel = $months[$month_sel];
	}
}
