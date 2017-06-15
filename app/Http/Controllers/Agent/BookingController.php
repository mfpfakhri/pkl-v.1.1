<?php

namespace App\Http\Controllers\Agent;

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
use App\Models\Booking;

use App\Mail\approveBooking;
use App\Mail\rejectBooking;

use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use Storage;
use File;

class BookingController extends BaseController {

  public function __construct(){
    $this->middleware('auth');
    $this->middleware('agent');
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $bookings = DB::table('bookings')->get();

    return view('agent.bookingagent', ['bookings' => $bookings]);
  }

  public function showapprove($id)
  {
    // mengambil booking
    $booking = Booking::find($id);

    //ambil data Customer
    $customer_id = $booking->customer_id;
    $customer = Customer::where('customer_id', $customer_id);

    return view('agent.approveBooking', ['customer' => $customer, 'booking' => $booking]);
  }

  public function approve(Request $request, $id)
  {
    // mengambil booking
    $booking = Booking::find($id);

    //ambil data Customer
    $customer_id = $booking->customer_id;
    $customer = Customer::where('customer_id', $customer_id);

    $user = User::where('id' ,$customer_id)->email;

    dd($user);

    // $user = User::find($id);
    // $user_email = $user->email;

    $data = $request->detail;

    Mail::to($user->email)->send(new approveBooking($user, $data));

    return redirect ('/bookingagent');
  }

  public function showreject($id)
  {
    // mengambil booking
    $booking = Booking::find($id);

    //ambil data Customer
    $customer_id = $booking->customer_id;
    $customer = Customer::where('customer_id', $customer_id);

    return view('agent.rejectBooking', ['customer' => $customer, 'booking' => $booking]);
  }

    public function reject(Request $request, $id)
  {
    
    $user = User::findOrFail($id);
    $user_email = $user->email;

    $data = $request->alasan;

    Mail::to($user->email)->send(new rejectBooking($user, $data));

    return redirect ('/bookingagent');
  }  

}
