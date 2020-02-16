<?php

namespace App\Http\Controllers;
use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }
    public function index(){
        $result = Kategori::all();
        if(count($result)>0){
            $data['code'] = 200;
            $data['result'] = $result;
        }else{
            $data['code'] = 404;
            $data['result'] = null;
        }
        return response($data);
    }
    public function show($id){
        $result = Kategori::where('id_kategori',$id)->get();
        if(count($result)==1){
            $data['code'] = 200;
            $data['result'] = $result;
        }else{
            $data['code'] = 404;
            $data['result'] = null;
        }
        return response($data);
    }
    public function store (Request $request){
        // if($request->has('_token')) {
            $result = new Kategori();
            $result->nama = $request->input('nama');
            if($result->save()){
                $data['code'] = 200;
                $data['result'] = 'Berhasil Tambah Data';
            }else{
                $data['code'] = 500;
                $data['result'] = 'Error';
            }
        
            return response($data);
        // }
    }
    public function update(Request $request, $id){
        $result = Kategori::where('id_kategori',$id)->first();
        $result->nama = $request->input('nama');
        if($result->save()){
            $data['code'] = 200;
            $data['result'] = 'Berhasil Merubah Data';
        }else{
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
    
        return response($data);
    }
    public function destroy($id){
        $result = Kategori::where('id_kategori',$id)->first();
        if($result->delete()){
            $data['code'] = 200;
            $data['result'] = 'Berhasil Menghapus Data';
        }else{
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
    
        return response($data);
    }

    //
}
