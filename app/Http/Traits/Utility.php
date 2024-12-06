<?php

namespace App\Http\Traits;

trait Utility
{
    public function getPaginationData($data) {
        $paginationData = [
            'first_page_url' => $data['first_page_url'] ?? null,
            'last_page_url'  => $data['last_page_url'] ?? null,
            'from' => $data['from'] ?? null,
            'last_page' => $data['last_page'] ?? null,
            'last_page_url' => $data['last_page_url'] ?? null,
            'links'         => $data['links'],
            'next_page_url' => $data['next_page_url'],
            'path'          => $data['path'],
            'per_page' => $data['per_page'] ?? null,
            'prev_page_url' => $data['prev_page_url'] ?? null,
            'current_page' => $data['current_page'] ?? null,
            'to' => $data['to'] ?? null,
            'total' => $data['total'] ?? null,
        ];

        return $paginationData;
    }
}
