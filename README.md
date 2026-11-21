# Sistema de Gestión de Clubs Deportivos

Sistema en PHP y MySQL para gestionar clubes, miembros y sus inscripciones (CRUD de las 3 tablas).

## Cómo ejecutarlo
1. Copiar la carpeta `clubs_deportivos` dentro de `C:\xampp\htdocs`.
2. Importar `sql/clubs_deportivos.sql` en phpMyAdmin o MySQL Workbench.
3. Revisar usuario, clave y puerto en `config/conexion.php`.
4. Abrir `http://localhost/clubs_deportivos/`.

## Tablas
- `clubes`: club_id, nombre, deporte, ubicacion, fecha_fundacion
- `miembros`: miembro_id, nombre, apellido, email, telefono
- `inscripciones`: inscripcion_id, club_id, miembro_id, fecha_inscripcion (relación muchos a muchos)
