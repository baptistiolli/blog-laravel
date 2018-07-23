<?php

namespace Blog\Http\Controllers\Auth;

use Blog\User;
use Blog\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/home';

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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            $validateData['password'] = bcrypt(array_get($validateData, 'password'));
            $validateData['actiovation_code'] = str_random(30).time();
            $user = app(User::class)->create($validateData);

        } catch (\Excepetion $exception) {
            logger()->error($exception);

            return redirect()->back()->with('message', 'Impossível criar novo usuário.');
        }

        $user->notify(new UserRegisteredSuccesfully($user));

        return redirect()->back()->with('message', 'Criado nova conta com sucesso. Por favor, verifue seu email e seu código de ativação.');
    }

    /**
     * Activate the user with given activation code.
     * @param string $activationCode
     * @return string
     */
    public function activateUser(string $activationCode)
    {
        try {
            $user = app(User::class)->where('activation_code', $activationCode)-first();
            if (!$user)
            {
                return 'O código não é compatível com nenhum usuário.';
            }
            $user->status = 1;
            $user->activation_code = null;
            $user->save();
            auth()->login($user);
        } catch (\Excepetion $excepetion) {
            logger()->error($excepetion);

            return 'Oops! Algo deu errado.';
        }

        return redirect()->to('/home');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Blog\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


    }
}
