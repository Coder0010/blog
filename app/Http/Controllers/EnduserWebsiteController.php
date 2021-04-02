<?php

namespace App\Http\Controllers;

use App\Core\Abstracts\ResourceController;

class EnduserWebsiteController extends ResourceController
{
    public function redirectToDashboard()
    {
        return redirect()->route("admin.dashboard");
    }

    public function changeLang(string $lang)
    {
        if (in_array($lang, AppLanguages())) {
            session()->put("lang", $lang);
        }
        return redirect()->back();
    }

}
