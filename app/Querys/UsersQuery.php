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
        $baseQuery = User::select('users.*','categorias.descripcion as descripcion_categoria')
            ->join('categorias','categorias.id','=','users.categoria_id');
        
        parent::__construct($baseQuery);

        $this->allowedFilters([
            AllowedFilter::scope('search'),
            'categoria_id',
            'pais'
        ]);

    }
}
