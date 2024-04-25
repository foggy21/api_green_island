<?php

namespace App\Controller;
use App\Entity\Metric;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/graphic')]
class GraphicController extends AbstractController
{
    #[Route('/', name:'app_graphic')]
    public function index(SessionInterface $session): Response
    {
        $metric = $session->get('session_metric');
        $dateInterval = $metric->getInterval();
        $totals = $metric->getTotals();
        return $this->render('graphic/index.html.twig', [
            'dateInterval' => $dateInterval,
            'totals' => $totals,
        ]);
    }
}