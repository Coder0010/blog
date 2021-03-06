<?php

namespace App\Domains\Auth\Http\Controllers\EndUser\Auth;

use DB;
use Session;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\Auth\Providers\RouteServiceProvider;
use App\Domains\Auth\Http\Requests\EndUser\EnduserUpdateUserRequest;

class ProfileController extends Controller
{
    public $redirectTo = RouteServiceProvider::HOME;

    public $domainAlias = "auths";

    public $nameSpace = "enduser";

    public $crudName = "auth";

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.profile", [
            "nameSpace" => $this->nameSpace,
            "user"      => auth()->user(),
            "orders"    => auth()->user()->orders
        ]);
    }

    protected function updateUser(EnduserUpdateUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user()->update([
                "name"     => request("first_name") .'-'. request("last_name"),
                "email"    => request("email"),
                "phone"    => request("phone"),
                "date"     => [
                    "day"   => request("day"),
                    "month" => request("month"),
                    "year"  => request("year"),
                ],
                "password" => request("password"),
            ]);
            Session::flash("success",  __("main.session_updated_message"));
            DB::commit();
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
            DB::rollback();
        }
        return redirect()->back();
    }
}
