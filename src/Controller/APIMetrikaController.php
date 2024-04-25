<?php

namespace App\Controller;
use App\Service\MetricFormaterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use GuzzleHttp\Client;

#[Route('/api_metrika')]
class APIMetrikaController extends AbstractController
{
    #[Route('/{startDate}&{endDate}', name:'api_metrika')]
    public function index($startDate, $endDate, MetricFormaterService $metricFormater, SessionInterface $session): Response
    {
        $client = new Client();
        $response = $client->request('GET', "https://api-metrika.yandex.net/stat/v1/data/bytime?ids=17351206&metrics=ym:s:visits&group=day&date1=$startDate&date2=$endDate",[
            'headers' => [
                "Authorization" => 'OAuth y0_AgAAAABB48KGAAqiEgAAAAEALZL9AADyc_h_QPBB1p55oCgWMCFxtF31GA',
            ],
        ]);

        $body = $response->getBody();
        $response = json_decode($body, true);
        $metric = $metricFormater->createMetricWithFormatData($response['totals'][0], $response['time_intervals']);
        $session->set('session_metric', $metric);
        return $this->redirectToRoute('app_graphic');
    }

    
}