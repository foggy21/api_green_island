<?php

namespace App\Controller;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api_bx24')]
class APIBX24Controller extends AbstractController
{
    #[Route('/{id}&{title}&{description}&{responsible_id}&{created_by}&{group_id}', 'app_bx24')]
    public function index($id, $title, $description, $responsible_id, $created_by, $group_id): Response
    {
        $client = new Client();
        $response = $client->post('https://gn-tst.ideavl.ru/rest/6482/ndke0n7gmd1yf3fs/task.item.add.json', [
            "json" => [
                'fields' => [
                    "TITLE" => $title,
                    "DESCRIPTION" => $description,
                    "RESPONSIBLE_ID" => $responsible_id, 
                    "CREATED_BY" => $created_by,
                    "GROUP_ID" => $group_id
                ]
            ]
        ]);
        $response = $response->getBody();
        $response_json = json_decode($response, true);
        $result = $response_json["result"];
        return $this->redirectToRoute('app_edit_task_result', [
            'id' => $id,
            'result' => $result,
        ]);
    }
}