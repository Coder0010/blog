<?php

namespace App\Domains\Auth\Http\Controllers\EndUser\Auth;

use App\Domains\Auth\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Domains\Auth\Providers\RouteServiceProvider;

class RegisterController extends Controller
{
    use RegistersUsers;

    public $redirectTo = RouteServiceProvider::HOME;

    public $domainAlias = "auths";

    public $nameSpace = "enduser";

    public $crudName = "auth";

    public function __construct()
    {
        $this->middleware("guest");
    }

    protected function showRegistrationForm()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.register", [
            "nameSpace" => $this->nameSpace,
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            "first_name"  => "required|string|max:255",
            "last_name"   => "required|string|max:255",
            "email"       => "required|string|email|max:255|unique:users",
            "phone"       => "required|string|max:255|unique:users",
            "password"    => "required|string|min:8|confirmed",
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            "status"   => config("system.status.active"),
            "name"     => $data["first_name"]."-".$data["last_name"],
            "email"    => $data["email"],
            "phone"    => $data["phone"],
            "password" => $data["password"],
        ]);
        $user->assignRole(config("system.roles.normal.id"));
        return $user;
    }
}
