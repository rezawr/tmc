<?php

namespace App\Pagination;

use Illuminate\Pagination\LengthAwarePaginator;

class CustomPaginator extends LengthAwarePaginator
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray() : array
    {
        return [
            'data' => $this->items->toArray(),
            'paging' => [
                'size'     => $this->perPage(),
                'total'       => $this->lastPage(),
                'current' => $this->currentPage(),
            ],
        ];
    }
}