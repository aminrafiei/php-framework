<h1 align="center">
PHP micro-framework
</h1>

---------------------

## Overview:

- #### This is a a lightweight PHP micro-framework that has syntax like <strong>Laravel framework</strong>
 
----------------------

## :bulb: Documentation & Sample Code:


### Sample:How to add a route?

You can add your route in routes folder in routes.php.
<br>
You can use GET, POST, DELETE methods for your routes.
```php
use Core\Router;

Router::METHOD({path}, {clouser} | {controller-name@method-name}) 
```
Sample route :
```php
use Core\Router;

Router::make()->get('hellowrold',function (){
    return "Hello World!";
});
Router::make()->post('home','PagesController@home');
```

### Sample:how to use Dependency Injection?

When you call Controller that has dependency, framework automatically inject a instance of that Class/Interface .
<br>
<strong>if you inject interface you must specify which implemention of that interface should bind in bootstarp.php!</strong>
```php
/**
 * Class bootstrap
 */
class bootstrap
{
    /**
     * @var array
     */
    public static $binds = [];

    /**
     * @var array
     */
    public static $registers = [
        SomeInterface::class => SomeService::class,
    ];
    
     /**
      * check this middlewares for all routes
      *
      * @var array
      */
     public static $middlewares = [
         'trim' => \Core\Kernel\Middleware\Trim::class,
     ];
}
```

Example:
```php
class AuthController extends BaseController
{
    protected $user;

    public function __construct(User $user, SomeInterface $someInterface)
    {
        $this->user = $user;
    }
    ...
```

---------------------

### Sample:how to use ORM?
The framework has simple orm that you can CRUD and use "Where" clause for add condition in your query.
```php
$this->user->where('name', 'Amin', 'LIKE')
           ->andWhere('age', 20, '=')
            >get();
```

---------------------

### Sample:how to use validation?
The framework has simple validation that you can validate "Email, Number, Required"
<br>
and it returns true/false
```php

$request = request()->get();

$validation = validation()->validate($request, [
            'name'     => ['required'],
            'username' => ['required', 'email'],
            'password' => ['required'],
        ]);
```
---------------------

### Sample:how to use cache?
The framework has cache that implement Redis as default
<br>
<i>you can change it in bootstrap.php file</i>

```php
  
  cache()->remember('someThing',function (){
              return $this->user->first();
  },999)
  
```
---------------------
