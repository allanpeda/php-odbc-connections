<?php // -*- mode: web -*-
// override php.ini
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

try  {
    $dbname = 'budget';
    $dbuser = 'analyst';
    $dbpass = '***********';
    $conn = new PDO('odbc:'.$dbname, $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
    $dql = "select cast(current_user as nvarchar(20)) as [CURRENT_USER],
    	        cast(db_name() as nvarchar(30))       as [CURRENT_DB],
    	        lower(cast(serverproperty('ServerName') as nvarchar(20)))  as [SERVERNAME],
                lower(cast(@@SERVICENAME as nvarchar(20))) as [SERVICENAME]";
    foreach($conn->query($dql) as $r){
      print "Connection okay!\n";
      printf("User: %s, DB: %s, Server: %s, Current Instance: %s\n",
             $r['CURRENT_USER'],
             $r['CURRENT_DB'],
             $r['SERVERNAME'],
             $r['SERVICENAME']);
    }
} catch(Exception $e) {
    print $e->getMessage();
    throw new Exception($e->getMessage());
}
