<?php
//backup webservice
header('Content-Type: text/xml');
include '../xmlbuilder.php';

if(isset($_POST['DBPw']) && isset($_POST['DBLogin'])){
		//variables
		$db_server;
		$db_name;
		$homeurl;
		$db_pw = $_POST['DBPw'];
		$db_login = $_POST['DBLogin'];
		
		//get dbhost and dbname out of config file
		$c_filename = "../config.php";
		$c_file = fopen($c_filename, "r");
		rewind($c_file);
		
		
		$row= true;
		
		while($row){
			$row = fgets($c_file);
			// = split("#", $row);
			$data = explode("#", $row);
			if($data[0] == "DBHOST"){
				$db_server= $data['1'];
			}elseif ($data[0]  =="DBNAME"){
				$db_name= $data['1'];
			}elseif($data[0]  =="HOMEURL"){
				$homeurl = $data['1'];
			}
		}
		fclose($c_file);
		//build up good answer xml
		//start sql dump script
		
		$mysql_path = $_SERVER['MYSQL_HOME'];
		$db_script_path = getcwd() . "/test.sql";
	
		

		//replace folder separators
		$mysql_path = str_replace("\\","/",$mysql_path);
		$db_script_path = str_replace("\\","/",$db_script_path);
		//echo $db_server."<br>";
		
		//echo $db_name."<br>";
		
		//build up script line
		$mysqlDump = $mysql_path.'/mysqldump ';
    	$mysqlDump .= '--user="' . $db_login . '" ';
   		$mysqlDump .= '--password="' .$db_pw . '" ';
   		//$mysqlDump .= '--host="' . $db_server . '" ';
   		$mysqlDump .= $db_name . ' > ' .$db_script_path;
   		
   		//echo $mysqlDump."<br>";
		//execute script call
		
   		$sqldump_url = $homeurl."/services/backup/testdump.sql";
   		$zip_url = $homeurl."/services/backup/archive.zip";
    	//passthru($mysqlDump);
		
		echo getAnswer(getbackupServiceAnswer($sqldump_url, $zip_url).getRC0Xml());
		
 	
	} else {
		echo getAnswer(getRC1Xml());
		//build up bad answer xml
	}

function createConfigFile($dbhost,$dblogin, $dbname, $dbpw){
	//buildup string for cake File

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
	$to_write = "DBPW#".$dbpw;
	fwrite($c_file, $to_write);
	
	
	$c_configtbool = fclose($c_file);
	
	return ($cake_configtbool && $c_configtbool );
}
?>