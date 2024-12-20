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
            if (!isset($image['is_main'])) return false;
            return (bool) $image['is_main'] === true;
        });

        $mainImagesCount = $images->count();

        if ($mainImagesCount === 1) return;

        if ($mainImagesCount > 1) {
            abort(400, __('images.errors.one_main_image_max'));
        } else {
            abort(400, __('images.errors.one_main_image_min'));
        }
    }
}
