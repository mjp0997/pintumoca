<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ProductImport implements ToCollection, WithHeadingRow
{
    protected $data = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $product = [
                ...collect($row)->filter(function($value, $key) {
                    return !is_numeric($key);
                })
            ];

            $this->data[] = $product;
        }
    }

    public function getProducts()
    {
        return $this->data;
    }
}
