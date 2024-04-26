<?php

namespace App\Controller;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/task')]
class TaskController extends AbstractController
{
    private TaskRepository $taskRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(TaskRepository $taskRepository, EntityManagerInterface $entityManager)
    {
        $this->taskRepository = $taskRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('edit/{id}&{result}', name:'app_edit_task_result')]
    public function editResult(int $id, int $result): Response
    {
        $task = $this->taskRepository->find($id);
        $task->setResult($result);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_graphic');
    }
}