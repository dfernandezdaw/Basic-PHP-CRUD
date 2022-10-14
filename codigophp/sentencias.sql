-- Consulta mascotas acogidas
SELECT m.nombre as mascota, u.nombre as 'acogido por' FROM mascotas as m INNER JOIN usuarios as u ON m.id_usuario = u.id;
-- Consulta mascotas sin acoger
SELECT * FROM `mascotas` WHERE id_usuario IS NULL;