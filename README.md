## LatinAd Backend Challenge - API REST (Laravel + Docker)

Este proyecto implementa la API solicitada para la administración de pantallas publicitarias.  
Tecnologías utilizadas:

- Laravel 11
- PHP 8.3 (Dockerizado)
- MySQL 8
- JWT Authentication
- Docker Compose
- NGINX
- phpMyAdmin

---

### Requisitos Previos

- Docker
- Docker Compose
- Git

---

### Setup del entorno

### 1 - Clonar el repositorio

```
git clone <url-del-repo>
cd latinad-api
```

### 2 - Crear estructura de Docker
La estructura de carpetas ya viene preconfigurada:

```
latinad-api/
│
├── docker/
│   ├── php/
│   │   └── Dockerfile
│   └── nginx/
│       └── default.conf
│
├── docker-compose.yml
├── .env
├── composer.json
└── (Laravel App)
```
### 3 - Configuración de entorno
Editar el archivo .env:

```
# Datos de Ejemplo.
# Aclaracion: No son datos reales de acceso a ninguna DB.
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=latinad
DB_USERNAME=latinad
DB_PASSWORD=latinad123

# Nota: Ver datos de ejemplo en .env.example
```

---

### Levantar el entorno Docker
### 4 - Build inicial

```
docker-compose build
```

### 5 - Levantar los servicios

```
docker-compose up -d
```

---

### Inicialización de Laravel
### 6 - Instalacion de Dependencias dentro de Contenedor Laravel
```
docker-compose exec app composer install
```

### 7 - Generar key de aplicación
```
docker-compose exec app php artisan key:generate
```

### 8 - Ejecutar migraciones iniciales
```
docker-compose exec app php artisan migrate
```

### 9 - Ejecutar optimizacion, limpieza de cache, higienizacion, limpieza de rutas
```
docker-compose exec app php artisan optimize
```