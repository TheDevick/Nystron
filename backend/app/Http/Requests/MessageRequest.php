<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class MessageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => ["required", "max:50"],
            "lastName" => ["required", "max:100"],
            "telephone" => ["required", "max:21", "regex:#^\+([0-9]{2,3})((\s\([0-9]{2}\)\s)|(\s))([0-9]{4,5})\s-\s([0-9]{4})$#"],
            "email" => ["required", "max:100", "email"],
            "message" => ["required", "max:1000"]
        ];
    }

    protected function failedValidation(Validator $Validator)
    {
        $ValidationException = new ValidationException($Validator);

        $Errors = $ValidationException->errors();
        $FirstError = reset($Errors);
        $FirstErrorMessage = $FirstError[0];

        $Response = [
            "Status Code" => "400",
            "Type" => "Error",
            "Message" => $FirstErrorMessage
        ];

        throw new HttpResponseException(
            response()->json($Response, 400)
        );
    }

    public function messages()
    {
        return [
            "name.required" => "Precisa digitar um Nome",
            "name.max" => "O Nome - Máximo 50 caracteres",

            "lastName.required" => "Precisa digitar um Sobrenome",
            "lastName.max" => "O Sobrenome - Máximo 100 caracteres",

            "telephone.required" => "Precisa digitar um Telefone",
            "telephone.max" => "O Telefone deve manter os seguintes formatos: +55 (55) xxxxx - xxxx ou +598 xxxxx - xxxx",
            "telephone.regex" => "O Telefone deve manter os seguintes formatos: +55 (55) xxxxx - xxxx ou +598 xxxxx - xxxx",

            "email.required" => "Precisa digitar um Email",
            "email.max" => "O Email - Máximo 100 caracteres",
            "email.email" => "O Email deve ser um email válido",

            "message.required" => "Precisa digitar um Mensagem",
            "message.max" => "A Mensagem - Máximo 1000 caracteres"
        ];
    }
}
