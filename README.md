# 🐾 PetPGSI - Sistema de Gestión de Servicios para Mascotas

**PetPGSI** es un sistema desarrollado en **Laravel** para la gestión integral de mascotas, servicios y citas veterinarias.  
Incluye autenticación JWT, control de usuarios, y módulos completamente funcionales para Mascotas, Servicios y Agenda de Citas.

---

## 🚀 Tecnologías utilizadas

- **Laravel 10**
- **PHP 8.2+**
- **MySQL / MariaDB**
- **JWT (JSON Web Token) para autenticación**
- **Composer**
- **Artisan CLI**

---

## ⚙️ Requisitos previos

Asegúrate de tener instaladas las siguientes herramientas antes de comenzar:

| Herramienta | Versión mínima | Comando de verificación |
|--------------|----------------|--------------------------|
| PHP | 8.2 | `php -v` |
| Composer | 2.x | `composer -V` |
| MySQL o MariaDB | 5.7 / 10.x | `mysql --version` |
| Git | Cualquiera | `git --version` |

---

## 📦 Instalación paso a paso

### 1️⃣ Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/petpgsi.git
cd petpgsi
```

---

### 2️⃣ Instalar dependencias

```bash
composer install
```

---

### 3️⃣ Configurar el entorno

Copia el archivo de entorno base:

```bash
cp .env.example .env
```

Luego abre el archivo `.env` y ajusta las variables según tu entorno local:

```env
APP_NAME=PetPGSI
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=petpgsi
DB_USERNAME=root
DB_PASSWORD=

JWT_SECRET=
```

---

### 4️⃣ Generar la clave de aplicación

```bash
php artisan key:generate
```

---

### 5️⃣ Generar la clave JWT

```bash
php artisan jwt:secret
```

Esto creará la clave única `JWT_SECRET` en tu archivo `.env`.

---

### 6️⃣ Ejecutar las migraciones

```bash
php artisan migrate
```

---

### 7️⃣ Levantar el servidor local

```bash
php artisan serve
```

Tu aplicación estará disponible en:

👉 **http://127.0.0.1:8000**

---

## 🧠 Endpoints principales

### 🔐 Autenticación

| Método | Ruta | Descripción |
|---------|------|-------------|
| `POST` | `/api/auth/register` | Crear usuario |
| `POST` | `/api/auth/login` | Iniciar sesión y obtener token JWT |
| `GET`  | `/api/auth/me` | Obtener información del usuario actual |
| `POST` | `/api/auth/logout` | Cerrar sesión (invalidar token) |

---

### 🐶 Módulo Mascotas

| Método | Ruta | Descripción |
|---------|------|-------------|
| `GET` | `/api/mascotas` | Listar todas las mascotas del usuario |
| `GET` | `/api/mascotas/{id}` | Ver una mascota específica |
| `POST` | `/api/mascotas` | Crear una nueva mascota |
| `PUT` | `/api/mascotas/{id}` | Actualizar una mascota |
| `DELETE` | `/api/mascotas/{id}` | Eliminar una mascota |

---

### 🛠️ Módulo Servicios

| Método | Ruta | Descripción |
|---------|------|-------------|
| `GET` | `/api/servicios` | Listar servicios disponibles |
| `GET` | `/api/servicios/{id}` | Ver detalles de un servicio |
| `POST` | `/api/servicios` | Crear un nuevo servicio (solo admin) |
| `PUT` | `/api/servicios/{id}` | Editar un servicio |
| `DELETE` | `/api/servicios/{id}` | Eliminar un servicio |

---

### 📅 Módulo Citas

| Método | Ruta | Descripción |
|---------|------|-------------|
| `GET` | `/api/citas` | Listar citas del usuario |
| `POST` | `/api/citas` | Crear una nueva cita |
| `PUT` | `/api/citas/{id}` | Modificar una cita |
| `DELETE` | `/api/citas/{id}` | Cancelar una cita |

---

## 🧪 Ejemplo de uso con `curl`

### 🔑 Login

```bash
curl -X POST http://127.0.0.1:8000/api/auth/login -H "Content-Type: application/json" -d '{"email": "usuario@correo.com", "password": "123456"}'
```

---

### 🐾 Crear una mascota

```bash
curl -X POST http://127.0.0.1:8000/api/mascotas -H "Authorization: Bearer <TOKEN>" -H "Content-Type: application/json" -d '{
  "nombre": "Rocky",
  "especie": "Perro",
  "raza": "Labrador",
  "fecha_nacimiento": "2021-05-10"
}'
```

---

## 💾 Estructura del proyecto

```plaintext
petpgsi/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── MascotaController.php
│   │   │   ├── ServicioController.php
│   │   │   └── AgendaFacadeController.php
│   ├── Models/
│   │   ├── User.php
│   │   └── Mascota.php
├── database/
│   └── migrations/
├── routes/
│   └── api.php
├── .env.example
├── composer.json
└── README.md
```

---

## 👨‍💻 Desarrollador

**Autor:** Johan Alexander Farfán Sierra  
📧 johanfarfan.dev@gmail.com  
💻 Proyecto académico - Arquitectura de Software

---

## 📜 Licencia

Este proyecto está bajo la licencia **MIT**, lo que significa que puedes modificarlo y distribuirlo libremente siempre que mantengas la atribución al autor original.

---

✨ *“El mejor código es el que hace la vida más fácil a otros.”* 💡
