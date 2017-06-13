<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\VerifyCsrfToken;

use App\User;
use App\Models\Customer;

use App\Http\Requests;
use Storage;
use File;

class CustomersController extends BaseController {

  public function __construct(){
    $this->middleware('auth');
    $this->middleware('admin');
  }

  public function showAll()
  {
    // $customers = Customer::all();
    $customers = DB::table('customers')->leftJoin('users', 'customers.user_id', '=', 'users.id')->where('level', 1)->get(); //hasilnya ID user
    return view('admin.customers')->with('data',$customers);
  }

  public function createByAdmin()
  {
    return view('admin.createCustomer');
  }

  public function storeByAdmin(Request $request)
  {
    $user = new User;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->stat = 1;
    $user->level = 1;
    $user->ver_token = str_random(20);
    $user->save();

    if($user->level == 1){
      $customer = new Customer;
      $customer->user_id = $user->id;
      $customer->firstname = $request->fname;
      $customer->lastname = $request->lname;      
      $customer->alamat = $request->address;
      $customer->phone = $request->phone;
      $customer->gender = $request->gender;
      $customer->tanggallahir = $request->tanggallahir;
      $customer->nationality = $request->nationality;      

      //simpan gambar 
      $fileFoto = $request->username. '_foto.png';
      $request->file('foto')->storeAs("public\FotoCustomer",$fileFoto);
      $customer->foto = $fileFoto;

      $customer->save();
    }
    return redirect ('/dash/customers');
  }

  public function editByAdmin($id)
  {
    // mengambil data user
    $user = User::find($id);

    //mengambil data customer
    $user_id = $user->id;
    $customer = Customer::where('user_id', $user_id)->first();

    return view ('admin.editcustomer',['customer' => $customer, 'user' => $user]);
  }

    public function updateByAdmin(Request $request, $id)
  {
    // mengambil data user
    $user = User::find($id);
    $user->username = $request->username;
    $user->email = $request->email;

    $user_id = $user->id;
    $customer = Customer::where('user_id', $user_id)->first();
    $customer->firstname = $request->firstname;
    $customer->lastname = $request->lastname;    
    $customer->alamat = $request->alamat;
    $customer->phone = $request->phone;
    $customer->tanggallahir = $request->tanggallahir;
    $customer->nationality = $request->nationality;    
    $user->save();
    $customer->save();

    return redirect ('dash/customers');
  }

  public function destroy($id)
  {
   $user = User::find($id);
   $user_id = $user->id;   
   $customer = Customer::where('user_id', $user_id)->first();
   file::delete(public_path('storage/FotoCustomer/'.$customer->foto));
   $customer->delete();
   return redirect('/dash/customers')->with('warning', 'User '.$user->username.' berhasil dihapus!');
  }


/////BATAS

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

}
