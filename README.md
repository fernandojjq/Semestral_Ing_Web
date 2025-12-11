# Sistema Financiero Web con Pasarela de Pago

Proyecto Semestral desarrollado para la asignatura de **Ingeniería Web**.
Este sistema permite la gestión de asientos contables, control de usuarios, reportes financieros y cuenta con una simulación de pasarela de pagos que automatiza la contabilidad.

## 🎓 Información Académica

**Universidad Tecnológica de Panamá**
**Facultad de Ingeniería de Sistemas Computacionales**
**Asignatura:** Ingeniería Web (1SF131)
**Profesora:** Ing. Irina Fong
**Grupo:** 7

### 👥 Integrantes del Equipo
| Nombre | Cédula |
|--------|--------|
| **Fernando Jiménez** | 20-24-7669 |
| **Bryan Law** | 8-1011-2459 |
| **Evaristo Álvarez** | 8-1005-1928 |
| **Diego Gordón** | 8-1017-349 |

---

## 🚀 Características Principales

1.  **Gestión de Seguridad:** Login encriptado (Hash), manejo de sesiones y roles (Admin, Gerente, Contador).
2.  **Módulo Financiero:**
    *   Libro Diario con validación estricta de Partida Doble (Debe = Haber).
    *   Catálogo de Cuentas estandarizado.
3.  **Pasarela de Pagos:** Simulación de cobros con tarjeta/transferencia que genera asientos contables automáticos.
4.  **Auditoría de Fechas:** Separación de Fecha Contable (Manual/Histórica) vs Fecha Real de Registro (Timestamp inmutable de auditoría).
5.  **Auditoría y Cierre:** Funcionalidad de "Cierre de Mes" exclusiva para Gerencia con generación de Firma Digital (Hash SHA256).
6.  **Reportes en Tiempo Real:** Dashboard con Balance General y Estado de Resultados.

## 🛠️ Tecnologías

*   **Lenguaje:** PHP 8.x (Nativo, Orientado a Objetos).
*   **Base de Datos:** MySQL / MariaDB.
*   **Frontend:** HTML5, CSS3 (Diseño Fintech Custom), Bootstrap 5.
*   **Servidor:** WAMP / XAMPP.

---

## 💻 Instalación y Despliegue

1.  **Base de Datos:**
    *   Importar el archivo `database.sql` ubicado en la raíz del proyecto en phpMyAdmin.
    *   Base de datos: `sistema_financiero`.

2.  **Configuración:**
    *   El proyecto debe ubicarse en `C:/wamp64/www/Semestral Ing Web/` (o su equivalente).
    *   Verificar credenciales en `config/Conexion.php` (Por defecto: user `root`, pass vacía).

3.  **Acceso:**
    *   URL Pública: `http://localhost/Semestral Ing Web/public/index.php`
    *   URL Aplicación: `http://localhost/Semestral Ing Web/public/app.php`

### 🔑 Credenciales de Acceso (Data Seeding)

**Perfil Administrador (Gestión de Usuarios):**
*   **Usuario:** admin@sistema.com
*   **Contraseña:** Grupo7admin

**Perfil Gerente (Cierre de Mes):**
*   **Usuario:** gerente@sistema.com
*   **Contraseña:** Grupo7admin
