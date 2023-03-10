<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;
use App\Exports\WargasExport;
use App\Models\Response;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
    return view('login');
    }

    public function exportExcel()
    {
        $file_name = 'data_keseluruhan_pengaduan.xlsx';
        return Excel::download(new WargasExport, $file_name);
    }

    public function exportPDF()
    {
        // ambil data yg akan ditampilkan pada pdf, bisa juga dengan where atau eloquent lainnya dan jangan gunakan pagination
$data = Warga::with('response')->get()->toArray(); 
// kirim data yg diambil kepada view yg akan ditampilkan, kirim dengan inisial 
view()->share('rt',$data); 
// panggil view blade yg akan dicetak pdf serta data yg akan digunakan
$pdf = PDF::loadView('print', compact('data'))->setPaper('a4', 'landscape'); 

return $pdf->download('data_pengaduan_keseluruhan.pdf');

    }

    public function createPDF($id)
    {
        // ambil data yg akan ditampilkan pada pdf, bisa juga dengan where atau eloquent lainnya dan jangan gunakan pagination
$data = Warga::with('response')->where('id', $id)->get()->toArray(); 
// kirim data yg diambil kepada view yg akan ditampilkan, kirim dengan inisial 
view()->share('rt',$data); 
// panggil view blade yg akan dicetak pdf serta data yg akan digunakan
$pdf = PDF::loadView('print', compact('data')); 

return $pdf->download('data_pengaduan_keseluruhan.pdf');

    }


    public function dataPetugas(Request $request)
    {
        $search = $request->search;
        $wargas = Warga::with('response')->where('nama','LIKE', '%' . $search . '%')->orderBy('created_at','DESC')->get();
        return view('data_petugas', compact('wargas'));

    }


    public function logout()
    {
    Auth::logout();
    return redirect('/');
    }


    public function landing()
    {
        $wargas = Warga::orderBy('created_at','DESC')->simplePaginate(2);
        return view('landing', compact('wargas'));
    }


    public function auth(Request $request)
{
$request->validate([
    'email' => 'required|email:dns',
    'password' => 'required',
]);

$user = $request->only('email', 'password');
if (Auth::attempt($user)) {

    if (Auth::user()->role == 'admin') {
    return redirect()->route('dashboard');
    }elseif(Auth::user()->role == 'petugas') {
        return redirect()->route('data.petugas');
    }

}else {
    return redirect()->back()->with('eror', 'Gagal Login!');
}

}

    public function index(Request $request)
    {
        $search = $request->search;
        $wargas = Warga::with('response')->where('nama','LIKE', '%' . $search . '%')->orderBy('created_at','DESC')->get();
        return view('dashboard', compact('wargas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'telepon' => 'required|numeric',
            'pengaduan' => 'required',
            'gambar' => 'required|image|mimes:jpeg,jpg,png,svg',
        ]);

        //ambil file yg diupload di input yg name nya foto
        $image = $request->file('gambar');
        //ubah nama file jadi ranodm extensi
        $imgName = rand() . '.' . $image->extension();
        //panggil folder tempat simpen gambar
        $path = public_path('assets/image/');
        //pindahin gambar yg di upload dan udah di rename ke folder tadi
        $image->move($path, $imgName);

Warga::create([
    'nik' => $request->nik,
    'nama' => $request->nama,
    'telepon' => $request->telepon,
    'pengaduan' => $request->pengaduan,
    'gambar' => $imgName,
]);

return redirect ('/')->with('successAdd', 'Berhasil menambahkan data baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warga  $warga
     * @return \Illuminate\Http\Response
     */
    public function show(Warga $warga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warga  $warga
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Warga::where('id', '=', $id)->firstOrFail();
        return view('edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warga  $warga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warga $warga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warga  $warga
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $data = Warga::where('id', $id)->firstOrFail();
        $image = public_path('assets/image/' .$data['gambar']);
        unlink($image);
      $data->delete();
      Response::where('warga_id',$id)->delete();
      return redirect()->back();
    }
}
