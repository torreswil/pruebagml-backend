<?php

namespace App\Querys;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;

class UsersQuery extends \Spatie\QueryBuilder\QueryBuilder
{
    public function __construct(Builder $builder, Request $request = null)
    {
        parent::__construct(User::query());

        $this->allowedFilters([
            AllowedFilter::scope('search'),
            'categoria_id',
            'pais'
        ]);

    }
}
