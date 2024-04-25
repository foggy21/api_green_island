<?php

namespace App\Controller;
use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/graphic')]
class GraphicMetricAndTaskController extends AbstractController
{
    #[Route('/', name:'app_graphic')]
    public function index(Request $request, SessionInterface $session, TaskRepository $taskRepository, EntityManagerInterface $entityManager): Response
    {
        $metric = $session->get('session_metric');
        $dateInterval = $metric->getInterval();
        $totals = $metric->getTotals();

        $needleTasks = [];
        foreach($taskRepository->findAll() as $task)
        {
            if (in_array($task->getStartDate(), $dateInterval))
            {
                $needleTasks[] = 
                [
                    'title' => $task->getTitle(),
                    'description' => $task->getDescription(),
                    'start_date' => $task->getStartDate(),
                    'end_date' => $task->getEndDate()->format('Y-m-d'),
                    'reward' => $task->getReward()
                ];
            }
        }

        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('app_bx24', [
                'title' => $task->getTitle(),
                'description' => $task->getDescription(),
                'responsible_id' => $task->getResponsible()->getId(),
                'created_by' => $task->getCreatedBy()->getId(),
                'group_id' => $task->getSquad()->getId()
            ]);
        }

        return $this->render('graphic/index.html.twig', [
            'dateInterval' => $dateInterval,
            'totals' => $totals,
            'needleTasks' => $needleTasks, 
            'form' => $form,
        ]);
    }
}