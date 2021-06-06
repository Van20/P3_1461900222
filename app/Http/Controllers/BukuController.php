<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataBuku = DB::table('rak_buku')
            ->join('buku', 'id_buku', '=', 'buku.id')
            ->join('jenis_buku', 'id_jenis_buku', '=', 'jenis_buku.id')
            ->get();

        return view('index0222', ['dataBuku' => $dataBuku]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku0222'); //memanggil view form add buku
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // method untuk insert data ke table buku
    public function store(Request $request)
    {
        // insert data ke table buku
        DB::table('buku')->insert([
            'judul' => $request->judul,
            'tahun_terbit' => $request->tahun_terbit]
        );

        // alihkan halaman ke halaman /
        return redirect('/');
    }

    public function addbook()
    {
        $addBuku = Buku::all();

        return view('add_buku0222', ['addBuku' => $addBuku]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        return view('index0222',compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // method untuk edit data buku
    public function edit($id)
    { 
        // mengambil data buku berdasarkan id yang dipilih
        $edit_buku = DB::table('buku')->where('id',$id)->get(); 
        
        // passing data buku yang didapat ke view edit.blade.php 
        return view('editbuku0222',['buku' => $edit_buku]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    // update data buku
    public function update(Request $request)
    {
        // update data buku
        DB::table('buku')->where('id',$request->id)->update([

            'judul' => $request->judul,
            'tahun_terbit' => $request->tahun_terbit
        ]);

        // alihkan halaman ke halaman /
        return redirect('/addBook');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    // method untuk hapus data buku
    public function delete($id)
    {
        // menghapus data buku berdasarkan id yang dipilih
        DB::table('buku')->where('id',$id)->delete();
        
        // alihkan halaman ke halaman buku
        return redirect('/addBook');
    }
}
