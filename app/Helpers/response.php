<?php

function response_api(string $status, int $code, string $message, $data): array
{
    return [
        'status' => $status,
        'code' => $code,
        'message' => $message,
        'data' => $data ?: null,
    ];
}
