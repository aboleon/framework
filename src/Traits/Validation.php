<?php


namespace Aboleon\Framework\Traits;


use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Str;

trait Validation
{
    protected $validation_rules = [];
    protected $validation_messages = [];
    protected $validated_data = [];

    protected function validation()
    {
        if ($this->validation_rules) {
            $this->validated_data = request()->validate(
                $this->validation_rules,
                $this->validation_messages
            );
        }
    }
}
