/* CREAMOS LA COLUMNA 'codarticulo' para cargar el codigo manual de cada articulo */
ALTER TABLE articulos ADD codarticulo int

/* Actualizamos los codigos de articulo con los ID existentes de cada articulo */
UPDATE articulos SET codarticulo = codartid

/* ELIMINAMOS EL TRIGGER si existentes */
DROP TRIGGER IF EXISTS InsertArticulosCodArticulo

/* CREAMOS UN TRIGGER QUE INSERTE EL ID DEL PRODUCTO SI NO SE CARGA UN CODIGO MANUAL */
DELIMITER $$

CREATE TRIGGER InsertArticulosCodArticulo
BEFORE INSERT 
ON articulos FOR EACH ROW 
BEGIN
    IF new.codarticulo IS NULL OR new.codarticulo = 0 OR new.codarticulo = ''
    	THEN
        SET @auto_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES
                         WHERE TABLE_NAME='articulos' AND TABLE_SCHEMA=DATABASE() ); 
        SET NEW.codarticulo = @auto_id;
    END IF;
END$$

DELIMITER ;
