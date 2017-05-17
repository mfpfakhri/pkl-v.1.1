<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Tambah
use App\User;

class UserController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    public function __construct($id)
    {
        $this->middleware('auth');
        $customer = user::find ($id);
        if (null(gender)) {
            return redirect ('/{$id}/userdetail');
        }
    }

    // *
    //  * Create a new controller instance.
    //  *
    //  * @return void
     
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('userdetail');
    // }

    //Lengkapi Form
    public function edit($id)
    {
        $customer = User::find($id);

        if(!$customer){
            abort(404);
        }
        return view('userdetail',['customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Lengkapi Data
        $this->validate($request, [
            'firstname' => 'required|alpha',
            'lastname'  => 'required|alpha',
            'address'   => 'required|max:50',
            'phone'     => 'required|between:10,12',
            'gender'    => 'required',

        ]);

        $customer = User::find($id);
        $customer->firstname = $request->firstname;
        $customer->lastname  = $request->lastname;
        $customer->alamat    = $request->alamat;
        $customer->phone     = $request->phone;
        $customer->gender    = $request->gender;
        $customer->save();

        return redirect ('/');
    }
}
