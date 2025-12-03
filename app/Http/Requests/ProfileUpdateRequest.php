<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'fullName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];

        // Get the user's role
        $user = $this->user();

        if ($user->role === 'Manager') {
            $rules['occupation'] = ['required', 'string', 'max:255'];
            $rules['teamName'] = [ 'string', 'max:255'];
            $rules['address'] = ['required', 'string', 'max:255'];
            $rules['country'] = ['required', 'string', 'max:255'];
        } elseif ($user->role === 'Player') {
            $rules['dob'] = ['required', 'date'];
            $rules['displayName'] = ['required', 'string', 'max:255'];
            $rules['jerseyNumber'] = ['required', 'integer', 'min:1'];
            $rules['position'] = ['required', 'string', 'max:255'];
            $rules['contact'] = ['required', 'string', 'max:255'];
        }

        // No additional fields are defined for Admins, but you can add them here if needed.

        return $rules;
    }
}
