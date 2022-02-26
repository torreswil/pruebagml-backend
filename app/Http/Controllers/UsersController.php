<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Querys\UsersQuery;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(UsersQuery $usersQuery)
    {
        return $usersQuery->paginate(request()->per_page);
    }

    public function update(User $user, UpdateUserRequest $request)
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
