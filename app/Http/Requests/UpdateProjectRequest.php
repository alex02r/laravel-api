<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'description'=>'required',
            'type_id'=>'exists:types,id',
            'start_date'=>'required',
            'img'=>'file|image'
        ];
    }
    public function messages(){
        return [
            'name' => 'Il Nome del progetto deve essere obbligatorio',
            'description' => 'La descrizione del progetto deve essere obbligatoria',
            'type_id'=> 'La categoria è categoria inesistente',
            'start_date' => 'La data di inizio del progetto deve essere obbligatoria',
            'img.file'=>'Non hai inserito un file nel caricamento dell\'immagine',
            'img.image'=>'Non hai inserito un estenzione valida per l\'immagine (.jpg, .png, .gif, .jpeg ...)'
        ];
    }
}
