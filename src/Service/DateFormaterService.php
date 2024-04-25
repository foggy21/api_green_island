<?php

namespace App\Service;
use Symfony\Component\Form\FormInterface;

class DateFormaterService
{
    public function getDatesFromForm(FormInterface $form): array
    {
        $rawDates = array(
            'startDate' => $form->get('startDate')->getViewData(),
            'endDate' => $form->get('endDate')->getViewData(),
        );
        return $this->formatDates($rawDates);
    }

    private function formatDates(array $dates): array
    {
        foreach ($dates as $date=>$parts)
        {
            $dates[$date] = $parts['year'] . '-' . $parts['month'] . '-' . $parts['day'];
        }
        return $dates;
    }
}