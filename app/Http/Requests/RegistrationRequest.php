<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class RegistrationRequest extends FormRequest
{
    private const EMAIL_PARAM = 'email';
    private const PASSWORD_PARAM = 'password';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::PASSWORD_PARAM => 'required|string',
            self::EMAIL_PARAM => 'required|string',
        ];
    }

    public function getPassword(): string
    {
        return $this->get(self::PASSWORD_PARAM);
    }

    public function getEmail(): string
    {
        return $this->get(self::EMAIL_PARAM);
    }
}
