# Lab_3-RegistroAspirantes
Lab #3: Formulario de Registro de Aspirantes
# 🎓 Sistema de Admisión de Aspirantes — UTP

> **Laboratorio #3: Desarrollo Web con HTML5, CSS3, Bootstrap y PHP**  
> *Universidad Tecnológica de Panamá (UTP) — Facultad de Ingeniería de Sistemas Computacionales*

---

## 🚀 Descripción General del Proyecto

Este proyecto implementa un **Sistema Web de Gestión y Registro de Aspirantes**, diseñado para cumplir con rigurosos estándares académicos de arquitectura web modular, validaciones estrictas en el backend, control de seguridad de archivos y persistencia de datos ligera sin necesidad de un motor de bases de datos relacionales complejo (como MySQL). Combina un diseño limpio y responsivo con buenas prácticas de programación en PHP y maquetación semántica.

---

## 💻 Tecnologías Puestas en Práctica

* **PHP (7.4 / 8.x):** Lenguaje de scripting del lado del servidor utilizado para procesar formularios, aplicar lógica de negocio, calcular edades, realizar saneamientos, modularizar componentes (`include_once`) y manipular archivos del sistema.
* **HTML5 Semántico:** Uso de etiquetas estructurales modernas (`<header>`, `<main>`, `<section>`, `<footer>`) para optimizar la accesibilidad y la organización semántica del documento.
* **Bootstrap (v5.3.3):** Framework CSS modular que proporciona componentes responsivos (tarjetas, formularios, tablas, barras de navegación y sistemas de rejilla o *grid*).
* **Apache Server & .htaccess:** Configuración de directivas de seguridad a nivel de servidor para la protección estricta de directorios sensibles.
* **JSON (JavaScript Object Notation):** Estructura de datos ligera utilizada como base de datos en archivo plano para el almacenamiento persistente de los registros de aspirantes.

---

## 📂 Análisis Extendido: ¿Qué hace cada archivo?

### 1. `index.php` (La Interfaz del Formulario)
* **¿Qué hace?**
* Actúa como la vista principal de la aplicación web. Renderiza el formulario de registro donde el aspirante introduce sus datos personales (nombre, apellido, identificación, fecha de nacimiento, sexo) y adjunta su fotografía institucional.
* **Nivel técnico:** Utiliza componentes de Bootstrap para crear una tarjeta flotante centrada (`card`, `shadow-sm`). Implementa el atributo obligatorio `enctype="multipart/form-data"`, indispensable para que el protocolo HTTP permita el envío binario de archivos (fotografías) hacia el servidor.

### 2. `procesar.php` (El Cerebro del Backend)
* **¿Qué hace?**
* Es el script encargado de recibir mediante el método `POST` todos los datos enviados desde `index.php`. Realiza el saneamiento, valida las restricciones de edad, procesa y almacena la fotografía de forma segura en el servidor, registra los datos en formato JSON y renderiza una tarjeta de éxito o una lista de errores detallada.
* **Nivel técnico:** Controla el flujo de ejecución condicional (`if/else`), maneja arreglos de errores dinámicos e interactúa directamente con el sistema de archivos del servidor.

### 3. `includes/header.php` (Cabecera Modular)
* **¿Qué hace?**
* Centraliza el bloque superior común de todas las páginas del sitio. Contiene la estructura inicial de HTML (`<!DOCTYPE html>`, metaetiquetas SEO y de responsividad), los enlaces CDN de Bootstrap y una barra de navegación (`Navbar`) superior junto con un componente de **migas de pan (*breadcrumb*) dinámicas**.
* **Nivel técnico:** Implementa lógica PHP utilizando `basename($_SERVER['PHP_SELF'])` para detectar de forma automática el archivo en el que se encuentra el usuario, adaptando el texto y los hipervínculos del breadcrumb en tiempo real según la sección visitada.

