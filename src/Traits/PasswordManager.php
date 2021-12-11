<?php


namespace Aboleon\Framework\Traits;


use Illuminate\Support\Str;

trait PasswordManager
{
    use PasswordGenerator;
    use Responses;
    use Validation;

    private bool $requested_change = false;
    private bool $requested_password = false;

    private function managePasswordChange(): void
    {
        $this->requested_change = request()->has('password_change');
        $this->requested_password = request()->filled('password');

        if (!$this->requested_change) {
            return;
        }

        if ($this->requested_password && !request()->has('random_password')) {
            $this->passwordChangeControl();
            $this->public_password = request()->password;
        } else {
            $this->public_password = Str::random($this->password_length);
        }

        $this->hashPassword();

        $this->validated_data['password'] = $this->hashed_password;
        $this->responseSuccess("Le mot de passe a été changé. Le nouveau mot de passe est: " . $this->public_password);
        //$this->responseSuccess("Les codes d'accès ont été envoyés à l'utilisateur (mais pas en vrai, zut)");

    }

    private function generatePasswordForNewUser(): void
    {

        $this->requested_password = request()->filled('password');

        if ($this->requested_password && !request()->has('random_password')) {
            $this->passwordValidationRules();
            $this->validation();
            $this->public_password = request()->password;
        } else {
            $this->public_password = Str::random($this->password_length);
        }
        $this->hashPassword();

        $this->validated_data['password'] = $this->hashed_password;
        $this->responseSuccess("Le mot de passe a été changé. Le nouveau mot de passe est: " . $this->public_password);
        $this->responseSuccess("Les codes d'accès ont été envoyés à l'utilisateur (mais pas en vrai, zut)");

    }

    private function createPassword(): void
    {
        $this->hashPassword();
        $this->validated_data['password'] = $this->hashed_password;
        $this->responseSuccess(__('crm.account.password_is', ['param' => $this->public_password]));
    }

    private function passwordChangeControl()
    {
        $this->passwordValidationRules();
        $this->validation();
    }

    private function passwordValidationRules()
    {
        $this->validation_rules['password'] = 'required|confirmed|alpha_dash|min:' . $this->password_length;
        $this->validation_messages['password.required'] = "Vous devez indiquer un mot de passe";
        $this->validation_messages['password.confirmed'] = "Les mots de passe ne sont pas identiques";
        $this->validation_messages['password.alpha_dash'] = "Les mots de passe peuvent contenir chiffre, lettres et tirets";
        $this->validation_messages['password.min'] = "Le mot de passe doit être au minimum ".$this->password_length." caractères";
    }

}
