# Password History Checker

[![Latest Version](https://img.shields.io/github/v/release/L0MAX/laravel-password-history.svg?style=flat-square)](https://github.com/L0MAX/laravel-password-history-checker/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/L0MAX/laravel-password-history.svg?style=flat-square)](https://packagist.org/packages/L0MAX/laravel-password-history-checker)

A Laravel package that prevents users from resetting their password to one they have used before. This package ensures that password reuse is restricted by checking against a history of previously used passwords.

## Features
- Prevents users from reusing old passwords.
- Customizable password history depth (how many previous passwords to check).
- Simple integration with Laravel's built-in authentication system.

## Installation

To install the package, run the following command:

```bash
composer require l0max/laravel-password-history
```

## Configuration

After installation, you need to publish the configuration file to customize the package behavior:

```bash
php artisan vendor:publish --tag=password-history-checker-config
```

This will publish a configuration file named `password-history-checker.php` in your `config` directory. You can modify the number of passwords to keep in history and customize other settings.

The configuration file looks like this:

```php
return [
    'password_history_count' => 5, // The number of previous passwords to check
];
```

## Usage

### Middleware Setup
To prevent users from using previous passwords when resetting their passwords, add the middleware provided by this package to your password reset routes.

In your `routes/web.php` or `routes/api.php`:

```php
use L0MAX\PasswordHistoryChecker\Middleware\PreventPasswordReuse;

Route::post('/password/reset', 'Auth\ResetPasswordController@reset')
    ->middleware(PreventPasswordReuse::class);
```

This middleware will ensure that users cannot reuse any of the last `password_history_count` passwords they have used.

### How it Works
The package checks a user's password against their previous passwords before allowing them to reset it. You can configure how many previous passwords are stored in the history by modifying the `password_history_count` in the configuration file.

The system uses a `password_histories` table to store the history of passwords for each user.

## Running Migrations

The package includes a migration that adds a table to store the password history. Run the migrations after installing the package:

```bash
php artisan migrate
```

This will create a `password_histories` table to store user IDs and hashed passwords. This table is used to check previous passwords during the password reset process.

## Testing

To run the package's tests:

```bash
composer test
```

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).
```