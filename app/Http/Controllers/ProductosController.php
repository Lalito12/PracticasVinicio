<?php

namespace App\Http\Controllers;
use App\Models\Productos;
use Auth;

use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index(){
      $productos = Productos::all();
      return view('productos', compact('productos'));
    }

    public function carrito(){
      return view('carrito');
    }

    public function agregar($id){
      $productos = Productos::find($id);
      if(!$productos){ abort(404); }

      $carrito = session()->get('carrito');

      //si el carrito esta vacio, este introduce el primer producto
      if(!$carrito){
        $carrito = [
          $id => [
            "nombre" => $productos->nombre,
            "descripcion" => $productos->descripcion,
            "costo" => $productos->costo,
            "cantidad" => 1,
            "img" => $productos->img,
          ]
        ];
        session()->put('carrito', $carrito);
        return redirect()->back()->with('success', 'Producto añadido al carrito con éxito!!');
      }
      //si el carrito no esta vacio, verifica si existe el producto e incrementa la cantidad
      if(isset($carrito[$id])){
        $carrito[$id]['cantidad']++;
        session()->put('carrito', $carrito);
        return redirect()->back()->with('success', 'Producto añadido al carrito con éxito!!');
      }
      //si el carrito no existen productos, lo integra con la cantidad 1
      $carrito[$id] =[
        "nombre" => $productos->nombre,
        "descripcion" => $productos->descripcion,
        "costo" => $productos->costo,
        "cantidad" => 1,
        "img" => $productos->img,
      ];
      session()->put('carrito', $carrito);
      return redirect()->back()->with('success', 'Producto añadido al carrito con éxito!!');
    }

    public function actualizar(Request $request){
      if($request->id and $request->cantidad){
        $carrito = session()->get('carrito');
        $carrito[$request->id]['cantidad'] = $request->cantidad;
        session()->put('carrito', $carrito);
        session()->flash('success', 'El producto se actualizo con éxito!!');
      }
    }

    public function borrar(Request $request){
      if($request->id){
        $carrito = session()->get('carrito');
        if(isset($carrito[$request->id])){
          unset($carrito[$request->id]);
          session()->put('carrito', $carrito);
        }
        session()->flash('success', 'Producto borrado con éxito!!');
      }
    }
  }
