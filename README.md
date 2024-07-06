# EVALUACIÓN 3. JUNIO 2024
DISEÑO Y PROGRAMACIÓN ORIENTADA A LA WEB
ALUMNO: Bruno Armando Gonzalez Henriquez
FECHA: 2024-07-01

## Requerimientos para la ejecución de la aplicación
Para la ejecución de la aplicación se requiere tener instalado en la máquina local los siguientes programas:

- PHP 8.3.8 | 8.0^
- Composer 2.4.1 | 2.x^
- Node.js 18.8.0 | 18.x^
- MySQL 8.0.3 | 8.x^
- Bootstrap 5.3.0 | 5.x^ (mirar package json)
- otras dependencias (mirar package json y composer.json)
    - Chilean bundle (Herramientas para rut y validadores)
    - laravel ui (para la autenticación)
    - laraveles/spanish (para la traducción)
    - otros (mirar composer.json)


## INSTRUCCIONES PARA LA EJECUCIÓN DE LA APLICACIÓN
Para ejecutar la aplicación, se debe seguir los siguientes pasos:

1. Clonar el repositorio en la máquina local.
```bash
git clone URL_REPO
```

2. Instalar las dependencias del proyecto.
```bash
npm install
```

3. Instalar dependencias de Composer
```bash
composer install
```

4. Crear un archivo `.env` en la raíz del proyecto con la siguiente información:
```env
APP_NAME=arriendovehiculos
APP_ENV=local
APP_KEY !!!GENERAR LLAVE!!!
APP_DEBUG=true
APP_TIMEZONE=America/Santiago
APP_URL=http://localhost

APP_LOCALE=es
APP_FALLBACK_LOCALE=es
APP_FAKER_LOCALE=es_CL

APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=arriendovehiculos
DB_USERNAME= !!!USUARIO!!!
DB_PASSWORD=
```

5. Generar la llave de la aplicación.
```bash
php artisan key:generate
```

6. Crear la base de datos en MySQL.
```sql
CREATE DATABASE arriendovehiculos;
```

7. Ejecutar las migraciones y seeders.
```bash
php artisan migrate --seed
```

8. Compilar javascript y css.
```bash
npm run build
```
9. Crear link simbolico
```bash
php artisan storage:link
```

10. Levantar el servidor de desarrollo.
```bash

php artisan serve
```

11. Acceder a la aplicación en el navegador.
```
http://localhost:8000
```


