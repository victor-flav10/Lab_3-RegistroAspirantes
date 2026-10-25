# 🎓 Sistema de Admisión de Aspirantes — UTP

<p align="center">
  <b>Laboratorio #3: Desarrollo Web con HTML5, CSS3, Bootstrap y PHP</b><br>
  <i>Universidad Tecnológica de Panamá (UTP)</i>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-7.4%20%7C%208.x-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5">
  <img src="https://img.shields.io/badge/License-Academic-blue?style=for-the-badge" alt="License">
</p>

---

## 🚀 Descripción del Proyecto

Este proyecto consiste en un **Sistema Web de Gestión y Registro de Aspirantes** desarrollado como parte de las asignaciones académicas de la Universidad Tecnológica de Panamá (UTP). Permite recopilar información personal, validar la edad de los postulantes, procesar y almacenar de forma segura sus fotografías, y visualizar un historial completo de registros y una galería visual sin la necesidad de utilizar una base de datos relacional compleja.

---

## ✨ Características Principales

* 📝 **Formulario de Registro Dinámico:** Interfaz moderna maquetada con **Bootstrap 5.3**, campos obligatorios y validaciones en tiempo real.
* 🛡️ **Seguridad y Saneamiento en Backend:** Uso de funciones como `trim()`, `strip_tags()` y `htmlspecialchars()` para prevenir ataques XSS.
* 🔄 **Normalización de Textos:** Conversión automática de nombres y apellidos a formato tipo título (`Sofía Pérez`) y la identificación a mayúsculas cerradas.
* 📅 **Validación de Edad estricta:** Cálculo de edad utilizando la clase nativa `DateTime` de PHP, restringiendo el registro exclusivamente a personas entre **18 y 70 años**.
* 📂 **Gestión Segura de Archivos:** Subida de fotografías con nombres únicos generados mediante `uniqid()` para evitar sobrescrituras y protección de directorios con `.htaccess`.
* 📊 **Historial de Aspirantes (`registros.php`):** Almacenamiento en formato JSON y visualización en una tabla ordenada de todos los registros exitosos.
* 🖼️ **Galería de Fotografías (`galeria.php`):** Escaneo dinámico de la carpeta de imágenes para mostrarlas en formato de cuadrícula (*grid*).
* 🧩 **Modularización de Código:** Inclusión de elementos repetitivos (`header.php` y `footer.php`) mediante `include_once`.

---

## 📁 Estructura de Directorios

El proyecto está organizado de la siguiente manera dentro del servidor local (`XAMPP`, `WampServer` o similar):

```text
Taller-Aspirantes/
│
├── includes/
│   ├── header.php       # Cabecera modular, enlaces de Bootstrap y Navbar/Breadcrumb dinámico
│   └── footer.php       # Pie de página institucional con año dinámico y enlaces de soporte
│
├── uploaded_files/
│   └── .htaccess        # Archivo de seguridad para bloquear ejecución de scripts y listado
│
├── index.php            # Formulario visual de registro de aspirantes
├── procesar.php         # Script backend que valida, sanea, procesa la foto y guarda en JSON
├── registros.php        # Tabla interactiva con el historial de aspirantes registrados
├── galeria.php          # Galería visual de las fotografías subidas al servidor
├── soporte.php          # Centro de asistencia técnica y preguntas frecuentes
├── contacto.php         # Información de contacto institucional de la UTP
└── registros.json       # Base de datos ligera generada automáticamente con los registros