# Pescavilla

Sistema de gestión acuícola desarrollado por Alexis y Diosvany

## Acerca del Proyecto

Este es un proyecto Laravel para la gestión de recursos pesqueros y acuícolas. El sistema permite administrar:

- UEBs (Unidades Empresariales de Base)
- Embalses (Presas y Micropresas)
- Especies cultivadas
- Sistemas de cultivo (Intensivo y Extensivo)

## Tecnologías Utilizadas

- Laravel Framework
- PHP
- SQLite
- JavaScript
- Vite

## Instalación

1. Clonar el repositorio
2. Instalar dependencias de PHP: `composer install`
3. Instalar dependencias de Node: `npm install`
4. Copiar `.env.example` a `.env`
5. Generar key de aplicación: `php artisan key:generate`
6. Ejecutar migraciones: `php artisan migrate`
7. Ejecutar seeders (opcional): `php artisan db:seed`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
