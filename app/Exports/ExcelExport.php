<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExport implements FromArray, WithMapping, WithHeadings, ShouldAutoSize
{
    protected $rows;

    protected $headings;

    public function __construct(array $rows, array $headings)
    {
        $this->rows = $rows;
        $this->headings = $headings;
    }

    function array(): array
    {
        return $this->rows;
    }

    public function map($row): array
    {
        return [
            ...$row
        ];
    }

    public function headings(): array
    {
        return $this->headings;
    }
}
