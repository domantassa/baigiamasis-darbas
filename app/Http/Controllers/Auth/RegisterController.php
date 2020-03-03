<?php
namespace App\Http\Controllers\Auth;

use App\User;
use App\FileNotification;
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

    private $chatkit;
    //private $roomId;

    public function __construct()
    {
        $this->middleware('guest');
        $this->chatkit = app('ChatKit');
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
            'username' => 'required|string|max:255|unique:users',
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
        $chatkit_id = $data['username'].''.strtolower(Str::random(5));
        $roomName = $data['username'].''.strtolower(Str::random(5));
        $roomId = $data['username'].''.strtolower(Str::random(5));
        // Create User account on ChatKit

        if(is_null(User::first()))
        {
            $this->chatkit->createUser([
                'id' =>  'admin',
                'name' => $data['name'],
            ]);
            $this->chatkit->createRoom([
                'id' => $roomId,
                'creator_id' => 'admin',
                'name' => $chatkit_id,
                'private' => true,
    
            ]);
        }
        else
        {
            $this->chatkit->createUser([
                'id' =>  $chatkit_id,
                'name' => $data['name'],
            ]);
            $this->chatkit->createRoom([
                'id' => $roomId,
                'creator_id' => 'admin',
                'name' => $chatkit_id,
                'private' => false,
    
            ]);
            $this->chatkit->addUsersToRoom([
                'room_id' => $roomId,
                'user_ids' => [$chatkit_id],
            ]);
        }

        
        

        

        FileNotification::create([
            'user_id' => 1,                 //JEI BUS DAUGIAU NEI VIENAS ADMIN, PAKEISTI SIA EILUTE
            'message' => $data['name'],
        ]);

        
        Storage::makeDirectory($data['name']);
        if(is_null(User::first()))
        {
            return User::create([
                'name' => $data['name'],
                'username' => 'admin',
                'roomID' => $roomId,
                'email' => $data['email'],
                'position' => 'admin',
                'password' => Hash::make($data['password']),
            ]);
        }
        else
        {
            return User::create([
                'name' => $data['name'],
                'username' => $chatkit_id,//$chatkit_id,
                'roomID' => $roomId,
                'email' => $data['email'],
                'position' => 'user',
                'password' => Hash::make($data['password']),
            ]);
        }
    }
}
