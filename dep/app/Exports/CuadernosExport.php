<?php

namespace App\Exports;

use App\Models\Cuadernos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CuadernosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cuadernos::join('informacion', 'cuadernos.clasificacion', '=', 'informacion.clasificacion')->where('informacion.tipo','=','Cuadernos')
        ->select('cuadernos.id','cuadernos.clasificacion','cuadernos.titulo','cuadernos.autor','cuadernos.anio','cuadernos.tomo_numero','cuadernos.editorial','cuadernos.lugar_publicacion',
            'cuadernos.paginas','cuadernos.volumen','cuadernos.serie','cuadernos.isbn_issn','cuadernos.fecha_ingreso','cuadernos.situacion','informacion.obtencion','informacion.resguardo',
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
            'Obtención',
            'Resguardo',
            'Contenido',
            'CódigoBarras',
            'Intventario',
            'FechaPublicación'
        ];
    }
}
