<?php

namespace App\Http\Controllers\PracticeQueries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Role;
use App\Models\Post;
use App\Models\User;

use function Laravel\Prompts\select;

class BasicsController extends Controller
{

// JOINS : join('join_table', 'main_table.column_name', '=', 'join_table.column_name')
        // leftJoin
        // Alias ?
    
    // Query Builder :  DB::table('users'), rest is same as eloquent
    //  GROUP BY is only needed when you're performing aggregates like COUNT, SUM, AVG, etc., to collapse rows.
    // left join to right join or right join to left join ---> reverse the table order
    // ORDER BY--> If sorting was needed

    // Question 1: Find all users and their roles using an inner join.
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

   // Question 2: List all users, even if they have no roles, using a left join.
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

    // Question 3: List all roles, even if no users have them, using a right join.
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

    // Question 4: Find users who have the same role as another user using self-join.
    public function joins_04(){
        $eloquentORM = User::join('user_roles as ur1', 'users.id', '=', 'ur1.user_id')
            ->join('user_roles as ur2', 'ur1.user_id', '<>', 'ur2.user_id')
            ->join('users as u2', 'ur2.user_id', '=', 'u2.id')
            ->where('ur1.role_id', '=', 'ur2.role_id')
            ->select('users.name as user1_name', 'ur1.role_id as user1_role', 'u2.name as user2_name', 'ur2.role_id as user2_role')
            ->get()
        ;

        $eloquentORM = User::join('user_roles as ur1', 'users.id', '=', 'ur1.user_id')
            ->join('user_roles as ur2', 'ur1.role_id', '=', 'ur2.role_id')
            ->join('users as u2', 'ur2.user_id', '=', 'u2.id')
            ->where('ur1.role_id', '<>', DB::raw('u2.id'))
            ->select('users.name as user1_name', 'ur1.role_id as user1_role', 'u2.name as user2_name', 'ur2.role_id as user2_role')
            ->get()
        ;

        dd('Eloquent ORM', $eloquentORM);
    }

