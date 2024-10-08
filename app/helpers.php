<?php

use Illuminate\Database\Eloquent\Model;

if (!function_exists('generateUniqueID')) {
    function generateUniqueID(Model $model, $idFieldName)
    {
        $currentDate = now();
        $yearMonth = $currentDate->format('ym');

        $latestRecord = $model->max($idFieldName);

        $lastID = ($latestRecord !== null && substr($latestRecord, 0, 4) == $yearMonth)
            ? $latestRecord + 1
            : $yearMonth . '0001';

        return $lastID;
    }
}

if (!function_exists('numberFormat')) {
    function numberFormat($value)
    {

        return number_format((float) $value, 2);
      
    }
}