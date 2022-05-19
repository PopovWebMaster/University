<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\StudentsModel;

class EmailIsUniqueForEditStudent implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct($id)
    {
        $this->user_id = (int) $id;
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

        $email = $value;
        $id = $this->user_id;
        $result = $students->emailIsUniqueForEdit( $email, $id );

        return $result;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The email you selected has already been reserved by another student';
    }
}
