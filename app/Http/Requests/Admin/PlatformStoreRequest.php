<?php

namespace App\Http\Requests\Admin;

use App\Models\platform;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class PlatformStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:2|unique:platforms,name',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function storePlatform()
    {
        return DB::transaction(function () {
            $platform = Platform::create($this->validated());
            $path = $this->image->store('platforms');

            $platform->image()->create([
                'path' => $path,
                'is_main' => true,
                'extension' => $this->image->extension(),
                'size' => $this->image->getSize(),
                'type' => 'photo',
            ]);

            return $platform;
        });
    }
}
