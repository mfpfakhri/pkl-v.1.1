<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use App\Models\Paket;
use App\Models\Schedule;
use App\Models\Activity;
use DB;
use App\Models\Adventures;
use App\Models\Inf_lokasi;
//file
use App\Http\Requests;
use File;
use Storage;

class PaketController extends BaseController {

  public function __construct(){
    $this->middleware('auth');
    $this->middleware('admin');
  }

  public function showAll()
  {
    //ngambil data adv
    $data['query'] = DB::table('adventures')->get();

    //ngambil data paket
    $data['product'] = DB::table('paket')
                      ->leftJoin('schedule', 'paket.id', '=', 'schedule.paket_id')
                      ->leftJoin('activity', 'paket.id', '=', 'activity.paket_id')
                      ->get();

    return view('admin.product',$data);
  }

  public function createByAdmin()
  {
    //jenis adv
    $data['query'] = DB::table('adventures')->get();

    //id agent
    $data['query1'] = DB::table('agents')->get();

    //kota
    $data['query4'] = DB::table('inf_lokasi')->where('lokasi_kecamatan', '00')->where('lokasi_kelurahan', '0000')->orderby('lokasi_propinsi')->get();
    return view('admin.createproduct',$data);
  }

  public function storeByAdmin(Request $request)
  {
    // dd($request);
    $paket = new Paket;
    $paket->agents_id = $request->idagent;
    $paket->judul = $request->title;
    $paket->description = $request->description;
    $paket->price = $request->price;
    $paket->adv_id = $request->adv_id;
    $paket->lokasi_id = $request->city;
    $paket->detail = $request->detail;

    //simpan gambar
    $filePaket = $request->idagent.'_'.$request->title.'.png';
    $request->file('product')->storeAs("public\product",$filePaket);
    $paket->multipic = $filePaket;
    $paket->save();

    // dd($paket->id);
    $schedule = new schedule();
    $schedule->paket_id = $paket->id;
    $schedule->start_date = $request->start_date;
    $schedule->end_date = $request->end_date;
    $schedule->start_point = $request->pickuppoint;
    $schedule->end_point = $request->endpoint;
    $schedule->maxpeople = $request->peserta;
    $schedule->save();

    $activity = new activity();
    $activity->paket_id = $paket->id;
    $activity->event = $request->event;
    $activity->save();

    return redirect ('/dash/products');
    }

    public function editByAdmin($id)
  {
    //id agent
    $data['query5'] = DB::table('agents')->get();

    //jenis adv
    $data['query6'] = DB::table('adventures')->get();

    //kota
    // $data['query7'] = DB::table('inf_lokasi')->where('lokasi_kecamatan', '00')->where('lokasi_kelurahan', '0000')->orderby('lokasi_propinsi')->get();
    $data['query7'] = DB::table('paket')
      ->leftJoin('inf_lokasi', 'paket.lokasi_id', '=', 'inf_lokasi.lokasi_ID')
      ->where('lokasi_kecamatan', '00')->where('lokasi_kelurahan', '0000')->orderby('lokasi_propinsi')->get();


    // mengambil id paket
    $paket = Paket::find($id);

    //mengambil data agent
    $product = DB::table('paket')
                      ->leftJoin('schedule', 'paket.id', '=', 'schedule.paket_id')
                      ->leftJoin('activity', 'paket.id', '=', 'activity.paket_id')
                      ->first();

    return view ('admin.editproduct', ['paket' => $paket, 'product' => $product], $data);
  }

  public function updateByAdmin(Request $request, $id)
  {
    // mengambil data user
    $user = User::find($id);
    $user->username = $request->username;
    $user->email = $request->email;

    // mengambil id paket
    $paket = Paket::find($id);
    $paket->judul = $request->title;
    $paket->description = $request->description;
    $paket->price = $request->price;
    $paket->adv_id = $request->adv_id;
    $paket->lokasi_id = $request->city;
    $paket->detail = $request->detail;

    $schedule = Schedule::where()->first();
    $schedule->start_date = $request->start_date;
    $schedule->end_date = $request->end_date;
    $schedule->start_point = $request->pickuppoint;
    $schedule->end_point = $request->endpoint;
    $schedule->maxpeople = $request->peserta;

    $activity->event = $request->event;

    $paket->save();
    $schedule->save();
    $activity->save();



    //contoh
    $user_id = $user->id;
    $agent = Agent::where('user_id', $user_id)->first();
    $agent->fullname = $request->fullname;
    $agent->address = $request->alamat;
    $agent->city = $request->city;
    $agent->province = $request->province;
    $agent->bahasa = $request->bahasa;
    $agent->tanggallahir = $request->tanggallahir;
    $user->save();
    $agent->save();

    return redirect ('dash/agents');
  }

  public function destroy($id)
  {
   $user = User::find($id);
   $user_id = $user->id;
   $agent = Agent::where('user_id', $user_id)->first();
   file::delete(public_path('storage/diri/'.$agent->foto));
   $agent->delete();
   return redirect('/dash/agents')->with('warning', 'User '.$user->username.' berhasil dihapus!');
 }


////BATAS

}
// 