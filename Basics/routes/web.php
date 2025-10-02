<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Basics Query Practice
use App\Http\Controllers\PracticeQueries\BasicsController;

// JOINS

    // Question 1: Find all users and their roles using an inner join.
    Route::get('basics/joins/01', [BasicsController::class, 'joins_01']);

    // Question 2: List all users, even if they have no roles, using a left join.
    Route::get('basics/joins/02', [BasicsController::class, 'joins_02']);

    // Question 3: List all roles, even if no users have them, using a right join.
    Route::get('basics/joins/03', [BasicsController::class, 'joins_03']);

    // Question 4: Find users who have the same role as another user using self-join.
    Route::get('basics/joins/04', [BasicsController::class, 'joins_04']);

    // Question 5: Generate a Cartesian product of users and products using cross join (limit to 10 rows).
    Route::get('basics/joins/05', [BasicsController::class, 'joins_05']);

    // Question 6: Find posts with their author's name using inner join.
    Route::get('basics/joins/06', [BasicsController::class, 'joins_06']);

    // Question 7: List products and their order quantities using left join on order_items.
    Route::get('basics/joins/07', [BasicsController::class, 'joins_07']);

    // Question 8: Find users who have placed orders and their total amount using inner join and group by.
    Route::get('basics/joins/08', [BasicsController::class, 'joins_08']);

    // Question 9: List posts with number of likes using left join.
    Route::get('basics/joins/09', [BasicsController::class, 'joins_09']);

    // Question 10: Find orders with product details using multiple joins (orders, order_items, products).
    Route::get('basics/joins/10', [BasicsController::class, 'joins_10']);

// Sub Query

    // -- Question 1: Find users who have made posts using subquery in WHERE
    Route::get('basics/sub_query/01', [BasicsController::class, 'sub_query_01']);

    // Question 2: Find the post with the maximum number of comments using subquery in SELECT.
    Route::get('basics/sub_query/02', [BasicsController::class, 'sub_query_02']);

    // Question 3: Find products with price above average price using subquery in WHERE.
    Route::get('basics/sub_query/03', [BasicsController::class, 'sub_query_03']);

    // Question 4: Find users who have not placed any orders using subquery with NOT IN.
    Route::get('basics/sub_query/04', [BasicsController::class, 'sub_query_04']);


// Correlated Query
    
    // Question 1: Find the latest post for each user using correlated subquery.
    Route::get('basics/correlated_query/01', [BasicsController::class, 'correlated_query_01']);