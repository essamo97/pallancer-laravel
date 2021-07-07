<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WordFilter implements Rule
{
    protected $words;
    protected $invalid;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($words)
    {
        $this->words = $words;
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
        foreach ($this->words as $words) {
            if (stripos($value, $words) !== false) {
                $this->invalid =$words;
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'you can not use the word "'.$this->invalid.'"! by rule class';
    }
}
