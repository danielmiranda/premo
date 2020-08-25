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
   `us`.`un_nom` AS `um_stock`,concat('<a href="javascript:void(0);" onclick="editart(',`a`.`codartid`,');" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:#0000FF"></i></a> - <a href="javascript:void(0);" onclick="deleart(',`a`.`codartid`,');" title="Delete"><i class="fa fa-window-close-o" aria-hidden="true" style="color:#FF0000"></i></a>') AS `opt`,
   `a`.`deleted` AS `deleted`
FROM ((((`articulos` `a` left join `categorias` `c` on(`a`.`categid` = `c`.`categid`)) left join `subcateg` `s` on(`a`.`sctid` = `s`.`sctid` and `c`.`categid` = `s`.`categid`)) left join `unidades` `u` on(`a`.`art_unid` = `u`.`un_id`)) left join `unidades` `us` on(`a`.`stk_unid` = `us`.`un_id`));
