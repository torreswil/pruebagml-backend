#API USUARIOS PRUEBA TÉCNICA GML SOFTWARE
## Instrucciones
1. Instalar los paquetes composer
```bash
composer install
```

2. Copiar carpeta .env.example
```bash
cp .env.example .env
```
3. Crear la BD y agregar los datos para la conexión en .env
4. Correr migraciones y seeder
```
php artisan migrate --seed
```
5. Opcionalmente se puede ejecutar el seeder de usuarios para crear datos de prueba

```
php artisan db:seed --class=UserSeeder
```
6. Ejecutar tests (Se ejecutan sobre base de datos sqlite, es necesario habilitar al extensión en php.ini)
```
php artisan test
```
