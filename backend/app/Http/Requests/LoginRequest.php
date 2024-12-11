<?php

namespace App\Http\Requests;

use App\Models\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $this->merge(['user' => User::where('email', $this->email)->first()]);
        return ($this->user && Hash::check($this->password,$this->user->password));
    }
}
