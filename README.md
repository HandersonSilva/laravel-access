<p align="center"><img src="https://github.com/user-attachments/assets/64455349-d3ed-405b-b868-b8a0059f8efb" width="200"></p>  
<p align="center"><img src="https://github.com/user-attachments/assets/a32c9b19-9d93-4842-a33b-47757b751d97" width="900"></p>  

<p align="center">
<a href="https://packagist.org/packages/HandersonSilva/laravel-access"><img src="https://img.shields.io/packagist/dt/HandersonSilva/laravel-access" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/HandersonSilva/laravel-access"><img src="https://img.shields.io/packagist/v/HandersonSilva/laravel-access" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/HandersonSilva/laravel-access"><img src="https://img.shields.io/packagist/l/HandersonSilva/laravel-access" alt="License"></a>
</p>

## About Laravel Access

Laravel Access is a package that provides a simple way to manage access control per environments in Laravel applications.

## Requirements
- PHP >= 8.3
- Laravel >= 10.0

#### Services required
- Email Server (any driver)
- Cache (any driver)

## Installation
### Add the package to your project
```shell
composer require handersonsilva/laravel-access
```

### Publish the package in your project
```shell
php artisan vendor:publish --provider="SecurityTools\LaravelAccess\Providers\AccessServiceProvider"
```

### Middleware
#### Add the following code to the app/Http/Kernel.php file on the global middleware
```php
protected $middleware = [
        \SecurityTools\LaravelAccess\Middleware\AccessMiddleware::class,
        ...
];
```

### Run the initial configuration
```shell
php artisan access:install
```

# Configuration

### Add environments in the .env file
```dotenv
# Access  
ACCESS_ENABLE=true # Enable access
ACCESS_SECRET=your_secret_key # Generate any secret key 
```

### Block access to the application per environment
#### Add the following code to the config/access.php file to block access to the application in the environments you want.
```php
'block_env' => ['local'], # Environments to block access to the application ex: ['local', 'staging', 'production']
```

### Block access to the application per route prefix
```php
'block_prefixes' => ['/admin'], # Prefixes to block access to the application ex: ['/admin', '/private']
```

### Define the default route to redirect the user after validation
```php
'redirect_prefix' => '/admin',# Default route to redirect the user after validation default: '/'
```
### See the complete configuration in the config/access.php file 


## Auto Login
### To enable auto login, add the following code to the .env file
```dotenv
# Access  
ACCESS_AUTO_LOGIN=true # Enable auto login
ACCESS_GUARD=web # Guard to be used for authentication
```
#### When auto login is enabled, the user will be automatically authenticated to the application without the need to enter the login and password.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel Access, please send an e-mail to Handerson Silva via [handersonsylva@gmail.com](mailto:handersonsylva@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel Access framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).