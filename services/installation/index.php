<?php
header('Content-Type: text/xml');
include '../xmlbuilder.php';

if(isset($_POST['HomeUrl']) &&isset($_POST['DBHost']) && isset($_POST['DBName']) && isset($_POST['DBPw']) && isset($_POST['DBLogin'])){
	if(createConfigFile($_POST['HomeUrl'],$_POST['DBHost'], $_POST['DBLogin'], $_POST['DBName'], $_POST['DBPw'])) {
		//build up good answer xml
		//start sql dump script
		
		//$mysql_path = $_SERVER['MYSQL_HOME'];
		
		$db_script_path ="cake.sql";
		$db_server = trim($_POST['DBHost']);
		$db_name = trim($_POST['DBName']);
		$db_pw = trim($_POST['DBPw']);
		$db_login = trim($_POST['DBLogin']);
		


		//replace folder separators
		//$mysql_path = str_replace("\\","/",$mysql_path);
		//$db_script_path = str_replace("\\","/",$db_script_path);	
		

		$return_code = build_DB($db_server, $db_login, $db_pw, $db_name, $db_script_path);
		
		//build up script line
		/*$mysqlDump = 'mysql ';
    	$mysqlDump .= '-h ' . $db_server . ' ';
    	$mysqlDump .= '-u ' . $db_login . ' ';
   		$mysqlDump .= '-p' .$db_pw . ' ';
   		$mysqlDump .= $db_name . ' < ' . 'cake.sql';
		
    	$returncodeexec = passthru($mysqlDump);

		//passthru("mysql -h mysql5.ms-mediagroup.de -u db115933_10 -pcms1 db115933_10 < "."cake.sql");

    	//step 1: connect to db

		@$dbhost = mysql_connect($db_server, $db_login, $db_pw) OR die("Alexblupp");
	
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
			echo getAnswer( getRC0Xml());
			
		} else {
			echo "test2";
			echo getAnswer( getRC1Xml());
		}
 		*/
		if ($return_code == 1065 || $return_code == 0) {
			echo getAnswer( getRC0Xml());
		} else {
			echo getAnswer( getRC1Xml());
		}
		
	} else {
		echo getAnswer( getRC1Xml());
		
		//build up bad answer xml
	}
}else {
		echo getAnswer( getRC1Xml());
	
}

function createConfigFile($homeurl, $dbhost,$dblogin, $dbname, $dbpw){
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
 	 //$query = file_get_contents();
 	 //echo $query;
 	 $sqlErrorCode = 0;
     $f = fopen($path,"r+");
     $sqlFile = fread($f,filesize($path));
     $sqlArray = explode(';',$sqlFile); 
 	   foreach ($sqlArray as $stmt) {
       if (strlen($stmt)>3 && !empty($stmt) && $stmt != " "){
       		//echo "commando: ".$stmt."<br>";
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