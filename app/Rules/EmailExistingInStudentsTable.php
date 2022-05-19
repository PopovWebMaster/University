<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\StudentsModel;

class EmailExistingInStudentsTable implements Rule
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
        $students = new StudentsModel();

        return $students->emailIsExisting($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The email you selected is not in the list of existing students';
    }
}
