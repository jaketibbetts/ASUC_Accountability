<?php
/*
Contains the instantiation and settings for PDO mysql database protocols
Contains function use to interface easily with the database
*/

$host='mysql:host=mysql;dbname=cao;charset=utf8';
$user='cao';
$pass='qX75PvywsmYIHRNleFb6IRBD';
$DBH=null;
try{
        $DBH = new PDO($host, $user, $pass);
        $DBH->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        $DBH->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOexception $e){
        $eMessage = $e->getMessage();
        echo "PDOException: " . wordwrap($eMessage,40,"<br>");
        exit();
}

/*
This function runs SQL commands that return information (Eg SELECT)
@param $sql is the programmer defined command
@param $binds is an optional parameter to define any user inputted information. 
This is to prevent against SQL injection attacks

@return requested information in the form of an array
*/
function get_sql($sql,$binds=array()){
        global $DBH;
        try{
                $query = $DBH->prepare($sql);
                $query->execute($binds);
                $rows=array();
                $rows=$query->fetchAll(PDO::FETCH_ASSOC);
                return $rows;
        }
        catch(PDOException $e){
                echo $sql;
                $eMessage =  $e->getMessage();
                echo "PDOException: " . wordwrap($eMessage,40,"<br>");
                exit();
        }
}

/*
This function runs SQL commands that do not return information (Eg INSERT,UPDATE)
To run a commands that returns information, use function getSQL

@param $sql is the programmer defined command
@param $binds is an optional parameter to define any user inputted information. This is to prevent against SQL injection attacks

@return Null
*/
function insert_sql($sql,$binds=array()){
        global $DBH;
        try{
                $query = $DBH->prepare($sql);
                /*
                each array element is the key marking the placeholder specified by the value
                $binds[:firstName]="Jake"
                $binds[:lastName]="Tibbetts"
                */
                $query->execute($binds);
        }
        catch(PDOException $e){
                echo $sql;
                $eMessage =  $e->getMessage();
                echo "PDOException: " . wordwrap($eMessage,40,"<br>");
                exit();
        }

}


?>
