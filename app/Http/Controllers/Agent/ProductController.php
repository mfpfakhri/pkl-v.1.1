<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Http\Middleware\VerifyCsrfToken;

use App\Models\Customer;
use App\Models\Paket;
use App\Models\Schedule;
use App\Models\Activity;

use Storage;
use File;
use DB;
use App\Models\Adventures;
use App\Models\Inf_lokasi;

class ProductController extends BaseController {

  public function __construct(){
    $this->middleware('auth');
    $this->middleware('agent');
  }

  public function showAll()
  {
    //jenis adv
    $data['query'] = DB::table('adventures')->get();

    //query tampil product
    return view('agent.productagent', $data);
  }

  public function create()
  {
    //jenis adv
    $data['query1'] = DB::table('adventures')->get();

    //id agent
    //$data['query2'] = DB::table('agents')->get();

    //provinsi
    $data['query3'] = DB::table('inf_lokasi')->where('lokasi_kabupatenkota', '00')->where('lokasi_kecamatan', '00')->where('lokasi_kelurahan', '0000')->orderby('lokasi_nama')->get();

    //kota
    $data['query4'] = DB::table('inf_lokasi')->where('lokasi_kecamatan', '00')->where('lokasi_kelurahan', '0000')->orderby('lokasi_propinsi')->get();
    return view('agent.createproduct',$data);
  }

  



  public function index()
  {
    return view('agent.productagent');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function createByAdmin()
  {
    return view('admin.createCustomer');
  }


  public function store($id, Request $request)
  {
    $customer = new Customer();
    $data = array(
        'email'=>$request->email,
        'firstname'=>$request->fname,
        'lastname'=>$request->lname,
        'alamat'=>$request->alamat,
        'phone'=>$request->phone,
        'gender'=>$request->gender,
        'tanggallahir'=>$request->tanggallahir,
        'nationality'=>$request->nationality,
        'foto'=>$request->foto
      );
    $update = $customers::where('id', $id)->update($data);
    dd('submit');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */

  public function add($id, Request $request)
  {
    $customers = new Customer();
    $data = array(
      'username' => $request->username,
      'password' => sha1($request->password),
      'email'=>$request->email,
      'firstname'=>$request->fname,
      'lastname'=>$request->lname,
      'alamat'=>$request->alamat,
      'phone'=>$request->phone,
      'gender'=>$request->gender,
      'tanggallahir'=>$request->tanggallahir,
      'nationality'=>$request->nationality,
      'foto'=>$request->foto
    );
    $customers->save();
    dd('submit');
  }

  public function s()
  {
    // $customers = Customer::all();
    $customers = DB::table('customers')->leftJoin('users', 'customers.user_id', '=', 'users.id')->where('level', 1)->get(); //hasilnya ID user
    return view('admin.customers')->with('data',$customers);
  }

public function show($id)
  {
    if(isset($id)) {
        $request =Customer::find($id);
        $data = array(
        'username'=>$request->username,
        'firstname'=>$request->firstname,
        'lastname'=>$request->lastname,
        'email'=>$request->email,
        'alamat'=>$request->alamat,
        'phone'=>$request->phone,
        'gender'=>$request->gender,
        'tanggallahir'=>$request->tanggallahir,
        'nationality'=>$request->nationality,
        'foto'=>$request->foto,
      );
    exit(json_encode($data));
      }
  }

  public function edit($id, Request $request)
  {
    $customer = new Customer();
    $data = array(
        'username'=>$request->username,
        'firstname'=>$request->firstname,
        'lastname'=>$request->lastname,
        'email'=>$request->email,
        'alamat'=>$request->alamat,
        'phone'=>$request->phone,
        'gender'=>$request->gender,
        'nationality'=>$request->nationality,
        'tanggallahir'=>$request->tanggallahir,
        // 'foto'=>$request->foto,
      );
    $update = $customer::where('id', $id)->update($data);
    echo "success";
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    if(isset($id)) {
      $record =Customer::find($id);
      if($record) {
          $data=Customer::find($id)->delete();
          if ($data) {
            echo "success";
          }else{
          echo "failed";
        }
      }
    }
  }

}
