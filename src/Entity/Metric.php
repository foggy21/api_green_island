<?php

namespace App\Entity;


class Metric
{
    private ?array $totals = null;
    private ?array $interval = null;

    public function getTotals(): ?array
    {
        return $this->totals;
    }

    public function setTotals(array $totals): static
    {
        $this->totals = $totals;

        return $this;
    }

    public function getInterval(): ?array
    {
        return $this->interval;
    }

    public function setInterval(array $interval): static
    {
        $this->interval = $interval;

        return $this;
    }
}