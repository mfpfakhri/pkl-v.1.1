<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\VerifyCsrfToken;

use App\Models\Customer;

use App\Http\Requests;
use Storage;
use File;

class CustomerController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return view('customer_register');
  }

  public function register(Request $request) 
  {
    $customer = new Customer();
    $customer->username = $request->username;
    $customer->password = sha1($request->password);
    $customer->save();

    return redirect('/createcustomer/'.$customers->id);
  }

  public function create($id)
  {
    $customer = new Customer();
    $data['id'] = $id;
    $data['query'] = $customers::where('id', $id)->get();
    return view('customer_create', $data);
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

   public function storeByAdmin(Request $request) 
  {
    // dd($request);
    $customer = new Customer;
    $customer->username = $request->username;
    $customer->email = $request->email;
    $customer->password = sha1($request->password);
    $customer->firstname = $request->firstname;
    $customer->lastname = $request->lastname;
    $customer->alamat = $request->alamat;
    $customer->phone = $request->phone;
    $customer->gender = $request->gender;
    $customer->nationality = $request->nationality;
    $customer->tanggallahir = $request->tanggallahir;
    $customer->foto = $request->foto;

    // save gambar
    $imageName = time().'.'.$request->foto->getClientOriginalName();
    $customer->foto = $imageName;
    $request->foto->move(public_path('foto_customer'), $imageName);

    $customer->save();
    return redirect ('/customer');
  }

  public function addNew()
  {
    return view('customer_add');
  }

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

  public function showAll()
  {
    $data = Customer::where('level','=',1)->get();
    return view('admin.customer')->with('data',$data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */

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