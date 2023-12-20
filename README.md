# Prueba técnica de blubear

1. Crear una vista de registro, pidiendo como datos el nombre, correo y contraseña. Validar
   el correo ingresado mediante un email de confirmación, no dejar iniciar sesión hasta
   validar el correo
2. Crear una vista de inicio de sesión
3. Luego de iniciar sesión, crear una vista de grilla que muestre todos los digimons obtenidos
   del API, de preferencia usar paginado. Esta pantalla solo puede ser accedida con una
   sesión válida. Se sugiere el siguiente wireframe de referencia:
   Prueba técnica
   Desarrollador Full Stack web
   Proyecto: Equipo interno élite Fecha de última
   modificación 16/06/2023
   API a utilizar: https://digi-api.com/api/v1/digimon?pageSize=20
4. Al darle click a un digimon de la grilla, mostrar otra pantalla (o pop up) con la
   información detallada del digimon. Se sugiere el siguiente wireframe de referencia:

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalados los siguientes requisitos:

-   PHP 8
-   Composer
-   Node.js y npm (para manejar assets y dependencias front-end)

## Configuración del Entorno

1. **Clona el Repositorio:**

    ```bash
    git clone https://github.com/pintoderian/blubear-app.git
    cd blubear-app
    ```

2. **Instala las Dependencias de PHP:**

    ```bash
    composer install
    ```

3. **Configura el Archivo de Entorno:**

    - Copia el archivo `.env.example` a `.env`:
        ```bash
        cp .env.example .env
        ```
    - Abre el archivo `.env` y configura los valores necesarios.

4. **Genera la Clave de la Aplicación:**

    ```bash
    php artisan key:generate
    ```

5. **Instala las Dependencias de Node.js:**

    ```bash
    npm install
    ```

6. **Compila Assets Front-end:**
    ```bash
    npm run dev
    ```

## Ejecución

8. **Inicia el Servidor Local:**

    ```bash
    php artisan serve
    ```

    La aplicación estará disponible en [http://localhost:8000](http://localhost:8000).

## Detener la Aplicación

Para detener el servidor de desarrollo, simplemente presiona `Ctrl+C` en la terminal donde se está ejecutando.
