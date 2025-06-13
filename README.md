## LatinAd Backend Challenge - API REST (Laravel + Docker)

Este proyecto implementa la API solicitada para la administración de pantallas publicitarias.  
Tecnologías utilizadas:

- Laravel 11
- PHP 8.3 (dockerizado)
- MySQL 8
- Docker y Docker Compose
- NGINX como proxy reverse
- phpMyAdmin (incluido para debugging de base de datos)
- JWT Authentication (paquete Tymon JWT)
- Pest (framework de testing oficial de Laravel 11)
- Tests Automatizados de Autenticación y CRUD de Displays
- Políticas de autorización (Laravel Policies)

---

### Requisitos Previos

- Docker
- Docker Compose
- Git

---

### Setup del entorno

### 1 - Clonar el repositorio

```
git clone https://github.com/leonmsaia/simpleapi
cd simpleapi
```

### 2 - Crear estructura de Docker
La estructura de carpetas ya viene preconfigurada:

```
simpleapi/
│
├── docker/
│ ├── php/ (Dockerfile de PHP 8.3)
│ └── nginx/ (Configuración de NGINX)
│
├── docker-compose.yml
├── .env
├── composer.json
└── Laravel Application (api, controllers, policies, models, tests, etc.)
```

### 3 - Configuración de entorno
Editar el archivo .env:

```
# Datos de Ejemplo.
# Aclaracion: No son datos reales de acceso a ninguna DB.

APP_NAME=LatinAdAPI
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=latinad
DB_USERNAME=latinad
DB_PASSWORD=latinad123

AUTH_GUARD=api
JWT_SECRET=

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

### 8 - Generar el JWT secret
```
docker-compose exec app php artisan jwt:secret
```

### 9 - Ejecutar migraciones iniciales
```
docker-compose exec app php artisan migrate
```

### 10 - Ejecutar seeders (precarga de usuarios y displays)
```
docker-compose exec app php artisan db:seed
```

### 11 - Limpieza de caché
```
docker-compose exec app php artisan optimize
```

### 12 - URL Generados
- Entorno Laravel
    - http://localhost:8080/
- Entorno phpMyAdmin
    - http://localhost:8081/
        - User: root
        - Password: root

---
### Autenticación de Usuarios
**Endpoint de Login:**
POST */api/login*
Body de ejemplo:
```
{
  "email": "demo@latinad.com",
  "password": "12345678"
}
```
La respuesta devolverá el token JWT.
Todos los demás endpoints requieren el Header:

```
Authorization: Bearer <token>
Content-Type: application/json
```

### Endpoints de API disponibles
- GET */api/displays* → listado con filtros (por name y type)
- GET */api/displays/{id}* → detalle
- POST */api/displays* → creación
- PUT */api/displays/{id}* → actualización
- DELETE */api/displays/{id}* → eliminación

Todos los endpoints están protegidos por políticas de ownership (cada usuario solo puede gestionar sus propias pantallas).

---

### Tests Automatizados (Pest)
Se implementaron tests funcionales completos con Pest.

Ejecutar los tests
- Antes de ejecutar los tests, es importante recordar:

**Los tests reinicializan la base de datos:**

Cada ejecución de Pest hace:
- *migrate:fresh*
- *db:seed*

Generación completa de datos de prueba mediante Factories.
Comando de ejecución:

```
docker-compose exec app php artisan test
```

Luego de ejecutar los test con Pest, se recomienda hacer un **migrate:fresh** y **db:seed** para dejar las tablas listas para su uso normal.

---

### Colección Postman
Se incluye una colección pre-armada para facilitar el testeo manual de la API:
```
/docs/postman/LatinAd Backend Challenge API.postman_collection.json
```
La colección incluye:
- *Login*
- *CRUD completo de Displays*
- *Variables predefinidas*
- *Autenticación con JWT mediante variables de entorno de Postman.*