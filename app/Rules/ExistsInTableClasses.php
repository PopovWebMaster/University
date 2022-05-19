<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\ClassesModel;


class ExistsInTableClasses implements Rule
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
        $classes = new ClassesModel();
        return $classes->checkNameExistence( $value );

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The class name you selected is not in the list of existing classes';
    }
}
