<?php

namespace App\Http\Controllers\PracticeQueries;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BasicsController extends Controller
{
    // 1) List all users with their email addresses.
    public function query_01() {
    
        // SQL : select name, email from users;
        $userORM = User::select('name', 'email')->get();
        $userDB = DB::table('users')->select('name', 'email')->get();

        dd('$userORM: ', $userORM, '$userDB: ', $userDB);
  
            ->whereHas('categories', function($query) {
                $query->where('name', 'Electronics');
            })
            ->get()
        ;
        // dd('ormQuery: ', $ormQuery);

        $dbQuery = 
            DB::table('products as p')->select('p.name')
                ->join('product_categories as pc', 'p.id', '=', 'pc.product_id')
                ->join('categories as c', 'pc.category_id', '=', 'c.id')
                ->where('c.name', 'Electronics')
                ->get()
        ;

        dd('ormQuery: ', $ormQuery, '$dbQuery: ', $dbQuery);

    }
}
