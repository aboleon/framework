<?php


namespace Aboleon\Framework\Traits;


use Illuminate\Support\Str;

trait PasswordGenerator
{

    public string $hashed_password;
    public ?string $public_password = null;
    public int $password_length = 8;

    public function generatePassword(?int $lenght = null)
    {
        $this->password_length = $lenght ?: $this->password_length;
        $this->public_password = Str::random($this->password_length);
    }

    public function hashPassword()
    {
        if (is_null($this->public_password)) {
            $this->generatePassword();
        }
        $this->hashed_password = bcrypt($this->public_password);
    }
}
