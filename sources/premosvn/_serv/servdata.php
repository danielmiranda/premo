<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
//   $table = 'vpendingorders';

/*
if(strlen(trim($_GET['extra_search'])) <> 0){
  $_GET['search']['value'] = $_GET['extra_search'];
}
*/
// Table's primary key

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
//SELECT categid, categdescr, sctid, scdescr, opt FROM vcateg WHERE 1
if($_GET['vview'] == 'vcateg'){
   $table = 'vcateg';
   $primaryKey = 'categid';
   $columns = array(
	array( 'db' => 'categdescr',     'dt' => 0 ),
	array( 'db' => 'scdescr',     'dt' => 1 ),
	array( 'db' => 'opt',         'dt' => 2 )
   );
}

if($_GET['vview'] == 'vciva'){
   $table = 'vciva';
   $primaryKey = 'condiva';
   $columns = array(
	array( 'db' => 'desccond',     'dt' => 0 ),
	array( 'db' => 'opt',         'dt' => 1 )
   );
}

if($_GET['vview'] == 'vartic'){
   $table = 'vartic';
   $primaryKey = 'codartid';
   $columns = array(
	array( 'db' => 'codartid',    'dt' => 0 ),
	array( 'db' => 'descrartic',  'dt' => 1 ),
	array( 'db' => 'categdescr',  'dt' => 2 ),
	array( 'db' => 'scdescr',     'dt' => 3 ),
	array( 'db' => 'stockart',    'dt' => 4 ),
	array( 'db' => 'stockmin',    'dt' => 5 ),
	array( 'db' => 'um_stock',    'dt' => 6 ),
	array( 'db' => 'precart',     'dt' => 7 ),
	array( 'db' => 'opt',         'dt' => 8 ),
	array( 'db' => 'categid',     'dt' => 9 ),
	array( 'db' => 'sctid',       'dt' => 10 )
   );
}

if($_GET['vview'] == 'vproveed'){
   $table = 'vproveed';
   $primaryKey = 'provid';
   $columns = array(
	array( 'db' => 'provid',    'dt' => 0 ),
	array( 'db' => 'provnom',  'dt' => 1 ),
	array( 'db' => 'cuitprov',  'dt' => 2 ),
	array( 'db' => 'desccond',     'dt' => 3 ),
	array( 'db' => 'opt',    'dt' => 4 )
   );
}
/*SELECT codartid, descrartic, precart, un_nom, stockart, invin, invout, art_ult_io, 
       cons_prom, cons_capt, Inv_Min, cicli_reemp, dias_inv, dias_inv_net, prox_cpra, categid, sctid 
       FROM vinvio WHERE 1*/
if($_GET['vview'] == 'vinvio'){
   $table = 'vinvio';
   $primaryKey = 'codartid';
   $columns = array(
	array( 'db' => 'codartid',    'dt' => 0 ),
	array( 'db' => 'descrartic',  'dt' => 1 ),
	array( 'db' => 'un_nom',      'dt' => 2 ),
	array( 'db' => 'stockart',    'dt' => 3 ),
	array( 'db' => 'invin',       'dt' => 4 ),
	array( 'db' => 'invout',      'dt' => 5 ),
	array( 'db' => 'art_ult_io',  'dt' => 6 ),
	array( 'db' => 'cons_prom',   'dt' => 7 ),
	array( 'db' => 'cons_capt',   'dt' => 8 ),
	array( 'db' => 'Inv_Min',     'dt' => 9 ),
	array( 'db' => 'cicli_reemp', 'dt' => 10 ),
	array( 'db' => 'dias_inv',    'dt' => 11 ),
	array( 'db' => 'dias_inv_net','dt' => 12 ),
	array( 'db' => 'prox_cpra',   'dt' => 13 ),
	array( 'db' => 'categid',     'dt' => 14 ),
	array( 'db' => 'sctid',       'dt' => 15 )
   );
}



// SQL server connection information
include('servconn.php');

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);


