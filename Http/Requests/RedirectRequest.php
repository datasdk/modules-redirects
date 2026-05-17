<?php

namespace Modules\Redirect\Http\Requests;

use Orion\Http\Requests\Request;

class RedirectRequest extends Request
{
    /**
     * Validation rules for storing a redirect.
     *
     * @return array
     */
    public function storeRules(): array
    {
        return [
            'name' => 'required|string|unique:redirects,name',
            'url'  => 'required|string',
        ];
    }

    /**
     * Validation rules for updating a redirect.
     *
     * @return array
     */
    public function updateRules(): array
    {
        $id = $this->route('redirect'); // Henter ID'en fra route-parametret

        return [
            'name' => 'sometimes|required|string|unique:redirects,name,' . $id,
            'url'  => 'sometimes|required|string',
        ];
    }

    /**
     * Validation rules for batch updating multiple redirects.
     *
     * For eksempel input som:
     * [
     *    { "id": 1, "name": "foo", "url": "https://..." },
     *    { "id": 2, "name": "bar", "url": "https://..." }
     * ]
     *
     * @return array
     */
    public function batchUpdateRules(): array
    {
        return [
            'resources' => 'required|array',
            'resources.*.title' => 'required|string',
            'resources.*.url' => 'required|string',
        ];
    }



    /**
     * Custom error messages (optional).
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Navn på redirect er påkrævet.',
            'name.unique' => 'Navnet eksisterer allerede.',
            'url.required' => 'URL er påkrævet.',
            'url.url' => 'URL skal være en gyldig webadresse.',
            '*.id.required' => 'ID for redirect er påkrævet.',
            '*.id.exists' => 'Redirect med denne ID findes ikke.',
            '*.name.distinct' => 'Redirect navne skal være unikke i batchen.',
        ];
    }
}
