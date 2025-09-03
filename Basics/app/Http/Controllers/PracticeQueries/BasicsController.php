<?php

namespace App\Http\Controllers\PracticeQueries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;


class BasicsController extends Controller
{
    // JOINS : join('join_table', 'main_table.column_name', '=', 'join_table.column_name')
        // leftJoin
        // Alias ?
    
    // Query Builder :  DB::table('users'), rest is same as eloquent


    // 1) Find all users and their roles using an inner join.
    
    public function joins_01() {

        // groupBy() ?

        $eloquentORM = User::join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->select('users.name', 'roles.role_name')
            ->orderBy('users.id')
            ->get()
        ;

        // dd('Eloquent ORM', $eloquentORM);

        $queryBuilder = DB::table('users')
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->select('users.name', 'roles.role_name')
            ->orderBy('users.id')
            ->get()
        ;

        // dd('Query Builder', $queryBuilder);

        // Raw DB Query
        $sql = DB::select('
            SELECT u.name, r.role_name
            from users u
            join user_roles ur on u.id = ur.user_id
            join roles r on ur.role_id = r.id;
        ');

        // dd('SQL', $sql);

        dd('Find all users and their roles using an inner join','Eloquent ORM', $eloquentORM, 'Query Builder', $queryBuilder, 'SQL', $sql);
    }

    // 2) List all users, even if they have no roles, using a left join.

    public function joins_02() {

        // groupBy() ?

        $eloquentORM = User::leftJoin('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->leftJoin('roles', 'user_roles.role_id', '=', 'roles.id')
            ->select('users.name', 'roles.role_name')
            ->orderBy('users.id')
            ->get()
        ;

        // dd('Eloquent ORM', $eloquentORM);

        $queryBuilder = DB::table('users')
            ->leftJoin('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->leftJoin('roles', 'user_roles.role_id', '=', 'roles.id')
            ->select('users.name', 'roles.role_name')
            ->orderBy('users.id')
            ->get()
        ;

        // dd('Query Builder', $queryBuilder);

        // Raw DB Query
        $sql = DB::select('
            SELECT u.name, r.role_name
            from users u
            left join user_roles ur on u.id = ur.user_id
            left join roles r on ur.role_id = r.id;
        ');

        // dd('SQL', $sql);

        dd('List all users, even if they have no roles, using a left join','Eloquent ORM', $eloquentORM, 'Query Builder', $queryBuilder, 'SQL', $sql);
    }

    // 3) List all roles, even if no users have them, using a right join.
    
    public function joins_03() {

    }
}
