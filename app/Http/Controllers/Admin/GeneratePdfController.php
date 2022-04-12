<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ControlHM;
use PDF;

class GeneratePdfController extends Controller
{
    public function pdfForm($id)
    {
    	$dataf = ControlHM::where('id_Control_Historia_Medica', $id)->first();
    	//dd($dataf);
        return view('admin.factura.pdf_form')->with(compact('dataf'));
    }
 
    public function pdfDownload(Request $request){
      
         $data = 
         [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
         ];
       $pdf = PDF::loadView('admin.factura.pdf_download', $data);
   
       return $pdf->download('Factura.pdf');
    }
}
