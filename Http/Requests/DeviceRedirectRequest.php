<?php

namespace Modules\Redirect\Http\Requests;

use Orion\Http\Requests\Request;

class DeviceRedirectRequest extends Request
{
    /**
     * Validation rules for storing a device redirect.
     *
     * @return array
     */
    public function storeRules(): array
    {
        return [
            'name' => 'required|string|unique:device_redirects,name',
            'platform' => 'required|string|in:ios,android,web',
            'url' => 'required|url',
        ];
    }

    /**
     * Validation rules for updating a device redirect.
     *
     * @return array
     */
    public function updateRules(): array
    {
        // Get the ID from the route so we can exclude it from the unique check
        $id = $this->route('device_redirect');

        return [
            'name' => 'sometimes|required|string|unique:device_redirects,name,' . $id,
            'platform' => 'sometimes|required|string|in:ios,android,web',
            'url' => 'sometimes|required|url',
        ];
    }

    /**
     * Custom error messages for validation.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.unique' => 'This name is already in use.',
            'platform.required' => 'Platform is required.',
            'platform.string' => 'Platform must be a string.',
            'platform.in' => 'Platform must be one of: ios, android, or web.',
            'url.required' => 'URL is required.',
            'url.url' => 'URL must be a valid URL.',
        ];
    }
}
