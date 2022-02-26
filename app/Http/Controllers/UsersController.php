<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Querys\UsersQuery;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(UsersQuery $usersQuery)
    {
        return $usersQuery->paginate(request()->per_page);
    }
}
