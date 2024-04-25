<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h4>Este proyecto ha sido desarrollado en PHP 8.1 utilizando Laravel 10</h4>

<p>Estos son los pasos para desplegar el proyecto en tu PC:</p>

<p>Descargar Laragon, puedes hacerlo desde esta dirección: <a href="https://laragon.org/download/">Descargar Laragon</a></p>
<p>Descargar o clonar el proyecto en la ruta: C:\laragon\www\</p>
<p>Una vez descargado el proyecto, accedemos al Cmder dentro de Laragon y ejecutamos los siguientes comandos:</p>

<ol>
    <li>cd barbershop-app</li>
    <li>composer install</li>
    <li>cp .env.example .env</li>
    <li>php artisan key:generate</li>
    <li>php artisan migrate</li>
    <li>php artisan migrate:fresh --seed</li>
    <li>npm run dev</li>
</ol>

<p>Una vez ejecutados estos comandos ya podemos acceder a la app desde nuestro navegador mediante el siguiente enlace: <a href="http://barbershop-app.test/">Barber Shop</a></p>

<h4>Datos de inicio de sesión</h4>
<p>Usuario: admin@admin.com</p>
<p>Contraseña: admin</p>
