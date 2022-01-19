<?php

namespace App\Exports;

use App\Models\Libros;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LibrosExport implements FromCollection, WithHeadings
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Libros::join('informacion', 'libros.clasificacion', '=', 'informacion.clasificacion')->where('informacion.tipo','=','Libros')
        ->select('libros.id','libros.clasificacion','libros.titulo','libros.autor','libros.anio','libros.tomo_numero','libros.editorial','libros.lugar_publicacion',
            'libros.paginas','libros.volumen','libros.serie','libros.isbn_issn','libros.fecha_ingreso','libros.situacion','libros.space','informacion.obtencion','informacion.resguardo',
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
            'Obtención',
            'Resguardo',
            'Contenido',
            'CódigoBarras',
            'Intventario',
            'FechaPublicación'
        ];
    }
}
