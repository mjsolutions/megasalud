<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use MegaSalud\Sucursal;

use MegaSalud\Http\Requests;

use MegaSalud\Http\Controllers\Controller;

use Laracasts\Flash\Flash;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class SucursalesController extends Controller
{

    public function index(){
        $sucursales=Sucursal::where('status',1)->orderBy('razon_social','ASC')->paginate(10);
        return view('admin.sucursales.list')->with('sucursales',$sucursales);
    }

    public function create(){
        return view('admin.sucursales.create');
    }

    public function store(UserRequest $request){   
        $validate = false;

        DB::beginTransaction();

        try {

            $sucursal = new User($request->all());
            $sucursal -> save();
            $validate = true;

            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollBack();
            $validate = false;
            $fail = $e;
            // throw $e;
        }        


        if($validate) {
            Flash::overlay('Se ha registrado '. $sucursal->razon_social .' de forma exitosa.', 'Alta exitosa');
        }else{
            Flash::overlay('Ha ocurrido un error al registrar la sucursal  '. $sucursal->razon_social. " : ".$fail, 'Error');            
        }

        
        return redirect()->route('admin.sucursales.index');
    }

    public function show($id){

    }

    public function edit($id){
        $sucursal = User::find($id);

        $sucursal = UsuariosController::medicos();
        
        Sucursal::all()->pluck('razon_social', 'id');
        //compact pasa las variables con sus nombres sin necesidad de referenciarlas
        //es lo mismo que hacer whth(array ('usuario'=>$usuario, 'sucursal'=>$sucursal))
        return view('admin.usuarios.edit', compact('usuario', 'sucursal'));
        // return view('admin.usuarios.edit')->with('usuario', $usuario);
    }

    public function update(UserRequest $request, $id){   

    }

    public function destroy($id){
        $sucursal = Sucursal::find($id);
        $sucursal->status = 0;
        if($sucursal->save()) {
            Flash::overlay('Se ha eliminado ' . $sucursal->razon_social . ' de forma exitosa', 'Operación exitosa');
        } else {
            Flash::overlay('Ha ocurrido un erro al eliminar al sucursal ' . $sucursal->razon_social, 'Error');
        }

        return redirect()->route('admin.sucursales.index');
    }

    public function pais(){

    }

    public function estado(){

    }

    public function municipio(){

    }

    public function banco() {

    }

    public function medicos() {

    }

    public function adminsucursal() {

    }

    public function adminsucursal_edit($id){

    }

    public function change_password(CPRequest $req){

    }

    public function busqueda(Request $req){
        $data=$req->data;
        $data=explode(" ",trim($data));
        $sucursales = Sucursal::where(function($query) use ($data) {
            foreach ($data as $dato) {
                $query->where('sucursales.razon_social', 'like', '%'.$dato.'%')
                ->orwhere('sucursales.id', 'like', '%'.$dato.'%')
                ->orwhere('sucursales.cuenta_bancaria', 'like', '%'.$dato.'%');
            }
        })->orderBy('razon_social', 'DESC')->paginate(10);

        return view('admin.sucursales.list')->with('sucursales',$sucursales);
    }

}
