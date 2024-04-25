<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use GuzzleHttp\Client;

#[Route('/api')]
class APIMetrikaController extends AbstractController
{
    #[Route('/{startDate}&{endDate}', name:'api_metrika')]
    public function index($startDate, $endDate): Response
    {
        $client = new Client();
        $result = $client->request('GET', "https://api-metrika.yandex.net/stat/v1/data/bytime?ids=17351206&metrics=ym:s:visits&group=day&date1=$startDate&date2=$endDate",[
            'headers' => [
                "Authorization" => 'OAuth y0_AgAAAABB48KGAAqiEgAAAAEALZL9AADyc_h_QPBB1p55oCgWMCFxtF31GA',
            ],
        ]);

        $body = $result->getBody();
        $result = json_decode($body, true);
        var_dump($result['totals']);
        var_dump($result['time_intervals']);

        return $this->render('APIMetrika/index.html.twig', [
        ]);
    }
}