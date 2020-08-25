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

/*.ALTERAR VIEW ARTICULOS */
ALTER VIEW `vartic`
AS SELECT
   `a`.`codarticulo` AS `codartid`,
   `a`.`descrartic` AS `descrartic`,
   `c`.`categdescr` AS `categdescr`,
   `s`.`scdescr` AS `scdescr`,
   `a`.`stockart` AS `stockart`,case when coalesce(`a`.`art_cons_capt`,0) = 0 then (`a`.`art_dias_recup` + `a`.`art_recup_marg`) * `fgetinvavgdry`(`a`.`codartid`) else (`a`.`art_dias_recup` + `a`.`art_recup_marg`) * `a`.`art_cons_capt` end AS `stockmin`,
   `a`.`precart` AS `precart`,
   `a`.`categid` AS `categid`,
   `a`.`sctid` AS `sctid`,
   `u`.`un_nom` AS `un_med`,
   `a`.`art_equiv` AS `art_equiv`,
   `us`.`un_nom` AS `um_stock`,concat('<a href="javascript:void(0);" onclick="editart(',`a`.`codartid`,');" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:#0000FF"></i></a>') AS `opt`
FROM ((((`articulos` `a` left join `categorias` `c` on(`a`.`categid` = `c`.`categid`)) left join `subcateg` `s` on(`a`.`sctid` = `s`.`sctid` and `c`.`categid` = `s`.`categid`)) left join `unidades` `u` on(`a`.`art_unid` = `u`.`un_id`)) left join `unidades` `us` on(`a`.`stk_unid` = `us`.`un_id`));

/*. ALTER VIEW INVENTARIO*/
ALTER VIEW `vinvio`
AS SELECT
   `a`.`codarticulo` AS `codartid`,
   `a`.`descrartic` AS `descrartic`,
   `a`.`precart` AS `precart`,
   `u`.`un_nom` AS `un_nom`,concat('<div class="pull-right"><a href="javascript:void(0);" onclick="showinviolist(',`a`.`codartid`,')" style="text-decoration: underline;color: black;font-weight: bold;">',`a`.`stockart`,'</a></div>') AS `stockart`,concat('<div style="margin-left: auto;margin-right: auto;width: 70%;text-align: center;"><a href="javascript:void(0);" onclick="showinvin(',`a`.`codartid`,',0)" style="color:#0000FF;"><b><i class="fa fa-plus-square-o" aria-hidden="true" style="font-size:14px;color:#0000FF"></i></b></a></div>') AS `invin`,concat('<div style="margin-left: auto;margin-right: auto;width: 70%;text-align: center;"><a href="javascript:void(0);" onclick="showinvin(',`a`.`codartid`,',1)" style="color:#FF0000;"><b><i class="fa fa-minus-square-o" aria-hidden="true" style="font-size:14px;color:#FF0000"></i></b></a></div>') AS `invout`,date_format(`a`.`art_ult_io`,'%Y-%m-%d') AS `art_ult_io`,
   `fgetinvavgdry`(`a`.`codartid`) AS `cons_prom`,
   `a`.`art_cons_capt` AS `cons_capt`,case when coalesce(`a`.`art_cons_capt`,0) = 0 then (`a`.`art_dias_recup` + `a`.`art_recup_marg`) * `fgetinvavgdry`(`a`.`codartid`) else (`a`.`art_dias_recup` + `a`.`art_recup_marg`) * `a`.`art_cons_capt` end AS `Inv_Min`,
   `a`.`art_dias_recup` + `a`.`art_recup_marg` AS `cicli_reemp`,case when coalesce(`a`.`art_cons_capt`,0) > 0 then round(`a`.`stockart` / `a`.`art_cons_capt`,0) when `fgetinvavgdry`(`a`.`codartid`) > 0 then round(`a`.`stockart` / `fgetinvavgdry`(`a`.`codartid`),0) else 0 end AS `dias_inv`,case when coalesce(`a`.`art_cons_capt`,0) > 0 then round(`a`.`stockart` / `a`.`art_cons_capt`,0) - (`a`.`art_dias_recup` + `a`.`art_recup_marg`) when `fgetinvavgdry`(`a`.`codartid`) > 0 then round(`a`.`stockart` / `fgetinvavgdry`(`a`.`codartid`),0) - (`a`.`art_dias_recup` + `a`.`art_recup_marg`) else 0 end AS `dias_inv_net`,case when coalesce(`a`.`art_cons_capt`,0) > 0 then curdate() + interval (round(`a`.`stockart` / `a`.`art_cons_capt`,0) - (`a`.`art_dias_recup` + `a`.`art_recup_marg`)) day when `fgetinvavgdry`(`a`.`codartid`) > 0 then curdate() + interval (round(`a`.`stockart` / `fgetinvavgdry`(`a`.`codartid`),0) - (`a`.`art_dias_recup` + `a`.`art_recup_marg`)) day else curdate() end AS `prox_cpra`,
   `a`.`categid` AS `categid`,
   `a`.`sctid` AS `sctid`
