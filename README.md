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
<strong>if you inject interface you must specify which implementation of that interface should bind in bootstarp.php!</strong>
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
    
    ...
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

### Sample:how to use Middlewares?

You can use middleware for all routes or specific Controller by register your middleware in ```$middlewares``` and for all routes ```$routeMiddlewares```
<br>
<i>you can register in bootstrap.php file</i>
```php
/**
 * Class bootstrap
 */
class bootstrap
{
    ...
    
    /**
     * apply this middlewares for all routes
     *
     * @var array
     */
    public static $routeMiddlewares = [
        'trim',
    ];

    /**
     * register middlewares
     *
     * @var array
     */
    public static $middlewares = [
        'trim' => \Core\Kernel\Middleware\Rules\Trim::class,
        'auth' => \Core\Kernel\Middleware\Rules\Auth::class,
    ];
}
```

Example:
```php
class PagesController extends BaseController
{
    //without params
    static $middleware = 'auth';

    //also you can send params to your middleware
    static $middleware = ['role' => 'admin'];

    ...
```

```php
class Middleware implements MiddlewareContract
{
    /**
     * you can handle validation by return boolean!
     * "true" for accept and "false" for failed
     *
     * @param array|null $params
     * @return bool
     */
    public static function handle(array $params = null): bool
    {
        ...
        
        return true;
    }

    /**
     * Error message if middleware validation failed
     *
     * @return string
     */
    public static function message(): string
    {
        return ...;
    }
}
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
