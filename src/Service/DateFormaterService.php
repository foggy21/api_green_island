<?php

namespace App\Service;

class DateFormaterService
{
    public function formatDates(array $dates): array
    {
        foreach ($dates as $date=>$parts)
        {
            $dates[$date] = $parts['year'] . '-' . $parts['month'] . '-' . $parts['day'];
        }
        return $dates;
    }
}