<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

final class PostAuthTokenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'usr'      => 'required|max:20|min:2|alpha_dash',
            'pwd'      => 'required|max:32|min:32|alpha_num',
            'otp_code' => 'required|size:6|integer',
        ];
    }
}
