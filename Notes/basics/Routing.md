NOTEBOOKLM : Prepare me detailed notes  with  proper explanation and examples for everythings







**Laravel Project Structure**



&nbsp;	1. **Model Folder (M) :** The Model folder **manages all files related to databases**

&nbsp;		**app -> Models**



&nbsp;				This is where developers handle **database-related tasks, such as writing SQL queries**



&nbsp;	2. **Controller Folder (C) :** This folder houses files related to the **application's business logic and programming logics**

&nbsp;		**app -> HTTP -> Controllers**

&nbsp;					

&nbsp;					The Controller acts as an **intermediary**

&nbsp;						 ◦ It determines **what data needs to be fetched from the database and calls the Model**.

&nbsp;   						 ◦ It **calls the HTML file (View)** to display the output requested by the user



&nbsp;	3. **View Folder (V) :** The View folder **stores all the HTML files** that define the look and front-end interface of the website

&nbsp;		**resources -> views**



&nbsp;	4. **Routing Folder** : The **Routing** folder contains **files** defining the overall structure and flow of the application.

&nbsp;		**routes**

&nbsp;				   ◦ **web.php**: This is the **main routing file** used to **define the URLs for all pages** planned **within the website**. 

&nbsp;   				   ◦ **api.php**: This file is used specifically to **define routes when creating APIs within Laravel**



&nbsp;	5. **Public Folder (Assets)** : This folder **stores all related assets** necessary for the website **like Images, fonts, music files, video files, CSS files, and JavaScript files**

&nbsp;		**Public**

            **Key Files/Location:** The **index.php file**, which is the **very first file that runs when the Laravel project is executed**, is **located in the root of the** 								**Public folder**, along with files like robots.txt



&nbsp;			**Note on CSS/JS Placement:** While the **resources folder also contains folders for JavaScript and CSS**, those folders are typically used for **files that the user should 							not directly see (e.g., admin-related files)**. All **main, user-facing CSS and JavaScript files** are generally kept within the **Public 							folder**



&nbsp;	6. **Config (config) :** Contains **files used for the configuration** of the website

&nbsp;		**config**		

&nbsp;				**database.php** (for setting up the database connection), **caching.php** (for handling caching), and **auth.php** (for defining authentication settings)





**Laravel Routing :** Routing in Laravel provides significant advantages, particularly regarding **security and decoupling the URL from the server's file structure**.



&nbsp;			**Pure PHP Example (Disadvantages) :** 

&nbsp;		 					

&nbsp;							1) **URL Format** : localhost/about.php or **localhost/page/about.php**

&nbsp;							2) **Exposure of Technology** : URL exposes that the website is built in PHP **(file\_name.php)**

&nbsp;							3) **File Location** : **about.php** is in the root folder, or in the page folder

&nbsp;							4) **Security** : Provides limited security, as file structure is exposed



&nbsp;	1) The file running behind a route can be a View file (containing static data) or a Controller file (handling data potentially coming from the database)



&nbsp;	2) **Defining and Implementing Routes** : All **website routes are defined inside the web.php**

&nbsp;		

&nbsp;		1) with an **Anonymous Function**



&nbsp;		Route::get('/', **function ()** {

&nbsp;			

&nbsp;			return view('welcome'); // Calls welcome.blade.php

&nbsp;				

&nbsp;				or 

&nbsp;				

&nbsp;			return "<h1>hello</h1>"; // renders this HTML

&nbsp;		

&nbsp;		});



&nbsp;		2) **directly render view files**

&nbsp;		

&nbsp;		**Route::view('url\_path', 'file\_name\_with\_path');**





&nbsp;	3) **PHP Artisan Commands for Route Management** : Artisan provides commands **to manage and list defined routes**

&nbsp;		

&nbsp;		1) **List All Routes: php artisan route:list**

&nbsp;				This command displays every defined route, including those created automatically by installed packages (vendor routes)



&nbsp;		2) **List Developer-Created Routes Only:  php artisan route:list --except-vendor**

&nbsp;						This command hides the routes associated with installed packages (--except-vendor)

&nbsp;	

&nbsp;		3) **Filter Routes by Keyword: php artisan route:list \[keyword]**

&nbsp;					This allows developers to find specific routes based on a keyword



&nbsp;	4) Defining the **Parameter in the Route** :  route expects a **dynamic value**, the parameter name is **enclosed in curly braces {}** in the **web.php file** 

