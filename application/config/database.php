<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['dsn']      The full DSN string describe a connection to the database.
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database driver. e.g.: mysqli.
|			Currently supported:
|				 cubrid, ibase, mssql, mysql, mysqli, oci8,
|				 odbc, pdo, postgre, sqlite, sqlite3, sqlsrv
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Query Builder class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['encrypt']  Whether or not to use an encrypted connection.
|
|			'mysql' (deprecated), 'sqlsrv' and 'pdo/sqlsrv' drivers accept TRUE/FALSE
|			'mysqli' and 'pdo/mysql' drivers accept an array with the following options:
|
|				'ssl_key'    - Path to the private key file
|				'ssl_cert'   - Path to the public key certificate file
|				'ssl_ca'     - Path to the certificate authority file
|				'ssl_capath' - Path to a directory containing trusted CA certificates in PEM format
|				'ssl_cipher' - List of *allowed* ciphers to be used for the encryption, separated by colons (':')
|				'ssl_verify' - TRUE/FALSE; Whether verify the server certificate or not
|
|	['compress'] Whether or not to use client compression (MySQL only)
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|	['ssl_options']	Used to set various SSL options that can be used when making SSL connections.
|	['failover'] array - A array with 0 or more data for connections if the main should fail.
|	['save_queries'] TRUE/FALSE - Whether to "save" all executed queries.
| 				NOTE: Disabling this will also effectively disable both
| 				$this->db->last_query() and profiling of DB queries.
| 				When you run a query, with this setting set to TRUE (default),
| 				CodeIgniter will store the SQL statement for debugging purposes.
| 				However, this may cause high memory usage, especially if you run
| 				a lot of SQL queries ... disable this to avoid that problem.
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $query_builder variables lets you determine whether or not to load
| the query builder class.
*/
$active_group = 'default';
$query_builder = TRUE;

// $db['default'] = array(
// 	'dsn'	=> '',
// 	'hostname' => 'localhost',
// 	'username' => 'root',
// 	'password' => '',
// 	'database' => 'agc-pms-01-22-22',
// 	'dbdriver' => 'mysqli',
// 	'dbprefix' => '',
// 	'pconnect' => FALSE,
// 	'db_debug' => (ENVIRONMENT !== 'production'),
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );

// $active_group = 'default';
// $active_record = TRUE;

#LOCAL SERVER
// $db['default']['hostname'] = '172.16.161.37';
// $db['default']['password'] = 'itprog2013';
$db['default']['hostname'] = 'localhost';
$db['default']['port']     = '3306';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'agc-pms';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = FALSE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;
#CAS SERVER
// $db['cas']['hostname'] = '172.16.170.10';
// $db['cas']['username'] = 'leasing';
// $db['cas']['password'] = 'leasing2023';
$db['cas']['hostname'] = 'localhost';
$db['cas']['port']     = '3306';
$db['cas']['username'] = 'root';
$db['cas']['password'] = '';
$db['cas']['database'] = 'agc-pms-cas';
$db['cas']['dbdriver'] = 'mysqli';
$db['cas']['dbprefix'] = '';
$db['cas']['pconnect'] = TRUE;
$db['cas']['db_debug'] = FALSE;
$db['cas']['cache_on'] = FALSE;
$db['cas']['cachedir'] = '';
$db['cas']['char_set'] = 'utf8';
$db['cas']['dbcollat'] = 'utf8_general_ci';
$db['cas']['swap_pre'] = '';
$db['cas']['autoinit'] = TRUE;
$db['cas']['stricton'] = FALSE;
#HOSTGATOR
// $db['portal']['hostname'] = '50.116.94.177';
// $db['portal']['username'] = 'duxvwc44_agc-pms';
// $db['portal']['password'] = '+AgIKfdyaC0d';
$db['portal']['hostname'] = 'localhost';
$db['portal']['port']     = '3306';
$db['portal']['username'] = 'root';
$db['portal']['password'] = '';
$db['portal']['database'] = 'duxvwc44_agc-pms';
$db['portal']['dbdriver'] = 'mysqli';
$db['portal']['dbprefix'] = '';
$db['portal']['pconnect'] = TRUE;
$db['portal']['db_debug'] = FALSE;
$db['portal']['cache_on'] = FALSE;
$db['portal']['cachedir'] = '';
$db['portal']['char_set'] = 'utf8';
$db['portal']['dbcollat'] = 'utf8_general_ci';
$db['portal']['swap_pre'] = '';
$db['portal']['autoinit'] = TRUE;
$db['portal']['stricton'] = FALSE;