### 4. `includes/footer.php` (Pie de Página Modular)
* **¿Qué hace?**
* Proporciona el cierre visual y semántico de la aplicación web. Contiene un eslogan institucional, enlaces rápidos hacia páginas de soporte, contacto e historial, y un aviso de derechos de autor con un año dinámico.
* **Nivel técnico:** Utiliza la función nativa de PHP `date('Y')` para inyectar el año en curso de forma automatizada, evitando actualizaciones manuales del código año tras año.

### 5. `registros.php` (Historial de Aspirantes)
* **¿Qué hace?**
* Lee la "base de datos" ligera en formato JSON y despliega una tabla interactiva, limpia y ordenada con todos los aspirantes que han completado exitosamente su registro, incluyendo una vista previa en miniatura de sus fotografías.
* **Nivel técnico:** Realiza lectura de archivos mediante `file_get_contents()`, deserializa cadenas JSON a arreglos asociativos de PHP usando `json_decode()`, y recorre la estructura mediante un bucle `foreach` combinando HTML y PHP de forma híbrida.

### 6. `galeria.php` (Galería Visual de Imágenes)
* **¿Qué hace?**
* Escanea de manera automática la carpeta de almacenamiento de fotos y genera una cuadrícula responsiva (*grid*) donde se muestran todas las imágenes subidas por los usuarios.
* **Nivel técnico:** Emplea la función avanzada de búsqueda de archivos `glob()` con el modificador `GLOB_BRACE` para filtrar múltiples extensiones de imágenes simultáneamente (`jpg`, `jpeg`, `png`, `gif`, `webp`), calculando dinámicamente el conteo total de elementos.

### 7. `soporte.php` y `contacto.php` (Páginas de Apoyo)
* **¿Qué hace?** Ofrecen información institucional complementaria, canales de asistencia técnica, preguntas frecuentes y datos de contacto de la Universidad Tecnológica de Panamá.
* **Nivel técnico:** Reutilizan los módulos de cabecera y pie de página para garantizar consistencia visual y de diseño en todo el sitio web.

### 8. `uploaded_files/.htaccess` (Seguridad del Servidor)
* **¿Qué hace?**
* Blinda la carpeta donde se almacenan las fotografías de los usuarios para evitar vulnerabilidades críticas de seguridad.
* **Nivel técnico:** Contiene directivas de Apache que deshabilitan el listado del directorio (`Options -Indexes`) para que los usuarios no puedan ver la lista de archivos mediante el navegador, y bloquea estrictamente la ejecución de scripts maliciosos (`.php`, `.exe`, etc.) dentro de esa ruta usando `<FilesMatch>`.

---

## 🧮 Funciones Lógicas, Matemáticas y de Seguridad Destacadas

### A. Cálculo Lógico de Edad y Validación de Rango (`DateTime`)
Para evitar discrepancias causadas por años bisiestos o cálculos manuales imperfectos, se utiliza la clase orientada a objetos `DateTime` de PHP:
<h4>$fechaNac = new DateTime($fecha_nacimiento);</h4>
---

### Estructura del Directorio

<br>Taller-Aspirantes/ </br>
│
<br>├──includes/
<br>│   ├── header.php       # Cabecera modular, enlaces de Bootstrap y Navbar/Breadcrumb dinámico
<br>│   └── footer.php       # Pie de página institucional con año dinámico y enlaces de soporte
<br>│ 
<br>├── uploaded_files/
<br>│   └── .htaccess        # Archivo de seguridad para bloquear ejecución de scripts y listado
<br>│ 
<br>├── index.php            # Formulario visual de registro de aspirantes
<br>├── procesar.php         # Script backend que valida, sanea, procesa la foto y guarda en JSON
<br>├── registros.php        # Tabla interactiva con el historial de aspirantes registrados
<br>├── galeria.php          # Galería visual de las fotografías subidas al servidor
<br>├── soporte.php          # Centro de asistencia técnica y preguntas frecuentes
<br>├── contacto.php         # Información de contacto institucional de la UTP
<br>└── registros.json       # Base de datos ligera generada automáticamente con los registros
