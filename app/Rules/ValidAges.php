<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidAges implements Rule
{
    public function passes($attribute, $value)
    {
        $ages = explode(',', $value);

        foreach ($ages as $age) {
            if ((int) $age < 18) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'All the ages must be 18 or higher.';
    }
}
