<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name"          => "required|unique:products,name",
            "description"   => "required",
            "stock"         => "required|integer",
            "price"         => "required",
            "category_id"   => "required|exists:categories,id",
            "image"         => "",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required"         => "El campo nombre es obligatorio",
            "name.unique"           => "El nombre del producto ya esta registrado",
            "description.required"  => "El campo descripcion es onbligatorio",
            "stock.required"        => "El campo stock es obligatorio",
            "stock.integer"         => "Ingrese un numero valido para el Stock",
            "price.required"        => "El campo precio es onbligatorio",
            "category_id.required"  => "Debe asignar una categoria",
            "category_id.exists"    => "No se encontro la categoria",
        ];
    }
}
