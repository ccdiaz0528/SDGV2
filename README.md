# 🚗 Sistema de Gestión de Documentación Vehicular (SDGV)

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

Sistema para la gestión centralizada de documentación vehicular (seguros, revisiones técnico-mecánicas y licencias de conducción) con recordatorios de vencimientos.

La gestión eficaz de la documentación del vehículo, como el seguro obligatorio, la inspección técnico-mecánica y el permiso de conducir, es fundamental para garantizar la legalidad y seguridad de la conducción. Estos documentos tienen una fecha de caducidad específica y su renovación oportuna es fundamental para evitar sanciones y problemas legales. 

## 📋 Tabla de Contenidos
- [Características Principales](#-características-principales)
- [Prerrequisitos](#-prerrequisitos)
- [Instalación](#-instalación)
- [Configuración](#-configuración)
- [Uso del Sistema](#-uso-del-sistema)
- [Comandos Esenciales](#-comandos-esenciales)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Contribución](#-contribución)

## 🌟 Características Principales
- Registro centralizado de documentos vehiculares
- Gestión de usuarios y vehículos
- Interfaz intuitiva y responsive


## 🛠 Prerrequisitos
![XAMPP](https://img.shields.io/badge/XAMPP-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white)
![Git](https://img.shields.io/badge/GIT-E44C30?style=for-the-badge&logo=git&logoColor=white)

- [XAMPP](https://www.apachefriends.org/es/download.html)
- [Composer](https://getcomposer.org/download/)
- [Git](https://git-scm.com/downloads/win)
- [VS Code](https://code.visualstudio.com/)
- PHP 8.0+
- MySQL 5.7+

## 📥 Instalación

### 1. Configuración Inicial
```bash
# Clonar repositorio
git clone https://tu-repositorio/sdgv.git
cd sdgv

# Instalar dependencias
composer install

2. Configuración de Entorno
Ejecutar XAMPP (Apache y MySQL)

Crear base de datos en phpMyAdmin:
php artisan migrate


Ejecutar datos directamente a BD
php artisan db:seed


Ejecutar el proyecto
php artisan serve
