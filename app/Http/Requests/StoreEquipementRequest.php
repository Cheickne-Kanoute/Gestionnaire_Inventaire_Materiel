<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipementRequest extends FormRequest
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
            'nom'              => 'required|string|min:2|max:255',
            'type'             => 'required|string|in:PC,Serveur,Switch',
            'adresse_ip'       => 'required|ip|unique:equipements,adresse_ip',
            'date_acquisition' => 'required|date|before_or_equal:today',
            'statut'           => 'required|string|in:Actif,En maintenance',
            'prix'             => 'nullable|numeric|min:0|max:100000000',
        ];
    }

    /**
     * Custom validation messages in French.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nom.required'              => 'Le nom de l\'équipement est obligatoire.',
            'nom.min'                   => 'Le nom de l\'équipement doit contenir au moins 2 caractères.',
            'nom.max'                   => 'Le nom de l\'équipement ne peut pas dépasser 255 caractères.',
            'type.required'             => 'Le type d\'équipement est obligatoire.',
            'type.in'                   => 'Le type choisi doit être PC, Serveur ou Switch.',
            'adresse_ip.required'       => 'L\'adresse IP est obligatoire.',
            'adresse_ip.ip'             => 'Veuillez saisir une adresse IP valide (ex: 192.168.1.10).',
            'adresse_ip.unique'         => 'Cette adresse IP est déjà attribuée à un autre équipement.',
            'date_acquisition.required' => 'La date d\'acquisition est obligatoire.',
            'date_acquisition.date'     => 'La date d\'acquisition doit être une date valide.',
            'date_acquisition.before_or_equal' => 'La date d\'acquisition ne peut pas être dans le futur.',
            'statut.required'           => 'Le statut est obligatoire.',
            'statut.in'                 => 'Le statut doit être "Actif" ou "En maintenance".',
            'prix.numeric'              => 'Le prix doit être une valeur numérique.',
            'prix.min'                  => 'Le prix doit être supérieur ou égal à 0.',
            'prix.max'                  => 'Le prix ne peut pas dépasser 100 000 000 FCFA.',
        ];
    }
}
