<?php

namespace App\Controller;
use App\Form\DateForm;
use App\Service\DateFormaterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/")]
class DateController extends AbstractController
{
    #[Route('/', name:'app_date')]
    public function index(Request $request, DateFormaterService $dateFormater): Response
    {
        $form = $this->createForm(DateForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $dates = $dateFormater->getDatesFromForm($form);
            return $this->redirectToRoute('api_metrika',[
                'startDate' => $dates['startDate'],
                'endDate' => $dates['endDate'],
            ]);
        }
        return $this->render('date/index.html.twig', [
            'form' => $form,
        ]);
    }
}