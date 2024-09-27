<?php

namespace App\Http\Controllers;


use App\Models\Datawakif;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class PDFController extends Controller
{
    public function downloadpdf(){
        $datawakifs = Datawakif::all();

        $data = [
            'datawakifs' => $datawakifs,
            'date' => date('d-m-Y')
        ];

        $pdf = PDF::loadView('datawakifPDF', $data);

        return $pdf->download('datawakif.pdf');
    }

    public function wakifpdf($id){
        $datawakif = Datawakif::find($id);

        return $datawakif;
        $data = [
            'datawakifs' => $datawakifs
        ];
        $pdf = PDF::loadView('kwitansiwakifPDF', $data);
        return $pdf->download('kwitansiwakif.pdf');
    }
}
