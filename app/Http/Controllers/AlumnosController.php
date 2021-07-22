<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\AlumnosExport;
use App\Imports\AlumnosImport;
use Maatwebsite\Excel\Excel;
use DataTables;
use PDF;

use App\Models\Alumnos;

class AlumnosController extends Controller
{
    private $excel;
    public function __construct(Excel $excel){
      $this->excel = $excel;
    }
    public function index(Request $request){
        if($request->ajax()){
              $data = Alumnos::latest()->get();
              return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('otros', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit"
                    class="btn btn-primary btn-sm editCustomer">Editar</a>';
                    $btn = $btn. '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete"
                      class="btn btn-danger btn-sm deleteCustomer">Borrar</a>';
                      return $btn;
                })
              ->rawColumns(['otros'])
              ->make(true);
            }
            return view('welcome');
      }

    public function store(Request $request){
        if($request->Customer_id != ''){
          Alumnos::where('id', $request->Customer_id)->update([
            'matricula' => $request->matricula,
            'nombre' => $request->nombre,
            'app' => $request->app,
            'gen' => $request->gen,
            'fn' => $request->fn,
            'email' => $request->email,
            'pass' => $request->pass
          ]);
        }
        else{
        Alumnos::create($request->only('matricula', 'nombre', 'app', 'gen', 'fn', 'email', 'pass'));

          }

        return response()->json(['success'=>'El cliente se guardo correctamente...!!!']);
      }

    public function edit($id){
      $query = Alumnos::find($id);
      return response()->json($query);
    }

    public function destroy($id){
      Alumnos::find($id)->delete();
      return response()->json(['success'=>'El cliente se elimino correctamente...!!!']);
    }

    // ------------------- PDF ---------------------------
    public function getPdfAlumnos(){
        $pdfalum = Alumnos::all();
        $pdf = PDF::loadView('pdf', compact('pdfalum'));
        return $pdf->download('pdf_alumnos.pdf');
      }

      // ------------------- Excel ---------------------------
      public function export(){
        return $this->excel->download(new AlumnosExport, 'alumnos.xlsx');
      }

      public function import(){
        $this->excel->import(new AlumnosImport, request()->file('file'));
        return back();
      }

    // ------------------- Qr ---------------------------
    public function QrCode(){
      return \QrCode::size(300)
          ->backgroundColor(255,255,255)
          ->generate('  Alumno:
                      Garcia Turin Eduardo
                            221811274
                             IDGS-92');
                             
    }

    public function QrImg(){
      $img = \QrCode::format('png')
        ->merge('img/laravel.png', 0.5, true)
        ->size(500)->errorCorrection('H')
        ->generate('Ejemplo de codigo QR | IDGS-92°');
        return response($img)->header('content-type','image/png');
    }
}