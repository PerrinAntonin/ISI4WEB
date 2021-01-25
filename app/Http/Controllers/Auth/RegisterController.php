<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Custormer;
use App\Models\Order;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $customer = Custormer::create([
            'firstname' => $data['name'],
            'surname' => $data['surname'],
            'add1' => $data['add1'],
            'add2' => $data['add2'],
            'postcode' => $data['postcode'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            ]);


        $newUser = User::create([
            'email' => $data['email'],
            'custormer_id' => $customer->id,
            'password' => Hash::make($data['password']),
            'is_admin' => '0',
        ]);

        $Id_session = session()->getID();
        $order = Order::where('session_id', $Id_session)->latest('date')->first();

        if ($order) {
            $order->customer_id = $newUser->id;
            $order->save();
        }

        return $newUser;
    }

    public function showRegisterForm(){
        return view('auth.register',[
            'totalOrder'=> Order::totalOrder(),
        ]);
    }

}