FROM (`articulos` `a` join `unidades` `u` on(`a`.`stk_unid` = `u`.`un_id`));

/*
ALTER VIEW ARTICULO
*/
ALTER VIEW `vartic`
AS SELECT
   `a`.`codarticulo` AS `codartid`,
   `a`.`descrartic` AS `descrartic`,
   `c`.`categdescr` AS `categdescr`,
   `s`.`scdescr` AS `scdescr`,
   `a`.`stockart` AS `stockart`,case when coalesce(`a`.`art_cons_capt`,0) = 0 then (`a`.`art_dias_recup` + `a`.`art_recup_marg`) * `fgetinvavgdry`(`a`.`codartid`) else (`a`.`art_dias_recup` + `a`.`art_recup_marg`) * `a`.`art_cons_capt` end AS `stockmin`,
   `a`.`precart` AS `precart`,
   `a`.`categid` AS `categid`,
   `a`.`sctid` AS `sctid`,
   `u`.`un_nom` AS `un_med`,
   `a`.`art_equiv` AS `art_equiv`,
   `us`.`un_nom` AS `um_stock`,concat('<a href="javascript:void(0);" onclick="editart(',`a`.`codartid`,');" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:#0000FF"></i></a> - <a href="javascript:void(0);" onclick="deleart(',`a`.`codartid`,');" title="Delete"><i class="fa fa-window-close-o" aria-hidden="true" style="color:#FF0000"></i></a>') AS `opt`,
   `a`.`deleted` AS `deleted`
FROM ((((`articulos` `a` left join `categorias` `c` on(`a`.`categid` = `c`.`categid`)) left join `subcateg` `s` on(`a`.`sctid` = `s`.`sctid` and `c`.`categid` = `s`.`categid`)) left join `unidades` `u` on(`a`.`art_unid` = `u`.`un_id`)) left join `unidades` `us` on(`a`.`stk_unid` = `us`.`un_id`));

/* CREAMOS LA COLUMNA 'deleted' para borrado logico en articulo */
ALTER TABLE articulos ADD deleted bool

UPDATE articulos SET deleted = 1 WHERE codartid = 73044
UPDATE articulos SET deleted = 0

SELECT `codartid`, `descrartic`, `categdescr`, `scdescr`, `stockart`, `stockmin`, `um_stock`, `precart`, `opt`, `categid`, `sctid`, `deleted`
			 FROM `vartic`
			 WHERE `deleted` <> 1
			 ORDER BY `codartid` ASC
			 LIMIT 0, 10
			 
select * from articulos where deleted <> 1
			 
			 
ALTER TABLE articulos ADD deleted bool DEFAULT false;

ALTER TABLE articulos ADD deleted bool DEFAULT false;

ALTER VIEW `vartic`
AS SELECT
   `a`.`codarticulo` AS `codartid`,
   `a`.`descrartic` AS `descrartic`,
   `c`.`categdescr` AS `categdescr`,
   `s`.`scdescr` AS `scdescr`,
   `a`.`stockart` AS `stockart`,case when coalesce(`a`.`art_cons_capt`,0) = 0 then (`a`.`art_dias_recup` + `a`.`art_recup_marg`) * `fgetinvavgdry`(`a`.`codartid`) else (`a`.`art_dias_recup` + `a`.`art_recup_marg`) * `a`.`art_cons_capt` end AS `stockmin`,
   `a`.`precart` AS `precart`,
   `a`.`categid` AS `categid`,
   `a`.`sctid` AS `sctid`,
   `u`.`un_nom` AS `un_med`,
   `a`.`art_equiv` AS `art_equiv`,
   `us`.`un_nom` AS `um_stock`,concat('<a href="javascript:void(0);" onclick="editart(',`a`.`codartid`,');" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:#0000FF"></i></a> - <a href="javascript:void(0);" onclick="deleart(',`a`.`codartid`,');" title="Delete"><i class="fa fa-window-close-o" aria-hidden="true" style="color:#FF0000"></i></a>') AS `opt`,
   `a`.`deleted` AS `deleted`
