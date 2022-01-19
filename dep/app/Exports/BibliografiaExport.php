<?php

namespace App\Exports;

use App\Models\BibliografiaDigital;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BibliografiaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BibliografiaDigital::all();
    }
    public function headings(): array{
        return [
            '#',
            'Calsificación',
            'Titulo',
            'Autor',
            'Año',
        ];
    }
}
