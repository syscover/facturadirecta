# Factura Directa to Laravel 5.3

[![Total Downloads](https://poser.pugx.org/syscover/factura-directa/downloads)](https://packagist.org/packages/syscover/factura-directa)

## Installation

**1 - After install Laravel framework, insert on file composer.json, inside require object this value**
```
"syscover/factura-directa": "~2.0"
```
and execute on console:
```
composer update
```

**2 - Register service provider, on file config/app.php add to providers array**
```
Syscover\FacturaDirecta\FacturaDirectaServiceProvider::class,
```

**3 - Execute publish command**
```
php artisan vendor:publish
```

##Configuration
Set config options on config\facturaDirecta.php
The best option is set options in environment file, with this example
```
FACTURADIRECTA_ACCOUNT_NAME=xxxxxx
FACTURADIRECTA_API_KEY=xxxxxxxxxxxxxxxxxxxx
```