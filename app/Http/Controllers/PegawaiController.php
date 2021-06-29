<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use Carbon\Carbon;
use Cloudinary;

class PegawaiController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        // $pegawais= Pegawai::all();
        $pegawais= Pegawai::latest()->get();
        
        return view('Pegawai.index',compact('pegawais')); 

    }
    public function cetak(){
        $pegawais= Pegawai::latest()->get();
        return view('Pegawai.cetak',compact('pegawais')); 

    }
    public function create(){
        return view('Pegawai.create');
    }
    public function store(Request $request){
  
            $fileName = Carbon::now()->format('Y-m-d H:i:s').'-'.$request->Nip;
            $uploadedFile = $request->file('gambar')->storeOnCloudinaryAs('frameworkpro',$fileName);

            $gambar = $uploadedFile->getSecurePath();
            $public_id = $uploadedFile->getPublicId();

            // dd($request->all());

            Pegawai::create([
                'nip' =>  $request->nip,
                'nama_pegawai' => $request->nama_pegawai,
                'alamat' => $request->alamat,
                'gambar' => $gambar,
                'public_id' => $public_id,
            ]);
    

            

            
        // ]);
        return redirect() ->route('pegawai.index');
    }
    public function destroy($id){
        $pegawai = Pegawai::findOrFail($id);
        // dd($pegawai);
        Cloudinary::destroy($pegawai->public_id);
        $pegawai -> delete();
        return redirect() ->route('pegawai.index');

        
    }
    public function edit($id){
        $pegawai = Pegawai::findOrFail($id);
        return view('Pegawai.edit',compact('pegawai')); 

    }
    public function update(Request $request,$id){
        $pegawai = Pegawai::findOrFail($id);

        if($request->gambar){
            $fileName = Carbon::now()->format('Y-m-d H:i:s').'-'.$request->Nip;
            Cloudinary::destroy($pegawai->public_id);

            $uploadedFile = $request->file('gambar')->storeOnCloudinaryAs('frameworkpro',$fileName);

            $gambar = $uploadedFile->getSecurePath();
            $public_id = $uploadedFile->getPublicId();
        }

        $pegawai -> update([
            'nip' => $request -> nip,
            'nama_pegawai' => $request -> nama_pegawai,
            'alamat' =>$request -> alamat,
            'gambar' =>$request -> gambar ? $gambar :$pegawai->gambar,
            'public_id' => $request -> gambar ? $public_id : $pegawai->public_id


        ]);
        return redirect() ->route('pegawai.index');

    }
}
