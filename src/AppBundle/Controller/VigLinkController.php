<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\{Response, Request};

class VigLinkController extends Controller
{
	public function keyAction(Request $request): Response
	{
		$sitename = $request->query->get('sitename');
		$siteId = $request->query->get('uuid');
		$apiKey = $request->query->get('key');

		if (!isset($sitename, $siteId, $apiKey))
		{
			throw new Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
		}

		$subId = md5($sitename . $siteId);
		$expiration = strtotime("+1 year");
		$key = $this->getParameter('viglink_api_key');
		$secretKey = $this->getParameter('viglink_secret_key');

		$url = ("https://www.viglink.com/users/convertAccount?key=" . $key . "&subId=" . $subId);
		$signature = hex(hash_hmac('md5', ($url . "-" . $expiration), $secretKey));

		$queryParams = http_build_query(
			['key' => $key,
			'subId' => $subId,
			'expiration' => $expiration,
			'signature' => $signature,]
		);

		$url = ('https://www.viglink.com/ursers/convertaccount' . $queryParams);

		$response = new Response($url);

		return $response;
	}
}
