<?php

namespace App\Service;
use App\Entity\Metric;

class MetricFormaterService
{

    public function createMetricWithFormatData(array $totals, array $timeInterval): Metric
    {
        $metric = new Metric();
        $totals = $this->formatTotalMetrics($totals);
        $dateInterval = $this->formatTimeIntervals($timeInterval);
        return $metric->setTotals($totals)->setInterval($dateInterval);
    }

    public function formatTotalMetrics(array $totals): array
    {
        return $totals;
    }

    public function formatTimeIntervals(array $timeIntervals): array
    {
        $newTimeIntervals = array();
        foreach ($timeIntervals as $timeInterval) {
            $newTimeIntervals[] = $timeInterval[0];
        }
        return $newTimeIntervals;
    }
}