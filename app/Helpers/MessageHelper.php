<?php

if (!function_exists('messageHandler')) {
    function messageHandler(string $message, string $resourceKey = ''): string
    {
        if (!empty($resourceKey)) {
            $message = trans($message, ['resource' => trans($resourceKey)]);
        } else {
            $message = trans($message);
        }

        return $message;
    }
}

