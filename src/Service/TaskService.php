<?php

namespace App\Service;
use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;

class TaskService
{
    private EntityManagerInterface $entityManager;
    private TaskRepository $taskRepository;

    public function __construct(EntityManagerInterface $entityManager, TaskRepository $taskRepository)
    {
        $this->entityManager = $entityManager;
        $this->taskRepository = $taskRepository;
    }

    public function save(Task $task): void
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    public function getNeedleTasksFromDates(array $dates): array
    {
        $needleTasks = array();
        foreach($this->taskRepository->findAllSortByStartDate() as $task)
        {
            if (in_array($task->getStartDate(), $dates))
            {
                $needleTasks[] = 
                [
                    'title' => $task->getTitle(),
                    'description' => $task->getDescription(),
                    'start_date' => $task->getStartDate(),
                    'end_date' => $task->getEndDate()->format('Y-m-d'),
                    'result' => $task->getResult()
                ];
            }
        }
        return $needleTasks;
    }
}