<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class VigLinkController extends Controller
{
	public function keyAction(Request $request)
	{
		$sitename = $request->query->get('sitename');
		$siteId = $request->query->get('uuid');
		$apiKey = $request->query->get('key');

		if (!isset($sitename, $siteId, $apiKey))
		{
			var_dump('404');
			throw new Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
		}

		$subId = md5($sitename . $siteId);
		$expiration = strtotime("+1 year");
		$key = $this->container->hasParameter('viglink_api_key') ? $this->getParameter('viglink_api_key') : $apiKey;

		if (!$this->container->hasParameter('viglink_secret_key')) {
			throw new Exception('Viglink is not enabled');
		}

		$secretKey = $this->getParameter('viglink_secret_key');

		$url = ("https://www.viglink.com/users/convertAccount?key=" . $key . "&subId=" . $subId);
		$signature = bin2hex(hash_hmac('md5', ($url . "-" . $expiration), $secretKey));

		$queryParams = http_build_query(
			['key' => $key,
			'subId' => $subId,
			'expiration' => $expiration,
			'signature' => $signature,]
		);

		$url = ('https://www.viglink.com/users/convertAccount?' . $queryParams);

		$response = new Response($url);

		var_dump($url);

		return $response;
	}
}
