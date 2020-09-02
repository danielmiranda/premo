/*.TRIGGER PARA EVITAR EL INSERT CON CODIGO DE ARTICULO DUPLICADO */

DELIMITER $$

CREATE TRIGGER InsertArticulosCheckDuplicateCode 
BEFORE INSERT ON articulos
FOR EACH ROW 
BEGIN

    IF (SELECT COUNT(*) FROM articulos aa 
        WHERE aa.codarticulo = new.codarticulo AND aa.deleted <> 1)
    THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: Codigo de articulo duplicado';
    END IF;

END$$

DELIMITER ;