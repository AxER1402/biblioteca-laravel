# 📚 Sistema de Biblioteca Escolar (Laravel + PHP + MySQL)

Este es un sistema básico para gestionar **libros, préstamos, devoluciones, usuarios y multas** en una biblioteca escolar, desarrollado con **Laravel** y base de datos MySQL (gestionada en phpMyAdmin).

---

## 🚀 Requisitos previos

Antes de iniciar, asegúrate de tener instalado:

- [PHP 8.1+](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)
- [MySQL 5.7+ / MariaDB](https://dev.mysql.com/downloads/mysql/)
- [Laravel 10.x](https://laravel.com/)
- [Node.js y NPM](https://nodejs.org/) (para manejar assets si es necesario)
- Servidor local como [XAMPP](https://www.apachefriends.org/) o [Laragon](https://laragon.org/)

---

Instalar dependencias de PHP
composer install


Configurar archivo .env
cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biblioteca
DB_USERNAME=root
DB_PASSWORD=



Generar la clave de la aplicación

php artisan key:generate



Ingresa a phpMyAdmin o consola MySQL y crea la base:
CREATE DATABASE biblioteca;



Ejecutar migraciones
php artisan migrate


(Opcional) Poblar datos de prueba
php artisan db:seed


Ejecución del proyecto
Inicia el servidor de Laravel:
php artisan serve


Por defecto estará disponible en:
http://127.0.0.1:8000



Credenciales de acceso iniciales
Si no tienes usuarios registrados:

Accede a http://127.0.0.1:8000/register

Crea un usuario nuevo (Alumno o Profesor)


Funcionalidades principales
✅ Gestión de usuarios (alumnos y profesores)
✅ Registro y listado de libros
✅ Control de préstamos con fechas de vencimiento
✅ Registro de multas por retraso
✅ Login y logout con control de acceso
✅ Dashboard con resumen general


