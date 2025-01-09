# Inertia Vue CRUD

![Inertia.js](https://img.shields.io/badge/Inertia.js-%234B5562?style=for-the-badge&logo=inertia&logoColor=white) ![Vue.js](https://img.shields.io/badge/Vue.js-%234FC08D?style=for-the-badge&logo=vue.js&logoColor=white) ![Laravel](https://img.shields.io/badge/Laravel-%23FF2D20?style=for-the-badge&logo=laravel&logoColor=white)

Este proyecto es un CRUD desarrollado con **Inertia.js**, **Vue.js** y **Laravel**. Permite gestionar tres tablas: **genres**, **books** e **images**, explorando conceptos avanzados como enrutamiento, relaciones, vistas dinámicas, validaciones y manejo eficiente de datos.

---

## Características principales

### **Genres**
- Cada género tiene su propia vista detallada.
- Relación uno a muchos con la tabla **books**.
- Paginación y carga eficiente de datos.

### **Books**
- Gestión mediante modales para crear, editar y eliminar libros.
- Relación con la tabla **genres**.
- Validaciones en el frontend y backend.

### **Images**
- Galería de imágenes con opción para subir hasta 10 imágenes simultáneamente.
- Vista principal (**index**) con una galería visual de las imágenes.
- Carga asincrónica y manejo de archivos con buen rendimiento.

### **Otras funcionalidades**
- **Paginación:** Implementada en todas las tablas para un rendimiento óptimo.
- **Relaciones:** Consultas optimizadas para cargar datos relacionados.
- **Cargas asincrónicas:** Mejora la experiencia de usuario al reducir tiempos de espera.

---

## Instalación

### **Requisitos previos**
- PHP 8.2 o superior.
- Composer.
- Node.js y npm.
- Base de datos MySQL o compatible.

### **Pasos**

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/StevenU21/vue-inertia-crud.git
   cd vue-inertia-crud
   ```

2. **Instalar dependencias PHP**
   ```bash
   composer install
   ```

3. **Instalar dependencias Node.js**
   ```bash
   npm install
   ```

4. **Configurar el archivo `.env`**
   - Copia el archivo de ejemplo:
     ```bash
     cp .env.example .env
     ```
   - Configura la conexión a la base de datos.

5. **Generar la clave de la aplicación**
   ```bash
   php artisan key:generate
   ```

6. **Migrar las tablas a la base de datos**
   ```bash
   php artisan migrate
   ```

7. **Compilar los assets**
   ```bash
   npm run dev
   ```

8. **Iniciar el servidor**
   ```bash
   php artisan serve
   ```

   Accede a la aplicación en `http://localhost:8000`.

---

## Estructura del proyecto

- **Genres:** Cada registro se visualiza en vistas individuales.
- **Books:** Modales para operaciones CRUD.
- **Images:** Galería con opción de carga múltiple.

---

## Contribuciones

¡Las contribuciones son bienvenidas! Si encuentras algún problema o tienes sugerencias, por favor abre un [issue](https://github.com/StevenU21/vue-inertia-crud/issues) o crea un pull request.

---

## Autor

Desarrollado por **Steven Ulloa**. Puedes encontrar más de mi trabajo en [mi perfil de GitHub](https://github.com/StevenU21).

---
