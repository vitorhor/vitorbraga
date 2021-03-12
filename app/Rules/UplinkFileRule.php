<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UplinkFileRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $blockedExtensions = ["exe", "bmp", "php"];
        $fileExtension = strtolower($value->getClientOriginalExtension());

        return !in_array($fileExtension, $blockedExtensions);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The file must not have .exe, .bmp or .php extension.";
    }
}
