<?php

namespace App\Http\Controllers;

use App\Models\Select;
use App\Models\SelectJenisBuku;
use App\Models\SelectRakBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SelectController extends Controller
{
    public function index()
    {
        //
    }

    public function addbook()
    {
        $addBuku = Select::all();

        return view('add_buku0222', ['addBuku' => $addBuku]);
    }

    public function addbookpage()
    {
        $addBukuPage = Select::all();

        return view('buku0222', ['addBukuPage' => $addBukuPage]);
    }

    public function editbookpage()
    {
        $editBukuPage = Select::all();

        return view('edit_buku0222', ['editBukuPage' => $editBukuPage]);
    }

    public function viewbook()
    {
        $dataBuku = DB::table('rak_buku')
            ->join('buku', 'id_buku', '=', 'buku.id')
            ->join('jenis_buku', 'id_jenis_buku', '=', 'jenis_buku.id')
            ->get();

        return view('index0222', ['dataBuku' => $dataBuku]);
    }

    public function addjenisbook()
    {
        $addJenisBuku = SelectJenisBuku::all();

        return view('add_jenis_buku0222', ['addJenisBuku' => $addJenisBuku]);
    }

    public function addjenisbookpage()
    {
        $addJenisBukuPage = SelectJenisBuku::all();

        return view('jenisbuku0222', ['addJenisBukuPage' => $addJenisBukuPage]);
    }

    public function editjenisbookpage()
    {
        $editJenisBukuPage = SelectJenisBuku::all();

        return view('edit_jenisbuku0222', ['editJenisBukuPage' => $editJenisBukuPage]);
    }

    public function selectLike()
    {
        $dataSiswa = DB::table('siswa')
            ->where('nama', 'like', 'ABI%')
            ->get();

        $dataSiswa2 = DB::table('siswa')
            ->where('nama', 'like', 'NOVI%')
            ->get();

        return view('selectlike0222', ['dataSiswa1' => $dataSiswa, 'dataSiswa2' => $dataSiswa2]);
    }

    public function selectJoin()
    {
        $dtlSiswa = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->join('absen', 'siswa.nis', '=', 'absen.nis')
            ->select('siswa.nis', 'nama', 'kelas', 'tanggal', 'absen', 'id_semester');

        $joindataSiswa = DB::table('semester')
            ->joinSub($dtlSiswa, 'dtlsiswa', function ($join) {
                $join->on('semester.id_semester', '=', 'dtlsiswa.id_semester');
            })->orderBy('nis', 'asc')->get();

        return view('selectjoin0222', ['joindataSiswa' => $joindataSiswa]);
    }

    public function selectjoinwithWhere()
    {
        $dataSiswa = DB::table('siswa')
            ->leftjoin('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where([
                ['kelas.kelas', '=', 'XI'],
                ['siswa.nama', 'like', '%A%']
            ])
            ->orderBy('nis', 'asc')
            ->get();

        return view('selectjoinwithwhere0222', ['dataSiswa' => $dataSiswa]);
    }
}
