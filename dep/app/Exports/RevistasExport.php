<?php

namespace App\Exports;

use App\Models\Revistas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RevistasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Revistas::join('informacion', 'revistas.clasificacion', '=', 'informacion.clasificacion')->where('informacion.tipo','=','Revistas')
        ->select('revistas.id','revistas.clasificacion','revistas.titulo','revistas.autor','revistas.anio','revistas.tomo_numero','revistas.editorial','revistas.lugar_publicacion',
            'revistas.paginas','revistas.volumen','revistas.serie','revistas.isbn_issn','revistas.fecha_ingreso','revistas.situacion','revistas.space','revistas.space2','informacion.obtencion','informacion.resguardo',
            'informacion.contenido','informacion.codigo_barras','informacion.inventario','informacion.fecha_publicacion')->get();
    }
    public function headings(): array{
        return [
            '#',
            'Calsificación',
            'Titulo',
            'Autor',
            'Año',
            'TomoONumero',
            'Editorial',
            'LugarPublicación',
            'Páginas',
            'Volumen',
            'serie',
            'ISBN_ISSN',
            'FechaIngreso',
            'Situación',
            'Space',
            'Space2',
            'Obtención',
            'Resguardo',
            'Contenido',
            'CódigoBarras',
            'Intventario',
            'FechaPublicación'
        ];
    }
}
