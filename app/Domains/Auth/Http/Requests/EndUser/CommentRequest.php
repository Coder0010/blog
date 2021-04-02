<?php

namespace App\Domains\Auth\Http\Requests\EndUser;

use App\Domains\Auth\Http\Rules\ownerShip;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->isMethod("post")) {
            return [
                "message"  => config("rules.description"),
            ];
        }elseif (request()->isMethod("patch")) {
            return [
                "message"  => config("rules.description"),
                "identifier"  => [
                    "required",
                    new ownerShip(),
                ],
            ];
        }elseif (request()->isMethod("delete")) {
            return [
                "identifier"  => [
                    "required",
                    new ownerShip(),
                ],
            ];
        }
    }

}
