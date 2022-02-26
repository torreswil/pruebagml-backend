<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Http\Requests\UserRequest;
use App\Mail\UserWelcomeMail;
use App\Models\User;
use App\Querys\UsersQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function index(UsersQuery $usersQuery)
    {
        return $usersQuery->paginate(request()->per_page);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->all());

        event(new UserCreated($user));

        return $user;
    }

    public function update(User $user, UserRequest $request)
    {
        $user->update($request->all());
        return response('Usuario actualizado exitosamente',204);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response('Usuario borrado exitosamente',204);
    }
}
