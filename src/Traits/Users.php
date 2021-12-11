<?php


namespace Aboleon\Framework\Traits;

use Aboleon\Roles\Traits\Roles;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

trait Users
{
    use PasswordGenerator;
    use PasswordValidationRules;
    use Roles;
    use Validation;

    protected static $guard_name = "web";

    private ?int $against_user_id = null;

    private array $user_types = [
        'admin' => [
            'id' => 1,
            'label' => 'Administrateur CRM'
        ],
        'employee' => [
            'id' => 2,
            'label' => 'Esthéticienne'
        ],
        'client' => [
            'id' => 3,
            'label'=>'Client'
        ]
    ];

    public function userTypes(): array
    {
        return $this->user_types;
    }

    public function isCLient(): bool
    {
        return $this->type == $this->user_types['client']['id'];
    }

    public function isAdmin(): bool
    {
        return $this->type == $this->user_types['admin']['id'];
    }

    public function isEmployee(): bool
    {
        return $this->type == $this->user_types['employee']['id'];
    }

    protected function basicUserRules()
    {
        $this->validation_rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'.($this->against_user_id ? ',email,'.$this->against_user_id : '')]
        ];
    }

    protected function basicUserMessages()
    {
        $this->validation_messages = [
            'first_name.required' => __('validations.required', ['param' => __('aboleon.framework::ui.account.first_name')]),
            'first_name.string' => __('validations.string', ['param' => __('aboleon.framework::ui.account.first_name')]),
            'first_name.max' => __('validations.max', ['param' => __('aboleon.framework::ui.account.first_name')]),
            'last_name.required' => __('validations.required', ['param' => __('aboleon.framework::ui.account.last_name')]),
            'last_name.string' => __('validations.string', ['param' => __('aboleon.framework::ui.account.first_name')]),
            'last_name.max' => __('validations.max', ['param' => __('aboleon.framework::ui.account.last_name')]),
            'email.required' => __('validations.required', ['param' => __('aboleon.framework::ui.email_address')]),
            'email.email' => __('validations.email'),
            'email.max' => __('validations.max', ['param' => __('aboleon.framework::ui.email_address')]),
            'email.unique' => __('validations.exists', ['param' => __('aboleon.framework::ui.email_address')]),
            'password' => $this->passwordRules(),
        ];
    }

    protected function basicUserValidation(int $against_user_id=null)
    {
        $this->againstUserId($against_user_id);
        $this->basicUserRules();
        $this->basicUserMessages();
        $this->validation();
    }


    private function againstUserId(?int $id)
    {
        if ($id) {
            $this->against_user_id = $id;
        }
    }

    public function names(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
