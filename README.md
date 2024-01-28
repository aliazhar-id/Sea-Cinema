<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sea-Cinema

Sea Cinema is an online cinema website that uses Laravel and API. This website provides complete information about the Sea Cinema cinema, starting from complete information about the film, title, synopsis, to trailers.

![Image](https://github.com/aliazhar-id/Sea-Cinema\public\assets)

## Description

This website was built using the Laravel framework, which is a popular PHP framework and has many features that support website development. Laravel also provides support for APIs, which allow these websites to access data from other sources.

### Build With

* [Laravel](https://laravel.com/)
* [TailwindCSS](https://tailwindcss.com/)
* [Font Awesome](https://fontawesome.com/)
* [TMDB API](https://www.themoviedb.org/)

## Getting Started

## Installation

1. Clone this project
2. Install Composer dependencies `composer install`
3. Install npm dependencies `npm install`
4. Create a copy of your .env file `cp .env.example .env`
5. Once you have the API key, you can add it to your Laravel application's .env file. Open the .env file and find the following line: `MOVIE_DB_API_KEY=`
6. Replace the empty value with your API key. For example, if your API key is `1234567890abcdef`, you would change the line to: `MOVIE_DB_API_KEY=1234567890abcdef`
7. Generate an app encryption key `php artisan key:generate`

## Executing program

1. Run Laravel server `php artisan serve`
2. Run Tailwind CSS `npm run dev`

## About Laravel

1. Laravel Framework Version 10.41.0
2. PHP Version 8.2.12
3. Tailwind CSS Version 3.4.1

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
