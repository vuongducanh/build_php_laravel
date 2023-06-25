<?php

// File: helpers.php

if (!function_exists('formatApiResponse')) {
    function formatApiResponse($data, $currentPage, $perPage, $total)
    {
        return [
            'data' => $data,
            'meta' => [
                'current_page' => $currentPage,
                'per_page' => $perPage,
                'total' => $total
            ]
        ];
    }
}
