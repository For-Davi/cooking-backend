<?php

namespace App\Services;

use App\Exports\MovementsExport; 
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;

class ExportService
{
    /**
     * 
     *
     * @param Collection 
     * @param string 
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportExcel(Collection $data, string $filename)
    {
      
        $export = new MovementsExport($data);

        return $export->download($filename . '.xlsx');
    }

    // /**
    //  * 
    //  *
    //  * @param Collection 
    //  * @param string 
    //  * @return \Symfony\Component\HttpFoundation\Response
    //  */
    // public function exportPdf(Collection $data, string $filename)
    // {
    //     $pdf = Pdf::loadView('exports.movements', [
    //         'movements' => $data
    //     ]);

    //     return $pdf->download($filename . '.pdf');
    // }
}
