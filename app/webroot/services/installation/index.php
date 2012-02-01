<?php
header('Content-Type: text/xml');
include '../xmlbuilder.php';

if(isset($_POST['HomeUrl']) &&isset($_POST['DBHost']) && isset($_POST['DBName']) && isset($_POST['DBPw']) && isset($_POST['DBLogin'])){
	if(createConfigFile($_POST['HomeUrl'],$_POST['DBHost'], $_POST['DBLogin'], $_POST['DBName'], $_POST['DBPw'])) {
		$db_script_path ="cake.sql";
		$db_server = trim($_POST['DBHost']);
		$db_name = trim($_POST['DBName']);
		$db_pw = trim($_POST['DBPw']);
		$db_login = trim($_POST['DBLogin']);

		$return_code = build_DB($db_server, $db_login, $db_pw, $db_name, $db_script_path);

		if ($return_code == 1065 || $return_code == 0) {
			echo getAnswer( getRC0Xml());
		} else {
			echo getAnswer( getRC1Xml());
		}
		
	} else {
		echo getAnswer( getRC1Xml());
	}
} else {
		echo getAnswer( getRC1Xml());
}

function createConfigFile($homeurl, $dbhost,$dblogin, $dbname, $dbpw){

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
	
	$cake_configtbool = fclose($dbfile);

	//start building up simple config file 	
	$c_filename = "../config.php";
	$c_file = fopen($c_filename, "w+");
	rewind($c_file);
	//write rootdir
	$to_write = "HOMEURL#".$homeurl."\n";
	fwrite($c_file, $to_write);
	//write dbhost
	$to_write = "DBHOST#".$dbhost."\n";
	fwrite($c_file, $to_write);
	//write dbname
	$to_write = "DBNAME#".$dbname."\n";
	fwrite($c_file, $to_write);
	//write dbuser
	$to_write = "DBLOGIN#".$dblogin."\n";
	fwrite($c_file, $to_write);
	//write dbpasswort
	$to_write = "DBPW#".$dbpw."";
	fwrite($c_file, $to_write);
	
	$c_configtbool = fclose($c_file);
	
	return ($cake_configtbool && $c_configtbool );
}
function build_DB($host,$user,$pass,$name,$path){
	$link = mysql_connect($host,$user,$pass);
 	 mysql_select_db($name,$link);
 	 $sqlErrorCode = 0;
     $f = fopen($path,"r+");
     $sqlFile = fread($f,filesize($path));
     $sqlArray = explode(';',$sqlFile); 
 	   foreach ($sqlArray as $stmt) {
       if (strlen($stmt)>3 && !empty($stmt) && $stmt != " "){
            $result = mysql_query($stmt);
              if (!$result){
                 $sqlErrorCode = mysql_errno();
                 $sqlErrorText = mysql_error();
                 $sqlStmt      = $stmt;
                 break;
              }
           }
      }  
      return  $sqlErrorCode;	
}
?>