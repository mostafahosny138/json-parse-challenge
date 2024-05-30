<?php

namespace App\Http\Requests;

use App\Enums\ProvidersEnum;
use App\Enums\StatusCodeEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'provider' => ['nullable',new EnumValue(ProvidersEnum::class, false)],
            'balanceMin'=>['nullable','numeric','required_with:balanceMax'],
            'balanceMax'=>['nullable','numeric','required_with:balanceMin'],
            'statusCode'=>['nullable',new EnumValue(StatusCodeEnum::class, false)],
        ];
    }


}
