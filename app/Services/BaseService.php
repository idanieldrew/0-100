<?php

namespace App\Services;

interface BaseService
{
    public function response(
        string $status,
        int    $code,
        string $msg,
        array  $data
    );
}
