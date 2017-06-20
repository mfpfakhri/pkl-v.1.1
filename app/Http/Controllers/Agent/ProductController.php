<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Http\Middleware\VerifyCsrfToken;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\Models\Customer;
use App\Models\Paket;
use App\Models\Schedule;
use App\Models\Activity;
use App\Models\Product;
use App\Models\Adventures;
use App\Models\Inf_lokasi;

use Storage;
use File;
use DB;


class ProductController extends BaseController {

  public function __construct(){
    $this->middleware('auth');
    $this->middleware('agent');
  }

  public function showAll()
  {
    $idagent = Auth::user()->id;

    $data['query'] = DB::table('products')->where('agent_id', $idagent)->get();

    //query tampil product
    return view('agent.productagent', $data);
  }

  public function create()
  {
    //jenis adv
    $data['query1'] = DB::table('adventures')->get();

    //provinsi
    $data['query3'] = DB::table('inf_lokasi')->where('lokasi_kabupatenkota', '00')->where('lokasi_kecamatan', '00')->where('lokasi_kelurahan', '0000')->orderby('lokasi_nama')->get();

    return view('agent.createproduct',$data);
  }

  public function store(Request $request)
  { 
    $idagent = Auth::user()->id;

    $schedule = new schedule();
    $schedule->start_date = $request->start_date;
    $schedule->end_date = $request->end_date;
    $schedule->start_point = $request->pickuppoint;
    $schedule->end_point = $request->endpoint;
    $schedule->maxpeople = $request->peserta;
    $schedule->save();

    $paket = new Paket;
    $paket->agents_id = $idagent;
    $paket->judul = $request->title;
    $paket->description = $request->description;
    $paket->price = $request->price;
    $paket->adv_id = $request->adv_id;
    $paket->lokasi_id = $request->provinsi;
    $paket->schedule_id  = $schedule->id;
    $paket->detail = $request->detail;

    //simpan gambar
    $filePaket = $request->idagent.'_'.$request->title.'.png';
    $request->file('product')->storeAs("public\product",$filePaket);
    $paket->multipic = $filePaket;
    $paket->save();

    $activity = new Activity();
    $activity->paket_id = $paket->id;
    $activity->event = $request->event;
    $activity->save();
////////////////////////////////////////////////
    $product = new Product();
    $product->agent_id = $idagent;
    $product->paket_id = $paket->id;
    $product->schedule_id = $schedule->id;
    $product->inf_lokasi_id = $request->provinsi;

    $lokasi = Inf_lokasi::find($request->provinsi)->lokasi_nama;
    $product->lokasi = $lokasi; 

    $kategori = $paket->adv_id;
    $kategori = Adventures::find($kategori)->nama_adv;
    $product->kategori = $kategori;
    
    $start_point = $schedule->start_point;
    $product->start_point = $start_point;

    $end_point = $schedule->end_point;
    $product->end_point = $end_point;

    $itenerary = $activity->event;
    $product->itenerary = $itenerary;

    $detail = $paket->detail;
    $product->detail = $detail;

    $description = $paket->description;
    $product->description = $description;

    $user_agent = $idagent;
    $agent = User::find($paket->agents_id)->username;
    $product->user_agent = $agent;

    $paket_judul = Paket::find($paket->id)->judul;
    $product->paket_judul = $paket_judul;

    $paket_harga = Paket::find($paket->id)->price;
    $product->paket_harga = $paket_harga;

    $product->schedule_jadwal_start = $request->start_date;
    $product->schedule_jadwal_end = $request->end_date;

    $schedule_peserta = $schedule->id;
    $schedule_peserta = Schedule::find($schedule_peserta)->maxpeople;
    $product->schedule_max_people = $schedule_peserta;
    $product->save();

    return redirect ('/productagent');

  }

  public function edit($id)
  {
    
    //jenis adv
    $data['query4'] = DB::table('adventures')->get();

    //provinsi
    $data['query5'] = DB::table('inf_lokasi')->where('lokasi_kabupatenkota', '00')->where('lokasi_kecamatan', '00')->where('lokasi_kelurahan', '0000')->orderby('lokasi_nama')->get();

    $product = Product::find($id);

    return view('agent.editproduct', ['product' => $product], $data);

  }

  public function update(Request $request, $id)
  {
    // dd($request);

    // $schedule = Schedule::where('start_date', $request->start_date);
    // dd($schedule);
    // $schedule->start_date = $request->start_date;
    // $schedule->end_date = $request->end_date;
    // $schedule->start_point = $request->pickuppoint;
    // $schedule->end_point = $request->endpoint;
    // $schedule->maxpeople = $request->peserta;
    // $schedule->save();

    // $paket = new Paket;
    // $paket->agents_id = $idagent;
    // $paket->judul = $request->title;
    // $paket->description = $request->description;
    // $paket->price = $request->price;
    // $paket->adv_id = $request->adv_id;
    // $paket->lokasi_id = $request->provinsi;
    // $paket->schedule_id  = $schedule->id;
    // $paket->detail = $request->detail;

    // //simpan gambar
    // $filePaket = $request->idagent.'_'.$request->title.'.png';
    // $request->file('product')->storeAs("public\product",$filePaket);
    // $paket->multipic = $filePaket;
    // $paket->save();

    // $activity = new Activity();
    // $activity->paket_id = $paket->id;
    // $activity->event = $request->event;
    // $activity->save();
////////////////////////////////////////////////

    $product = Product::find($id);
    // dd($request->price);
    $product->paket_judul = $request->title;
    $product->paket_harga = $request->price;
    $product->schedule_max_people = $request->peserta;
    $product->schedule_jadwal_start = $request->start_date;
    $product->schedule_jadwal_end = $request->end_date;
    $product->lokasi = $request->provinsi;
    $product->kategori = $request->kategori;
    $product->start_point = $request->pickuppoint;
    $product->end_point = $request->endpoint;
    $product->itenerary = $request->event;
    $product->detail = $request->detail;
    $product->description = $request->description;
    $product->save();

    // $lokasi = Inf_lokasi::find($request->provinsi)->lokasi_nama;
    // $product->lokasi = $lokasi; 

    // $kategori = $paket->adv_id;
    // $kategori = Adventures::find($kategori)->nama_adv;
    // $product->kategori = $kategori;
    
    // $start_point = $schedule->start_point;
    // $product->start_point = $start_point;

    // $end_point = $schedule->end_point;
    // $product->end_point = $end_point;

    // $itenerary = $activity->event;
    // $product->itenerary = $itenerary;

    // $detail = $paket->detail;
    // $product->detail = $detail;

    // $description = $paket->description;
    // $product->description = $description;

    // $user_agent = $idagent;
    // $agent = User::find($paket->agents_id)->username;
    // $product->user_agent = $agent;

    // $paket_judul = Paket::find($paket->id)->judul;
    // $product->paket_judul = $paket_judul;

    // $paket_harga = Paket::find($paket->id)->price;
    // $product->paket_harga = $paket_harga;

    // $product->schedule_jadwal_start = $request->start_date;
    // $product->schedule_jadwal_end = $request->end_date;

    // $schedule_peserta = $schedule->id;
    // $schedule_peserta = Schedule::find($schedule_peserta)->maxpeople;
    // $product->schedule_max_people = $schedule_peserta;
    // $product->save();

    return redirect ('/productagent');
  }

  public function destroy($id)
  {
    $product = Product::find($id);
    $product->delete();
    return redirect('/productagent')->with('warning', 'Product id: '.$product->paket_id.' berhasil dihapus!');
  }

}
// 