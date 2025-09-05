<?php

namespace App\Http\Controllers\PracticeQueries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;


class BasicsController extends Controller
{
    // JOINS : join('join_table', 'main_table.column_name', '=', 'join_table.column_name')
        // leftJoin
        // Alias ?
    
    // Query Builder :  DB::table('users'), rest is same as eloquent
    //  GROUP BY is only needed when you're performing aggregates like COUNT, SUM, AVG, etc., to collapse rows.
    // left join to right join or right join to left join ---> reverse the table order
    // ORDER BY--> If sorting was needed

    // 1) Find all users and their roles using an inner join.
    
    public function joins_01() {

        $eloquentORM = User::join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->select('users.name', 'roles.role_name')
            ->orderBy('users.id')
            ->get()
        ;

        // dd('Eloquent ORM', $eloquentORM);

        // Returns users with roles collection; filter to exclude users without roles if needed: ->has('roles')
        // // To flatten: $flattened = $results->flatMap(fn($user) => $user->roles->map(fn($role) => ['user_id' => $user->id, 'name' => $user->name, 'role_id' => $role->id, 'role_name' => $role->role_name]));

        // User::with('roles')->get();: 
        // This fetches all users and eagerly loads their roles as a nested collection ($user->roles). 
        // If a user has multiple roles (e.g., user_id 3 from sample data has 'editor' and 'admin'), $user->roles will be a collection with 2+ items. 
        // Users with no roles have an empty collection. This matches the inner join intent but in object form—no data is "not showing"; it's just structured.
        $ormRelationship = User::with('roles')->get();

        // User::has('roles')->get();: 
        // This filters to only users who have at least one role (excludes users with empty roles collections). 
        // Use this if you want to mimic INNER JOIN (only matching users).
        $ormRelationshipHas = User::has('roles')->get();

        // dd('Eloquent ORM Relationship', $ormRelationship,  $ormRelationshipHas);

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

        dd('Find all users and their roles using an inner join','Eloquent ORM', $eloquentORM, 'Eloquent ORM Relationship', $ormRelationship,  $ormRelationshipHas, 'Query Builder', $queryBuilder, 'SQL', $sql);
    }

    // 2) List all users, even if they have no roles, using a left join.

    public function joins_02() {

        $eloquentORM = User::leftJoin('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->leftJoin('roles', 'user_roles.role_id', '=', 'roles.id')
            ->select('users.name', 'roles.role_name')
            ->orderBy('users.id')
            ->get()
        ;

        
        // dd('Eloquent ORM', $eloquentORM);
        // All users, with empty roles collection if none
        // To flatten: 
        // $flattened = $results->flatMap(fn($user) => $user->roles->isEmpty() ? [['user_id' => $user->id, 'name' => $user->name, 'role_id' => null, 'role_name' => null]] : $user->roles->map(fn($role) => ['user_id' => $user->id, 'name' => $user->name, 'role_id' => $role->id, 'role_name' => $role->role_name]));
        $ormRelationship = User::with('roles')->get();
        
        // dd('Eloquent ORM', $eloquentORM, $ormRelationship);

        $queryBuilder = DB::table('users')
            ->leftJoin('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->leftJoin('roles', 'user_roles.role_id', '=', 'roles.id')
            ->select('users.name', 'roles.role_name')
            ->orderBy('users.id')
            ->get()
        ;

        // dd('Query Builder', $queryBuilder);

        // Raw DB / SQL Query
        $sql = DB::select('
            SELECT u.name, r.role_name
            from users u
            left join user_roles ur on u.id = ur.user_id
            left join roles r on ur.role_id = r.id;
        ');

        // dd('SQL', $sql);

        dd('List all users, even if they have no roles, using a left join','Eloquent ORM', $eloquentORM,'Eloquent ORM Relationship' , $ormRelationship,'Query Builder', $queryBuilder, 'SQL', $sql);
    }

    // 3) List all roles, even if no users have them, using a right join.
    
    public function joins_03() {
        // For Eloquent: 
        //     It's model-centric and starts from the roles table (base for Role::), making RIGHT JOIN tricky for preserving the base without exclusions. 
        //     Eloquent is better suited for LEFT JOIN here to achieve the equivalent result (preserving the base model).
        //     I'll provide both, noting the preference.

        $eloquentORM = Role::leftJoin('user_roles', 'roles.id', '=', 'user_roles.role_id')
            ->leftJoin('users', 'user_roles.user_id', '=', 'users.id')
            ->select('users.name', 'role_name')
            ->get()
        ;

        // dd($eloquentORM);

        // All roles, with empty users collection if none
        // To flatten: 
            // $flattened = $results->flatMap(fn($role) => $role->users->isEmpty() ? [['role_id' => $role->id, 'role_name' => $role->role_name, 'user_id' => null, 'name' => null]] : $role->users->map(fn($user) => ['role_id' => $role->id, 'role_name' => $role->role_name, 'user_id' => $user->id, 'name' => $user->name]));
        $ormRelationship = Role::with('users')->get();

        $queryBuilder = DB::table('users')
            ->rightJoin('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->rightJoin('roles', 'user_roles.role_id', '=', 'roles.id')
            ->select('roles.id as role_id', 'roles.role_name', 'users.id as user_id', 'users.name')
            ->get()
        ;

        $rawDBSQL = DB::select('
            SELECT roles.id as role_id, roles.role_name, users.id as user_id, users.name 
            FROM users 
            RIGHT JOIN user_roles ON users.id = user_roles.user_id 
            RIGHT JOIN roles ON user_roles.role_id = roles.id'
        );

        dd('List all roles, even if no users have them, using a right join.', '$eloquentORM', $eloquentORM, '$ormRelationship', $ormRelationship, '$queryBuilder', $queryBuilder, '$rawDBSQL', $rawDBSQL);
    }
}
