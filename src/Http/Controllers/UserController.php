<?php

namespace Aboleon\Framework\Http\Controllers;

use Aboleon\Framework\Models\User;
use Aboleon\Roles\Models\Role;
use Aboleon\Roles\Models\UserRole;
use Aboleon\Framework\Traits\{
    PasswordManager,
    Users};
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Throwable;

class UserController extends Controller
{
    use PasswordManager;
    use Users;

    public function index(string $role): Renderable
    {
        return view('aboleon.framework::users.index')->with([
            'data' => User::withRole($role)->orderBy('last_name')->orderBy('first_name')->paginate(15),
            'role' => $role
        ]);
    }

    public function create(): Renderable
    {
        return view('aboleon.framework::users.add')->with([
            'account' => null
        ]);
    }

    public function store(): RedirectResponse
    {
        $this->basicUserValidation();
        $this->generatePasswordForNewUser();

        try {
            $this->validated_data['type'] = $this->userTypes()['admin']['id'];
            $user = User::create($this->validated_data);
            $user->roles()->save(new UserRole(['role_id' => 2]));
            $this->responseSuccess(__('aboleon.framework::ui.record_created'));
            $this->redirect_to = route('aboleon.framework.users.edit', $user->id);

        } catch (Throwable $e) {
            $this->responseException($e);
        }
        return $this->sendResponse();
    }

    public function edit(User $user): Renderable
    {
        return view('aboleon.framework::users.edit')->with([
            'account' => $user
        ]);
    }

    public function update(User $user): RedirectResponse
    {
        $this->basicUserValidation($user->id);
        $this->managePasswordChange();

        try {
            $user->update($this->validated_data);
            $this->responseSuccess(__('aboleon.framework::ui.record_update'));

        } catch (Throwable $e) {
            $this->responseException($e);
        }
        return $this->sendResponse();
    }
}
