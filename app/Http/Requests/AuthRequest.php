<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Route;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $route_name = Route::current()->getName();
        // if ($route_name == 'register') {
        //     return $this->register();
        // }

        if ($route_name == 'login') {
            return $this->login();
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function login()
    {
        $password = Password::min(8)->mixedCase()->numbers()->symbols();
        return [
            'email' => 'email|required|string',
            'password' => ['required', $password],
        ];
    }

    // /**
    //  * Get the validation rules that apply to the request.
    //  *
    //  * @return array
    //  */
    // protected function register()
    // {
    //     $password = Password::min(8)->mixedCase()->numbers()->symbols();
    //     return [
    //         'name' => 'required|string|max:100',
    //         'email' => 'email|required|string|unique:users',
    //         'password' => ['required', 'confirmed', $password],
    //     ];
    // }
}
