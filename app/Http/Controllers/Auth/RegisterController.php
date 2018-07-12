<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'avatar_filename' => 'avatar_filename',
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
        // 1から10までをランダムで取得
        $nums = rand(1, 11);
        // 画像を変数に格納
        $buta = 'images/buta.png';
        $kirin = 'images/kirin.png';
        $kuma = 'images/kuma.png';
        $niwatori = 'images/niwatori.png';
        $pengin = 'images/pengin.png';
        $saru = 'images/saru.png';
        $tora = 'images/tora.png';
        $usagi = 'images/usagi.png';
        $ushi = 'images/ushi.png';
        $zou = 'images/zou.png';
        $bird = 'images/bird.png';

        // Switch文で$numsの値によってavatar_filenameに格納される画像を変更
        switch($nums){
            case 1:
                return User::create([
                    'name' => $data['name'],
                    'password' => bcrypt($data['password']),
                    'avatar_filename' => $buta,
                ]);
                break;
            case 2:
                return User::create([
                    'name' => $data['name'],
                    'password' => bcrypt($data['password']),
                    'avatar_filename' => $kirin,
                ]);
                break;
            case 3:
                return User::create([
                    'name' => $data['name'],
                    'password' => bcrypt($data['password']),
                    'avatar_filename' => $kuma,
                ]);
                break;
            case 4:
                return User::create([
                    'name' => $data['name'],
                    'password' => bcrypt($data['password']),
                    'avatar_filename' => $niwatori,
                ]);
                break;
            case 5:
                return User::create([
                    'name' => $data['name'],
                    'password' => bcrypt($data['password']),
                    'avatar_filename' => $pengin,
                ]);
                break;
            case 6:
                return User::create([
                    'name' => $data['name'],
                    'password' => bcrypt($data['password']),
                    'avatar_filename' => $saru,
                ]);
                break;
            case 7:
                return User::create([
                    'name' => $data['name'],
                    'password' => bcrypt($data['password']),
                    'avatar_filename' => $tora,
                ]);
                break;
            case 8:
                return User::create([
                    'name' => $data['name'],
                    'password' => bcrypt($data['password']),
                    'avatar_filename' => $usagi,
                ]);
                break;
            case 9:
                return User::create([
                    'name' => $data['name'],
                    'password' => bcrypt($data['password']),
                    'avatar_filename' => $ushi,
                ]);
                break;
            case 10:
                return User::create([
                    'name' => $data['name'],
                    'password' => bcrypt($data['password']),
                    'avatar_filename' => $zou,
                ]);
                break;
            case 11:
                return User::create([
                    'name' => $data['name'],
                    'password' => bcrypt($data['password']),
                    'avatar_filename' => $bird,
                ]);
                break;
        }

        return User::create([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
            'avatar_filename' => $zou,
        ]);

    }
}
