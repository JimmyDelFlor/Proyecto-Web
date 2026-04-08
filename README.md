# 🎬 UCVTube

Plataforma de videos web inspirada en YouTube, desarrollada como proyecto del curso de **Ingeniería Web**. Permite a los usuarios registrarse, subir videos, interactuar con contenido a través de likes, comentarios y suscripciones.

---

## 📋 Descripción

UCVTube es una aplicación web que replica las funcionalidades principales de YouTube. Fue construida usando PHP con arquitectura orientada a objetos, MySQL como base de datos y jQuery para las interacciones asíncronas (AJAX).

---

## ✨ Funcionalidades

- **Autenticación de usuarios** — Registro, inicio de sesión y cierre de sesión
- **Subida de videos** — Carga de archivos de video con conversión automática a MP4 usando FFmpeg
- **Reproductor de video** — Reproducción directa en el navegador
- **Sistema de likes y dislikes** — Para videos y comentarios
- **Comentarios y respuestas** — Comentarios anidados con sistema de réplicas
- **Suscripciones** — Seguir canales y ver su contenido en el feed
- **Perfiles de usuario** — Página de canal con videos subidos e información del usuario
- **Búsqueda** — Búsqueda de videos por título o nombre de usuario, con filtro por fecha o vistas
- **Tendencias** — Videos más vistos en los últimos 7 días
- **Miniaturas** — Generación automática de 3 miniaturas por video, seleccionables
- **Edición de video** — Editar título, descripción, privacidad, categoría y miniatura
- **Configuración de cuenta** — Actualizar datos personales y contraseña

---

## 🛠️ Tecnologías utilizadas

| Tecnología | Uso |
|---|---|
| PHP 8.2 | Backend y lógica del servidor |
| MySQL / MariaDB | Base de datos |
| PDO | Conexión y consultas a la base de datos |
| HTML / CSS | Interfaz de usuario |
| Bootstrap 4 | Estilos y componentes visuales |
| jQuery / AJAX | Interacciones sin recarga de página |
| FFmpeg | Conversión de video y generación de miniaturas |

---

## 📁 Estructura del proyecto

```
UCVTube/
├── ajax/                   # Endpoints AJAX (likes, comentarios, suscripciones, etc.)
├── assets/
│   ├── css/style.css       # Estilos globales
│   ├── js/                 # Scripts del cliente
│   └── img/                # Imágenes e iconos
├── Controlador/
│   ├── clases/             # Clases PHP (Account, Video, Usuario, etc.)
│   ├── config.php          # Configuración de base de datos y sesión
│   ├── header.php          # Cabecera reutilizable
│   └── footer.php          # Pie de página reutilizable
├── Videos/                 # Archivos de video y miniaturas subidos
├── index.php               # Página principal (feed)
├── IniciarSesion.php       # Login
├── Registrarse.php         # Registro
├── MostrarVideo.php        # Página de reproducción de video
├── Subir.php               # Página de subida
├── processing.php          # Procesamiento de subida
├── search.php              # Resultados de búsqueda
├── perfil.php              # Perfil de usuario / canal
├── settings.php            # Configuración de cuenta
├── editVideo.php           # Edición de video
├── trending.php            # Videos en tendencia
├── subscriptions.php       # Feed de suscripciones
├── likedVideos.php         # Videos con like
├── logout.php              # Cerrar sesión
└── ucvtube.sql             # Script SQL para crear la base de datos
```

---

## ⚙️ Instalación y configuración

### Requisitos previos

- XAMPP (o similar) con PHP 8.2+ y MariaDB 10.4+
- FFmpeg instalado en `ffmpeg/bin/` dentro del proyecto

### Pasos

1. **Clona o descarga el repositorio** en la carpeta `htdocs` de XAMPP:
   ```
   C:/xampp/htdocs/UCVTube/
   ```

2. **Importa la base de datos:**
   - Abre phpMyAdmin en `http://localhost/phpmyadmin`
   - Crea una base de datos llamada `ucvtube`
   - Importa el archivo `ucvtube.sql`

3. **Configura la conexión** en `Controlador/config.php`:
   ```php
   $con = new PDO('mysql:host=localhost:3307;dbname=ucvtube', 'root', '');
   ```
   Ajusta el host, puerto, usuario y contraseña según tu entorno.

4. **Coloca FFmpeg** en la ruta `ffmpeg/bin/ffmpeg.exe` y `ffmpeg/bin/ffprobe.exe`.

5. **Crea las carpetas** para almacenar archivos subidos:
   ```
   Videos/video/
   Videos/miniaturas/
   assets/img/profilePictures/
   ```

6. **Accede a la aplicación** desde `http://localhost/UCVTube/`

---

## 🗄️ Estructura de la base de datos

| Tabla | Descripción |
|---|---|
| `users` | Usuarios registrados |
| `videos` | Videos subidos |
| `comments` | Comentarios y respuestas |
| `likes` | Likes de videos y comentarios |
| `dislikes` | Dislikes de videos y comentarios |
| `subscribers` | Relaciones de suscripción |
| `thumbnails` | Miniaturas generadas por video |
| `categories` | Categorías de video |

---

## 👥 Autores

Proyecto desarrollado para el curso de **Ingeniería Web** — Universidad César Vallejo (UCV).

---

## 📄 Licencia

Este proyecto fue desarrollado con fines académicos.
