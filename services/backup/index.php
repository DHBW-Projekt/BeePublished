<?php
//backup webservice
header('Content-Type: text/xml');
include '../xmlbuilder.php';

if(isset($_POST['DBPw']) && isset($_POST['DBLogin'])){
		//variables
		$db_server;
		$db_name;
		$homeurl;
		$db_pw = trim($_POST['DBPw']);
		$db_login = trim($_POST['DBLogin']);
		
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
				$db_server= trim($data['1']);
			}elseif ($data[0]  =="DBNAME"){
				$db_name= trim($data['1']);
			}elseif($data[0]  =="HOMEURL"){
				$homeurl = trim($data['1']);
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
		/*$mysqlDump = $mysql_path.'/mysqldump ';
    	$mysqlDump .= '--user="' . $db_login . '" ';
   		$mysqlDump .= '--password="' .$db_pw . '" ';
   		//$mysqlDump .= '--host="' . $db_server . '" ';
   		$mysqlDump .= $db_name . ' > ' .$db_script_path;
   		*/
   		//echo $mysqlDump."<br>";
		//execute script call
		$sqldump_url = date('ljSFYh-i-s')."backup.sql";
		backup_DB("localhost",$db_login,$db_pw,$db_name, $sqldump_url);
   		
   		$zip_url = $homeurl."/services/backup/archive.zip";
    	//passthru($mysqlDump);
		$sqldump_url = $homeurl."/services/backup/".$sqldump_url;
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

function backup_db($host,$user,$pass,$name,$path){
  	$tables = '*';
  	
  	$host = trim($host);
  	$name = trim ($name);
  	$pass = trim ($pass);
  	$user = trim($user);
  	$path = trim($path);


	$link = mysql_connect(mysql_real_escape_string($host),$user,$pass);
 	mysql_select_db($name,$link);
  
  //get all of the tables
  if($tables == '*')
  {
    $tables = array();
    $query = mysql_query('SHOW TABLES IN '.$name);
    while($row = mysql_fetch_row($query))
    {
      $tables[] = $row[0];
    }
  }
  else
  {
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }
  $return = "SET FOREIGN_KEY_CHECKS=0;";
  //cycle through
  foreach($tables as $table)
  {
  	//$bla = $table;

  	$sql = 'SELECT * FROM '.$table;
    $result= mysql_query($sql);
    $num_fields = mysql_num_fields($result);

    $return.= 'DROP TABLE IF EXISTS '.$table.' ;';
    $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
    $return.= "\n\n".$row2[1].";\n\n";

    for ($i = 0; $i < $num_fields; $i++) 
    {
      while($row = mysql_fetch_row($result))
      {
        $return.= 'INSERT INTO '.$table.' VALUES(';
        for($j=0; $j<$num_fields; $j++) 
        {
			if($row[$j] === NULL){
				$return.= 'NULL' ; 
			} else {
				$row[$j] = addslashes($row[$j]);
          		$row[$j] = str_replace("\n","\\n",$row[$j]);
		  		$return.= '"'.$row[$j].'"' ; 
			}
         
          
		  	
			
          if ($j<($num_fields-1)) { $return.= ','; }
        }
        $return.= ");\n";
      }
    }
    if($i != $num_fields-1){
    	  $return.="\n\n\n";
    }
  
  }
  
  //save file
  $handle = fopen($path,'w+');
  fwrite($handle,$return);
  fclose($handle);
}
?>