&nbsp;							There is **no strict limit on the number of parameters** you can define



&nbsp;							Route::get('/user/**{id?}**', function ( **dataType(optional) $id=null**){

&nbsp;									

&nbsp;								return "<h1>User ID: " . $id . "</h1>";

&nbsp;							});



&nbsp;	5)  **Route Constraints (Validation)** : Route constraints are used to \*\*validate\*\* the type of value a user sends for a specific parameter

&nbsp;						

&nbsp;						1. Built-in Constraint Methods

&nbsp;							1) **whereNumber()** --> Ensures the parameter value is **strictly numeric** **\[10, 18]**.

&nbsp;							2) **whereAlpha()** --> Ensures the parameter value is **strictly alphabetic (A-Z, a-z)**.

&nbsp;							3) **whereAlphaNumeric()** --> Allows **letters and numbers (A-Z, 0-9)**.

&nbsp;							4) **whereIn()** --> Restricts the parameter value to a **pre-defined list of acceptable values provided in an array**

                            **5) where('id', '\[@0-9]+')** --> **custom ragex**



&nbsp;							Route::get('/user/{id?}', function ( dataType(optional) $id=null){

&nbsp;									

&nbsp;								return "<h1>User ID: " . $id . "</h1>";

&nbsp;							})

&nbsp;								->whereNumber('id')

&nbsp;									**or**

&nbsp;								->**whereIn('id', \['movie', 'song', 'painting'])**

&nbsp;							;

&nbsp;	6) **Named Routes : Named routes assign a unique, permanent name to a URL route**. This solves the problem of broken anchor links (<a> tags) if the URL path of a page is changed in the 				future

&nbsp;			To prevent broken links, the route definition in **web.php** is given a static name using the **->name()** method

&nbsp;			In the Blade template files **(.blade.php)**, the route name is called using the inbuilt Laravel **route()** function within **double curly braces**

            **Laravel's Blade Templating Engine uses double curly braces ({{ }}) to embed PHP code directly into HTML without requiring the full PHP tags (<?php ... ?>)**

&nbsp;				**Example**: <a href="{{ route('about') }}">About Page</a>



&nbsp;	7)  **Route Redirects : Route redirects are used when a page's URL has changed permanently or temporarily**, but users might still try to access the old URL

&nbsp;				The **Route::redirect() method takes at least two parameters**: the **old URL** the user is attempting to access, and **the new URL** where they should be sent
                

&nbsp;				**Example**
                // If a user types '/about', they are redirected to '/test' \[10, 11].

&nbsp;				Route::redirect('/about', '/test'); 

&nbsp;				

&nbsp;				When defining a **redirect, an optional third parameter can be used to specify the HTTP status code**, which tells search engines and browsers how to handle the 				change	



&nbsp;				1. **Permanent Redirect (Default)**:

&nbsp;   					◦ Laravel defaults to using the status code **301 (Moved Permanently)**.

&nbsp;   					◦ This is appropriate when the change is permanent, and **search engines should update their directory to the new URL**.



&nbsp;				2. **Temporary Redirect:**

&nbsp;   					◦ The status code **302 (Found)** is used for temporary redirects.

&nbsp;   					◦ This tells **search engines** that the URL might return to its previous state, so **they should not change their directory**.

&nbsp;				 **Example**

&nbsp;				// Redirects /about to /test, but signals it's a temporary change (302) \[12].

&nbsp;				Route::redirect('/about', '/test', 302); 

    8) **Route Groups : Route Groups are used to group multiple related routes together and apply common attributes (like prefixes) to all of them**, reducing code repetition and improving 				organization

            Route::prefix('prefix\_name')->group(function () {



&nbsp;				// sub routes / inner routes

&nbsp;			});



&nbsp;	9) **Fallback Routes :** A **Fallback Route** defines what happens when a user attempts to **access a URL that does not exist** or has not been defined in the routing files (which normally 				results in a 404 Page Not Found error)

&nbsp;				The **Route::fallback()** method is used to catch all undefined requests.

&nbsp;				

&nbsp;				Example : 

&nbsp;				

&nbsp;					Route::fallback(function () {

&nbsp;  				

&nbsp;						 // This function runs if no other defined route matches the URL \[17].

&nbsp;   						 return "Page Not Found";

&nbsp;   

&nbsp;  						 // OR, you can call a custom view file (e.g., 'error-404.blade.php') \[18]:

&nbsp;   						// return view('error-404');

&nbsp;					});

