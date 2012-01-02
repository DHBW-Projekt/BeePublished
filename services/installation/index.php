<?php
header('Content-Type: text/xml');
include 'xmlbuilder.php';

if(isset($_POST['DBHost']) && isset($_POST['DBName']) && isset($_POST['DBPw']) && isset($_POST['DBLogin'])){
	if(createConfigFile($_POST['DBHost'], $_POST['DBLogin'], $_POST['DBName'], $_POST['DBPw'])) {
		//build up good answer xml
		
		//start sql script
		if($query = mysql_query( file_get_contents( "cake.sql" ) )){
			echo getRC0Xml();
		} else {
			echo getRC1Xml();
		}
		
	} else {
		echo getRC1Xml();
		//build up bad answer xml
	}
}else {
		echo getRC1Xml();
}

function createConfigFile($dbhost,$dblogin, $dbname, $dbpw){
	//buildup string for File

	$file = "class DATABASE_CONFIG { 
public \$default = array(
	'datasource' => 'Database/Mysql',
	'persistent' => false,
	'host' => '$dbhost',
	'port' => 3306,
	'login' => '$dblogin',
	'password' => '$dbpw',
	'database' => '$dbname',
	'prefix' => '',
);
}";
	
	//set up file handle
	$filename = "../../app/Config/Schema/database.php";
	$dbfile = fopen($filename, "w+");
	//put data into file
	fputs($dbfile, $file);

	
	fclose($dbfile);
	
	return true;
}


?>