<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OneMainImage implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $images = collect($value)->filter(function ($image) {
            return (bool) $image['is_main'] === true;
        });

        $mainImagesCount = $images->count();

        if ($mainImagesCount === 1) return;

        if ($mainImagesCount > 1) {
            abort(400, 'Only one main image is allowed');
        } else {
            abort(400, 'At least one main image is required');
        }
    }
}
