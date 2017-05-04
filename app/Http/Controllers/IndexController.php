<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Schedule;
use App\Models\Inf_lokasi;
use App\Models\Adventures;

class IndexController extends BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function home()
  {
	$data['query'] = DB::table('adventures')->get();
	$data['query1'] = DB::table('inf_lokasi')->where('lokasi_kabupatenkota', '00')->where('lokasi_kecamatan', '00')->where('lokasi_kelurahan', '0000')->orderby('lokasi_nama')->get();
	   return view('containerindexproto',$data);
  }

  public function product()
  {
    $query2 = Paket::get();
    foreach($query2 as $result){
      echo $result->agents->username;
    }
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('agents_register');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    return view('agents_create');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */

  public function createcst()
  {
    return view('customer_signin');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */


  public function show()
  {
    $adv = $_GET['adv'];
    $destination = $_GET['destination'];
    $date = $_GET['date'];
    //select paket (kriteria ^)
    $pakets = Paket::with('schedule')
    ->whereHas('schedule',function ($q) use ($date){
      $q->where('start_date',$date);
    })
    ->where('adv_id','=',$adv)
    ->where('id_lokasi','=',$destination)->get();

  
    return view('containerlistingproto',['pakets'=>$pakets]);

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function detail($id)
  {
    $paket_id=$id;
    $pakets = Paket::where('id','=',$paket_id)->get();

    return view('containerdetailproto',['pakets'=>$pakets]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }
  
}