FROM ((((`articulos` `a` left join `categorias` `c` on(`a`.`categid` = `c`.`categid`)) left join `subcateg` `s` on(`a`.`sctid` = `s`.`sctid` and `c`.`categid` = `s`.`categid`)) left join `unidades` `u` on(`a`.`art_unid` = `u`.`un_id`)) left join `unidades` `us` on(`a`.`stk_unid` = `us`.`un_id`));

ALTER VIEW `vinvio`
AS SELECT
   `a`.`codarticulo` AS `codartid`,
   `a`.`descrartic` AS `descrartic`,
   `a`.`precart` AS `precart`,
   `u`.`un_nom` AS `un_nom`,concat('<div class="pull-right"><a href="javascript:void(0);" onclick="showinviolist(',`a`.`codartid`,')" style="text-decoration: underline;color: black;font-weight: bold;">',`a`.`stockart`,'</a></div>') AS `stockart`,concat('<div style="margin-left: auto;margin-right: auto;width: 70%;text-align: center;"><a href="javascript:void(0);" onclick="showinvin(',`a`.`codartid`,',0)" style="color:#0000FF;"><b><i class="fa fa-plus-square-o" aria-hidden="true" style="font-size:14px;color:#0000FF"></i></b></a></div>') AS `invin`,concat('<div style="margin-left: auto;margin-right: auto;width: 70%;text-align: center;"><a href="javascript:void(0);" onclick="showinvin(',`a`.`codartid`,',1)" style="color:#FF0000;"><b><i class="fa fa-minus-square-o" aria-hidden="true" style="font-size:14px;color:#FF0000"></i></b></a></div>') AS `invout`,date_format(`a`.`art_ult_io`,'%Y-%m-%d') AS `art_ult_io`,
   `fgetinvavgdry`(`a`.`codartid`) AS `cons_prom`,
   `a`.`art_cons_capt` AS `cons_capt`,case when coalesce(`a`.`art_cons_capt`,0) = 0 then (`a`.`art_dias_recup` + `a`.`art_recup_marg`) * `fgetinvavgdry`(`a`.`codartid`) else (`a`.`art_dias_recup` + `a`.`art_recup_marg`) * `a`.`art_cons_capt` end AS `Inv_Min`,
   `a`.`art_dias_recup` + `a`.`art_recup_marg` AS `cicli_reemp`,case when coalesce(`a`.`art_cons_capt`,0) > 0 then round(`a`.`stockart` / `a`.`art_cons_capt`,0) when `fgetinvavgdry`(`a`.`codartid`) > 0 then round(`a`.`stockart` / `fgetinvavgdry`(`a`.`codartid`),0) else 0 end AS `dias_inv`,case when coalesce(`a`.`art_cons_capt`,0) > 0 then round(`a`.`stockart` / `a`.`art_cons_capt`,0) - (`a`.`art_dias_recup` + `a`.`art_recup_marg`) when `fgetinvavgdry`(`a`.`codartid`) > 0 then round(`a`.`stockart` / `fgetinvavgdry`(`a`.`codartid`),0) - (`a`.`art_dias_recup` + `a`.`art_recup_marg`) else 0 end AS `dias_inv_net`,case when coalesce(`a`.`art_cons_capt`,0) > 0 then curdate() + interval (round(`a`.`stockart` / `a`.`art_cons_capt`,0) - (`a`.`art_dias_recup` + `a`.`art_recup_marg`)) day when `fgetinvavgdry`(`a`.`codartid`) > 0 then curdate() + interval (round(`a`.`stockart` / `fgetinvavgdry`(`a`.`codartid`),0) - (`a`.`art_dias_recup` + `a`.`art_recup_marg`)) day else curdate() end AS `prox_cpra`,
   `a`.`categid` AS `categid`,
   `a`.`sctid` AS `sctid`
FROM (`articulos` `a` join `unidades` `u` on(`a`.`stk_unid` = `u`.`un_id`));


