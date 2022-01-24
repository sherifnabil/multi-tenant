<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Events\UserWasCreated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    protected function create(array $data): User
    {
        $tenantDb = explode('@', $data['email'])[0] . '_'. rand(1, 1000000);
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'db_name' => $tenantDb,
            'remember_token' => Str::random(60),
        ]);

        if (!session('auth_user')) {
            session()->put('tenant_db', $user);
        }

        event(new UserWasCreated($user));
        return $user;
    }
}
