<?php
namespace App\Http\Controllers\Auth;

use App\User;
use App\FileNotification;
use App\Message;
use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Chatkit\Laravel\Facades\Chatkit;
use Illuminate\Support\Str;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //private $roomId;

    public function __construct()
    {
        $users=User::all();
        if(count($users)==0)
        {
        $this->middleware('guest');
        }
        else{
            $this->middleware('admin');
        }
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
     * @return \App\User
     */
    protected function create(array $data)
    {
        $refreshdate = date('U');
       
        $refreshdate=date('Y-m-d H:i:s',$refreshdate+2592000);
        if(!is_null(User::first()))
            if($data['plan'] == 'Hidrosfera')
                $remaining = 12;
            else if ($data['plan'] == 'Ekosfera')
                $remaining = 20;
            else if ($data['plan'] == 'Atmosfera')
                $remaining = 40;
            else
                $remaining = 8;

        // FileNotification::create([
        //     'user_id' => 1,                 //JEI BUS DAUGIAU NEI VIENAS ADMIN, PAKEISTI SIA EILUTE
        //     'message' => 'New user: '.$data['name'],
        //     'link' => 'users',
        // ]);

        

        
        Storage::makeDirectory($data['name']);
        if(is_null(User::first()))
        {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'position' => 'admin',
                'password' => Hash::make($data['password']),
                'avatar_image_number' => 0,
                
            ]);
        }
        else
        {
            $admin=Auth()->user();
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'position' => 'user',
                'password' => Hash::make($data['password']),
                'plan' => $data['plan'],
                'remaining' => $remaining,
                'refresh_date' => $refreshdate,
                'avatar_image_number' => 0,
            ]);

            Message::create([
                'sender_user_id' => 1,
                'receiver_user_id' => $user->id,
                'message' => 'Sveiki.'
            ]);

            Message::create([
                'sender_user_id' => 1,
                'receiver_user_id' => $user->id,
                'message' => 'Jei turėsite klausimų, kurių nerasite atsakymo D.U.K skiltyje, rašykite čia.'
            ]);

            return $admin;
        }
    }

    
}
