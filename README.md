# Artisan Clean Architecture Boilerplate

A Composer package providing custom Laravel Artisan commands to streamline the creation of various clean architecture components in a Laravel application.

## Installation

To install the package, run the following command:

```bash
composer require wasi-co/artisan-clean-architecture-boilerplate
```

## Usage

This package provides several Artisan commands to help you generate clean architecture components. Below is a list of available commands:

- `php artisan make:boundary-input` - Generates a Boundary Input class.
- `php artisan make:boundary-output` - Generates a Boundary Output class.
- `php artisan make:data-input` - Generates a Data Input class.
- `php artisan make:data-output` - Generates a Data Output class.
- `php artisan make:entity` - Generates an Entity class.
- `php artisan make:mapper-eloquent` - Generates an Eloquent Mapper class.
- `php artisan make:mapper-moloquent` - Generates a Moloquent Mapper class.
- `php artisan make:mapper-query-builder` - Generates a Query Builder Mapper class.
- `php artisan make:presenter` - Generates a Presenter class.
- `php artisan make:repository-eloquent` - Generates an Eloquent Repository class.
- `php artisan make:repository` - Generates a Repository class.
- `php artisan make:repository-moloquent` - Generates a Moloquent Repository class.
- `php artisan make:repository-query-builder` - Generates a Query Builder Repository class.
- `php artisan make:phpunit` - Generates a Test class.
- `php artisan make:use-case` - Generates a Use Case class.

## Running Tests


To run the tests, use the following command:

```bash
composer test
```

To run the tests with coverage, use the following command:

```bash
composer test-coverage
```

## Releasing the package

Run the following command to create a release of the package:

```bash
composer run release
```

Do not forget to add the variable `$GITLAB_PERSONAL_ACCESS_TOKEN` to your terminal with your own personal GitLab access token.

## License
This package is licensed under a Private License.

## Authors
- Wasi - tech.wasi@lifullconnect.com
- Elkin Ossa - elkin.ossa@lifullconnect.com

## Homepage
For more information, visit the homepage. 