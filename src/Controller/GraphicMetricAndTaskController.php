<?php

namespace App\Controller;
use App\Entity\Task;
use App\Form\TaskType;
use App\Service\TaskService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/graphic')]
class GraphicMetricAndTaskController extends AbstractController
{
    #[Route('/', name:'app_graphic')]
    public function index(Request $request, SessionInterface $session, TaskService $taskService): Response
    {
        $metric = $session->get('session_metric');
        $dateInterval = $metric->getInterval();
        $totals = $metric->getTotals();

        $needleTasks = $taskService->getNeedleTasksFromDates($dateInterval);

        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $taskService->save($task);

            return $this->redirectToRoute('app_bx24', [
                'id' => $task->getId(),
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