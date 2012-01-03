<?php
header('Content-Type: text/xml');
include '../xmlbuilder.php';

if(isset($_POST['DBHost']) && isset($_POST['DBName']) && isset($_POST['DBPw']) && isset($_POST['DBLogin'])){
	if(createConfigFile($_POST['DBHost'], $_POST['DBLogin'], $_POST['DBName'], $_POST['DBPw'])) {
		//build up good answer xml
		//start sql dump script
		
		$mysql_path = $_SERVER['MYSQL_HOME'];
		$db_script_path = getcwd() . "/cake.sql";
		$db_server = $_POST['DBHost'];
		$db_name = $_POST['DBName'];
		$db_pw = $_POST['DBPw'];
		$db_login = $_POST['DBLogin'];
		
		

		//replace folder separators
		$mysql_path = str_replace("\\","/",$mysql_path);
		$db_script_path = str_replace("\\","/",$db_script_path);
	
		//build up script line
		$mysqlDump = $mysql_path.'/mysql ';
    	$mysqlDump .= '--host="' . $db_server . '" ';
    	$mysqlDump .= '--user="' . $db_login . '" ';
   		$mysqlDump .= '--password="' .$db_pw . '" ';
   		$mysqlDump .= $db_name . ' < ' . $db_script_path;
   		

    	$returncodeexec = passthru($mysqlDump);


		//go on with controlling whether the tables were created 
		
    	//step 1: connect to db
		@$dbhost = mysql_connect($db_server, $db_login, $db_pw) OR die("Alex");
	
		@$db = mysql_select_db($db_name,$dbhost) OR die("Alex");
    	//step 2:build up query string
		$querystring = "SELECT COUNT(*)
						FROM information_schema.tables 
						WHERE table_schema = '".$db_name."' ;";
		
		$result = mysql_query($querystring);
		
		$row = mysql_fetch_row($result);
		//step3: get number of tables created
		$numberoftables = $row[0];
		//step4: build up answer
		if($numberoftables == 16){
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

	$file = "<?php class DATABASE_CONFIG { 
public \$default = array(
	'datasource' => 'Database/Mysql',
	'persistent' => false,
	'host' => '$dbhost',
	'port' => 3306,
	'login' => '$dblogin',
	'password' => '$dbpw',
	'database' => '$dbname',
);
} ?>";
	
	//set up file handle
	$filename = "../../app/Config/database.php";

	$dbfile = fopen($filename, "w+");

	//put data into file
	fputs($dbfile, $file);
	
	fclose($dbfile);
	
	return true;
}


?>