    // Question 5: Generate a Cartesian product of users and products using cross join (limit to 10 rows).
    public function joins_05(){
        $eloquentORM = User::crossJoin('products')
            ->select('users.id as user_id', 'users.name as user_name', 'products.id as product_id', 'products.name as product_name')
            ->limit(10)
            ->get()
        ;

        // With Relationships
        $users = User::select('id', 'name')->get();
        $products = Product::select('id', 'name')->get();
        
        $ormRelationship = $users->crossJoin($products)
                            ->take(10)
                            ->map(fn($pair) => 
                                [
                                    'user_id'=> $pair[0]->id,
                                    'name' => $pair[0]->name,
                                    'product_id'=> $pair[1]->id,
                                    'product_name' => $pair[1]->name 
                                ]
                            )
        ;

        $queryBuilder = DB::table('users')
                        ->crossJoin('products')
                        ->select('users.id as user_id', 'users.name as user_name', 'products.id as product_id', 'products.name as product_name')
                        ->take(10)
                        ->get()
        ;

        $sql = DB::select('
                select u.id as user_id, u.name as user_name, p.id as product_id, p.name as product_name
                from users u
                cross join products p
                limit 10
        ');

        dd($eloquentORM, $ormRelationship, $queryBuilder, $sql);
    }

    // Question 6: Find posts with their author's name using inner join.
    public function joins_06() {
        $eloquent = Post::join('users', 'posts.user_id', '=', 'users.id')
                    ->select('posts.id as post_id', 'posts.title', 'users.id as user_id', 'users.name as author_name')
                    ->get()
        ;

        $eloquentORMRelationship = Post::with('user')
                                    ->get() // with('user') returns a Builder, not a Collection.You must call get() first to fetch the collection, then map
                                    ->map( fn ($map) =>
                                        [
                                            'posts_id' => $map->id,
                                            'post_title' => $map->title,
                                            'user_id' => $map->user?->id,
                                            'user_name' => $map->user?->name
                                        ]
                                    )
        ;

        $queryBuilder = DB::table('posts')
                    ->join('users', 'posts.user_id', '=', 'users.id')
                    ->select('posts.id as post_id', 'posts.title', 'users.id as user_id', 'users.name as author_name')
                    ->get()
        ;

        $sql =DB::select('
                SELECT posts.id as post_id, posts.title, users.id as user_id, users.name as author_name 
                FROM posts 
                INNER JOIN users ON posts.user_id = users.id
            ')
        ;

        dd($eloquent, $eloquentORMRelationship, $queryBuilder, $sql);

    }

    // Question 7: List products and their order quantities using left join on order_items.
    public function joins_07() {
        $eloquent = Product::leftJoin('order_items as ot', 'products.id', '=', 'ot.product_id')
                    -> select('products.name as product_name', 'sum(ot.quantity) as total_orders')
                    ->groupBY('products.id')        
        ;

        $eloquentORMRelationship = Product::with('orderItems')->get(); // Aggregates via withSum or post-process

        // Flatten: $flattened = $results->map(fn($product) => ['product_id' => $product->id, 'name' => $product->name, 'total_quantity' => $product->order_items_sum_quantity ?? 0]);
        $eloquentORMRelationshipSum = Product::withSum('orderItems', 'quantity')->get(); // Adds order_items_sum_quantity attribute

        $queryBuilder = DB::table('products')
                        ->leftJoin('order_items as ot', 'products.id', '=', 'ot.product_id')
                        -> select('products.name as product_name', 'sum(ot.quantity) as total_orders')
                        ->groupBY('products.id') 
        ;
        // dd('sdfe');

        $sqlDBRaw = DB::select('
            SELECT p.id, p.name, sum(o.quantity) as total_orders 
            from products p 
            left join order_items o on p.id = o.product_id 
            group by p.id, p.name
        ');

        dd($eloquent, $eloquentORMRelationship, $eloquentORMRelationshipSum, $queryBuilder, $sqlDBRaw);
    }

    // Question 8: Find users who have placed orders and their total amount using inner join and group by.
    public function joins_08() {

        $eloquent = User::join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.id as user_id', 'users.name', DB::raw('SUM(orders.total_amount) as total_spent'))
            ->groupBy('users.id', 'users.name')
            ->get()
        ;

        $eloquentORMRelationship = User::has('orders')->withSum('orders', 'total_amount')->get();  // Filters users with orders, adds orders_sum_total_amount
        // Flatten: $flattened = $results->map(fn($user) => ['user_id' => $user->id, 'name' => $user->name, 'total_spent' => $user->orders_sum_total_amount]);

        $queryBuilder = DB::table('users')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.id as user_id', 'users.name', DB::raw('SUM(orders.total_amount) as total_spent'))
            ->groupBy('users.id', 'users.name')
            ->get()
        ;

        $sqlDBRaw = DB::select('
            SELECT users.id as user_id, users.name, SUM(orders.total_amount) as total_spent 
            FROM users 
            INNER JOIN orders ON users.id = orders.user_id 
            GROUP BY users.id, users.name
        ');
        
        dd($eloquent, $eloquentORMRelationship, $queryBuilder, $sqlDBRaw);
    }

    // Question 9: List posts with number of likes using left join.
    public function joins_09() {
        
        $eloquent = Post::leftJoin('likes', 'posts.id', '=', 'likes.post_id')
            ->select('posts.id as post_id', 'posts.title', DB::raw('COUNT(likes.id) as like_count'))
            ->groupBy('posts.id', 'posts.title')
            ->get()
        ;

        $eloquentORMRelationship = Post::withCount('likes')->get();  // Adds likes_count attribute to each post
        // Flatten: $flattened = $results->map(fn($post) => ['post_id' => $post->id, 'title' => $post->title, 'like_count' => $post->likes_count]);

        $queryBuilder = DB::table('posts')
            ->leftJoin('likes', 'posts.id', '=', 'likes.post_id')
            ->select('posts.id as post_id', 'posts.title', DB::raw('COUNT(likes.id) as like_count'))
            ->groupBy('posts.id', 'posts.title')
            ->get()
        ;

        $sqlDBRaw = DB::select('SELECT posts.id as post_id, posts.title, COUNT(likes.id) as like_count FROM posts LEFT JOIN likes ON posts.id = likes.post_id GROUP BY posts.id, posts.title');

        dd($eloquent, $eloquentORMRelationship, $queryBuilder, $sqlDBRaw);
    }
    
    // Question 10: Find orders with product details using multiple joins (orders, order_items, products).
     public function joins_10() {
        
        $eloquent = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('orders.id as order_id', 'orders.total_amount', 'products.id as product_id', 'products.name as product_name', 'order_items.quantity')
            ->get()
        ;

        $eloquentORMRelationship =Order::with('orderItems.product')->get();  // Nested: orderItems collection, each with product model
        // To flatten: $flattened = $results->flatMap(fn($order) => $order->orderItems->map(fn($item) => ['order_id' => $order->id, 'total_amount' => $order->total_amount, 'product_id' => $item->product->id, 'product_name' => $item->product->name, 'quantity' => $item->quantity]));
        
        $queryBuilder = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('orders.id as order_id', 'orders.total_amount', 'products.id as product_id', 'products.name as product_name', 'order_items.quantity')
            ->get()
        ;

        $sqlDBRaw = DB::select('
            SELECT orders.id as order_id, orders.total_amount, products.id as product_id, products.name as product_name, order_items.quantity 
            FROM orders INNER JOIN order_items ON orders.id = order_items.order_id 
            INNER JOIN products ON order_items.product_id = products.id'
        );

        dd($eloquent, $eloquentORMRelationship, $queryBuilder, $sqlDBRaw);
    }

// Sub Query : 

    // -- Question 1: Find users who have made posts using subquery in WHERE
    public function sub_query_01() {
        $eloquent = User::whereIn('id', function ($query) {
                    $query->select('user_id')->from('posts')->distinct(); // sub_query
                })
                ->select('id','name')->get()
        ;

        $ormRelationship = User::has('posts')->select('id', 'name')->get();

        $queryBuilder = DB::table('users')
                        ->whereIn('id', DB::table('posts')->select('user_id')->get())
                        ->select('name', 'id')
                        ->get()
        ;

        $sqlDBRaw = DB::select('
                    select name 
                    from users
                    where id IN (
                        select distinct(user_id) 
                        from posts
                    )    
        ');

        dd($eloquent, $ormRelationship, $queryBuilder);
    }

    // Question 2: Find the post with the maximum number of comments using subquery in SELECT.
    public function sub_query_02() {
        
        // ->take(1) ?

        $eloquent = Post::select('id', 'title', DB::raw('select count(posts_id) from comments where posts.id = comments.posts_id as total_comments'))
                    ->orderBYDesc('total_comments')
                    ->take(1)
                    ->get()
        ;

        $eloquentORMRelationship = Post::withCount('comments')
                                    ->orderByDesc('comments_count')
                                    ->take(1)
                                    ->get()
        ;

        $queryBuilder = DB::table('posts')
                        ->select('id', 'name', DB::table('select count(post_id) from comments where posts.id = comments.post_id as total_count'))
                        ->orderByDesc('total_count')
                        ->take(1)
                        ->get()
        ;

        $sqlDBRaw = DB::raw('
            select id, name,  (select count(posts_id) from commnents where posts.id = comments.post_id) as total_commnets
            from posts
            order by total_count desc 
            limit 1
        '); 

        dd($eloquent, $eloquentORMRelationship, $queryBuilder, $sqlDBRaw);
    }

    // DB::raw() --> what it is , how it works, why use it, when use it, how to use it ???
    // DB::table() --> what it is , how it works, why use it, when use it, how to use it ???
    // When to write anomous functions, how to write ???
    // selectRaw() ???

    // Question 3: Find products with price above average price using subquery in WHERE.
    public function sub_query_03() {

        $eloquent = Product::where('price', '>', function ($query){
                $query->select(DB::raw('avg(price)'))->from('products');
            })
            ->select('id', 'name', 'price')
            ->get()    
        ;
        
        $queryBuilder = DB::table('products')
                        ->where('price', '>', DB::table('products')->selectRaw('avg(price)'))
                        ->select('id', 'name', 'price')
                        ->get()
        ;

        $rawDBSQL = DB::select(
                    'select id, name, price 
                    from products 
                    where price > 
                    (
                        select avg(price) from products
                    )'
            )
        ;

        dd($eloquent, $queryBuilder, $rawDBSQL);
    }

    // Question 4: Find users who have not placed any orders using subquery with NOT IN.
    public function sub_query_04(){
        $eloquent = User::whereNotIn('id', function ($query){
                $query->select('user_id')->from('orders')->distinct();
            })
            ->select('id', 'name')
            ->get()
        ;

        $eloquentORMRelationship = User::doesntHave('orders')->select('id', 'name')->get();

        $queryBuilder = DB::table('users')
                        ->whereNotIn('id', 
                                        DB::table('orders')
                                        ->select('user_id')
                                        ->distinct()
                                    )
                        ->select('id', 'name')
                        ->get()
        
        ;


        $rawDBSQL = DB::select('
                select id, name 
                from users
                where id not in (
                    select distinct(user_id)
                    from orders
                )
            ')
        ;

        dD($eloquent, $eloquentORMRelationship, $queryBuilder, $rawDBSQL);
    }

    // Question 5: Find the total likes per post using subquery in FROM.
    public function sub_query_05(){
       
    }
    

    // Question 6: Find orders where total_amount is greater than the average order amount using subquery.
    public function sub_query_06(){
        // with orders_avg_cte as (SELECT avg(total_amount) as avg_order_amount from orders) select user_id, total_amount from orders where total_amount > (SELECT avg(total_amount) as avg_order_amount from orders);
    }

    // // Question 7: Find orders where total_amount is greater than the average order amount using subquery.Find products that have been ordered using EXISTS subquery.
    public function  sub_query_07(){
        // SELECT p.id, p.name from products p where EXISTS ( select ot.product_id from order_items ot where ot.product_id = p.id );

    }

    // Question 1: Find the latest post for each user using correlated subquery.
    public function correlated_query_01() {
        // PHP is case-sensitive for method names. The query uses Post::From(...), but the correct Eloquent Query Builder method is from(...) (lowercase).
        // the third argument ('p1.user_id') is treated as a literal string value (not a column reference).
            // whereColumn or whereRaw for a column-to-column comparison
        $eloquent = Post::from('posts as p1')
                    ->where('p1.created_at', '=', function ($query) {
                        $query->select('p2.created_at')
                              ->from('posts as p2')
                              ->whereColumn('p2.user_id', '=', 'p1.user_id')
                              ->orderBy('p2.created_at', 'desc')
                              ->limit(1)
                            ;
                    })
                    ->select('p1.*')
                    ->get()
        
        ;
       
        // For Better performance use Max
        // $eloquent =  Post::from('posts as p1')
        //     ->whereRaw('p1.created_at = (SELECT MAX(p2.created_at) FROM posts as p2 WHERE p2.user_id = p1.user_id)')
        //     ->select('p1.*')
        //     ->get()
        // ;

        $eloquentORMRelationship = User::with(['posts' => function ($query) {
                $query->latest('created_at')->take(1);
            }])->get()->map(function ($user) {
                return $user->posts->first();
            })->filter()
        ;

        $queryBuilder = DB::table('posts as p1')
            ->whereRaw('p1.created_at = (SELECT MAX(p2.created_at) FROM posts as p2 WHERE p2.user_id = p1.user_id)')
            ->select('p1.*')
            ->get()
        ;

        $rawDBSQL = DB::select('
            SELECT p1.* 
            FROM posts p1 
                WHERE p1.created_at = (
                    SELECT MAX(p2.created_at) 
                    FROM posts p2 
                    WHERE p2.user_id = p1.user_id
                )
            ')
        ;

        dd($eloquent, $eloquentORMRelationship, $queryBuilder, $rawDBSQL);
    }

    // Question 2: Find users who have liked more posts than the average using correlated subquery.

    // This is not about the total likes in the system divided by total users.
    //  Instead, it's about calculating how many unique posts each user has liked, 
    // then finding the average of those per-user counts, and 
    // finally identifying users whose personal count exceeds that average.
    public function correlated_query_02() {

        
        //         -- Question 2: Find users who have liked more posts than the average using correlated subquery.
        // -- correlated Query

        //     select DISTINCT(l1.user_id) 
        //         from likes l1
        //         where count(l1.user_id) > (
        //             select l2.avg(l2.user_id) as avg_users
        //             from likes l2
        //         )
        //     ;

        //     select user_id, avg(user_id) as avg_users
        //     from likes 
        //     GROUP by user_id;



    }

    public function correlated_query_03() {

        //    -- Question 3: Find users who have commented on their own posts using correlated subquery. -- posts table --> user_id = comments table user_id and posts table id == comments table post_id 
        // select p.user_id, p.title 
        // from posts p 
        // where exists 
            // ( select c.post_id 
            //  from comments c 
            //  where p.user_id = c.user_id 
            // and p.id = c.post_id 
            // );


        // select u.id 
        // from users u 
        // where EXISTS ( 
        // select p.user_id 
        // from posts p 
        // where p.user_id = u.id 
        // AND EXISTS ( select c.id 
        // from comments c 
        // where c.post_id = p.id and c.user_id = u.id ) );
    }

    //  Question 4: Find posts where the number of comments is greater than the average number of comments per post.
    public function correlated_query_04(){
        // -- Find posts where the number of comments is greater than the average number of comments per post.

        // -- the average number of comments per post
        // with comments_per_post_avg as (select avg(total_comments) as avg_comments
        // from (select post_id, count(*) as total_comments from comments GROUP by post_id) as sub
        // GROUP by post_id)

        // SELECT p.id, p.title, comments_per_post_avg.avg_comments
        // from posts p, comments_per_post_avg 
        // where (select count(*) from comments where comments.post_id = p.id) > comments_per_post_avg.avg_comments;
    }

    //  Question 5: Find posts where the number of comments is greater than the average number of comments per post.
    public function correlated_query_05() {
        // -- Find users whose first post was after the average user created_at.

        // --  the average user created_at
        // SELECT avg(created_at) from posts;

        // select u.id, u.name from users u where (select min(p.created_at) from posts p where p.user_id = u.id ) > (SELECT avg(created_at) from posts);
    }
    
    //  Question 6:  Find orders where the number of items is above the average per order.
    public function correlated_query_06() {

        // -- Find orders where the number of items is above the average per order. -- the average per order. WITH avg_order as ( select avg(order_count) as avg_per_order from (select count(quantity) as order_count from order_items GROUP by order_id ) as sub_order) select o.id, o.total_amount, o.user_id from orders o , avg_order where (select count(ot.quantity) from order_items ot where ot.order_id = o.id ) > avg_order.avg_per_order;
    }

// Aggregations Query : 

    public function aggregations_query_01(){
        // -- Question 36: Find users with more than 2 posts using GROUP BY and HAVING.
        // select u.id, u.name , count(p.user_id) as total_posts
        // from users u 
        // join posts p on u.id = p.user_id
        // group by u.id
        // having count(p.id) > 2;
    }

    public function aggregations_query_02(){
        // -- Find categories with average price > 200 using GROUP BY and HAVING. select category, avg(price) as avg_price from products group by category having avg_price > 200;

    }

    public function aggregations_query_03(){
        //    Find posts with more than 1 like using GROUP BY and HAVING.
        $eloquent =  Post::select('posts.id', 'posts.title', DB::raw('COUNT(likes.id) as like_count'))
                    ->join('likes', 'posts.id', '=', 'likes.post_id')
                    ->groupBy('posts.id', 'posts.title')
                    ->having('like_count', '>', 1)
                    ->get()
        ;

    }

    public function aggregations_query_04(){
        //   Find users with total order amount > 1000 using GROUP BY and HAVING.
        $eloquent = User::select('users.id', 'users.name', DB::raw('SUM(orders.total_amount) as total_spent'))
                    ->join('orders', 'users.id', '=', 'orders.user_id')
                    ->groupBy('users.id', 'users.name')
                    ->having('total_spent', '>', 1000)
                    ->get()
        ;

    }

     public function aggregations_query_05(){
        //   Find roles with more than 3 users using GROUP BY and HAVING.
        $eloquent = Role::select('roles.id', 'roles.role_name', DB::raw('COUNT(user_roles.user_id) as user_count'))
                    ->join('user_roles', 'roles.id', '=', 'user_roles.role_id')
                    ->groupBy('roles.id', 'roles.role_name')
                    ->having('user_count', '>', 3)
                    ->get()
        ;

    }
}
