<?php
namespace App\Http\Traits;

use Carbon\Carbon;

trait DateTimeTrait
{
    public function getCreatedAtAttribute($value)
    {
        return $this->formatDate($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->formatDate($value);
    }

    private function formatDate($date)
    {
        $carbonDate = new Carbon($date);
        return $carbonDate->format('Y-m-d');
    }
}