# PHP_Laravel12_Get_Current_Full_URL

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white">
</p>

##  Overview

This project provides a **complete, beginner-to-advanced documentation**
for getting the **Current URL, Full URL, Previous URL, and Route Name**
in **Laravel 12**.

It covers:
- Controller-based examples
- Request object usage
- URL Facade usage
- Blade template usage
- Passing URL data from Controller to Blade


---

---

## FEATURES

- Laravel 12 project setup
- Get current URL (without query string)
- Get full URL (with query string)
- Get previous URL
- Use Request object
- Use URL Facade
- Get current route name
- Display URLs in Blade
- Pass URL data from Controller to Blade
- 100% copy-paste ready examples

---

##  Folder Structure

```text
laravel-demo/
├── app/
│   └── Http/
│       └── Controllers/
│           └── UserController.php
│
├── resources/
│   └── views/
│       └── users.blade.php
│
├── routes/
│   └── web.php
│
├── public/
├── config/
├── database/
├── storage/
└── artisan
```

---

## STEP 1: CREATE LARAVEL PROJECT

```bash
composer create-project laravel/laravel laravel-demo
```
Run
```bash
php artisan serve
```

---

## STEP 2: Environment Setup

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

APP_URL=http://127.0.0.1:8000

```

Open browser:

```
http://127.0.0.1:8000
```

---

## STEP 3: CREATE CONTROLLER

```bash
php artisan make:controller UserController
```

---

## STEP 4: CREATE ROUTE

### routes/web.php

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');
```

---

## STEP 5: GET CURRENT URL (WITHOUT QUERY STRING)

### app/Http/Controllers/UserController.php

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $currentUrl = url()->current();
        dd($currentUrl);
    }
}
```

Output:

```
http://127.0.0.1:8000/users
```
<img width="531" height="106" alt="Screenshot 2026-01-01 113837" src="https://github.com/user-attachments/assets/046083e9-11d7-4a6c-bf85-f7fa07a3223a" />

---

## STEP 6: GET FULL URL (WITH QUERY STRING)

Open URL:

```
http://127.0.0.1:8000/users?page=2&status=active
```

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $fullUrl = url()->full();
        dd($fullUrl);
    }
}
```

Output:

```
http://127.0.0.1:8000/users?page=2&status=active
```
<img width="684" height="108" alt="Screenshot 2026-01-01 113924" src="https://github.com/user-attachments/assets/388c7f27-34fd-4d5a-81fa-9fe84125b94c" />

---

## STEP 7: GET URL USING REQUEST OBJECT

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        dd(
            $request->url(),
            $request->fullUrl()
        );
    }
}
```

---

## STEP 8: GET URL USING URL FACADE

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    public function index()
    {
        dd(
            URL::current(),
            URL::full()
        );
    }
}
```

---

## STEP 9: GET PREVIOUS URL

```php
<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index()
    {
        $previousUrl = url()->previous();
        dd($previousUrl);
    }
}
```

---

## STEP 10: GET CURRENT ROUTE NAME

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    public function index()
    {
        $routeName = Route::current()->getName();
        dd($routeName);
    }
}
```

Output:

```
users.index
```
<img width="506" height="98" alt="Screenshot 2026-01-01 114445" src="https://github.com/user-attachments/assets/d7abc465-008a-4e85-a7fb-fe45d787caba" />

---

## STEP 11: CREATE BLADE FILE

```bash
touch resources/views/users.blade.php
```

---

## STEP 12: SHOW URLS IN BLADE

### Controller

```php
<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index()
    {
        return view('users');
    }
}
```

### Blade: 

resources/views/users.blade.php
```blade
<p>Current URL: {{ url()->current() }}</p> 
<p>Full URL: {{ url()->full() }}</p> 
<p>Previous URL: {{ url()->previous() }}</p>

```
<img width="353" height="170" alt="Screenshot 2026-01-01 115352" src="https://github.com/user-attachments/assets/5875bdd7-8113-469b-b082-01190903d55e" />

---

## STEP 13: PASS DATA FROM CONTROLLER TO BLADE

### Controller

```php
<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index()
    {
        return view('users', [
            'current'  => url()->current(),
            'full'     => url()->full(),
            'previous' => url()->previous(),
        ]);
    }
}
```

### Blade

resources/views/users.blade.php
```blade
{{ $current }} 
{{ $full }} 
{{ $previous }} 

```
<img width="563" height="108" alt="Screenshot 2026-01-01 115507" src="https://github.com/user-attachments/assets/55a13aff-a2d0-490d-ac34-e34ea464c98e" />

---

## QUICK CHEAT SHEET

| Task | Code |
|----|----|
| Current URL | `url()->current()` |
| Full URL | `url()->full()` |
| Previous URL | `url()->previous()` |
| Request URL | `$request->url()` |
| Request Full URL | `$request->fullUrl()` |
| Route Name | `Route::current()->getName()` |

---
