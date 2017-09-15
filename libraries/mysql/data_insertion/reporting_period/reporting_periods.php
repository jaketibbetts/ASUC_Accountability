<?php
require_once "/home/c/ca/cao/path_names.php";
require_once PDO_CONFIG;
require_once VARIABLES;

/*
Formats arguments into a string that can be executed as part of a mysql command
@param $date string, in timestamp form that represents the turnin date
@param $descript string, custom description of the report
@param $reporters int, bitwise number (using the IDs from the Role table) that represents the type of people reporting
For example, 9 -> Executive (1), Commission Chairs (8)
@return formatted mysql command for inserting data into ReportingPeriod Table
*/
function make_report($date,$descript,$reporters,$term_id)
{
	return "($term_id,'".$date."','".$descript."',".$reporters.")";
}

/*
Takes a time returns a DateTime Object with that time in PST
@param $time string in timestamp format
@return a DateTime Object with the specific time
*/
function custom_make_date($time)
{
        $tz=new DateTimeZone('PST');
        #$tz=timezone_open('PST');
        return new DateTime($time,$tz);
}

$report_date=custom_make_date('2017-01-25 23:59:59'); #initial value
$end_date=custom_make_date('2017-04-26 23:59:59'); #final value
$WEEKLY=3; #bitwise value that defines which reporters need to report for a given week
           #get the associated IDs from the Role Table
	   # 1 (Executives) AND 2 (Chiefs)

$YEAR='2017';
$MONTHS=array('February','March','April');
$second_and_fourth = array($report_date->format('Y-m-d H:i:s')); #bylaw 2.3
foreach($MONTHS as $month){
	$sec=(new DateTime("second wed of $month $YEAR"))->format('Y-m-d')." 23:59:59";
        $four=(new DateTime("fourth wed of $month $YEAR"))->format('Y-m-d')." 23:59:59";
	array_push($second_and_fourth,$sec,$four);
	//echo "$sec\n$four\n";
}
$BIWEEKLY=12;#approximately biweekly (every 2nd and 4th wednesday)
	     # 4 (Senators) and 8 (Commission Chairs)


$custom_periods=array(
			//make_report('2017-01-01 23:59:59','Test Report',15)
		);

$mysql_command="INSERT INTO ReportingPeriod (term_id, turn_in_by, descript, reporters) VALUES ";

foreach($custom_periods as $per){
	$mysql_command.=$per.",";
}

#Add the acutal reports
while($report_date<=$end_date){
	$report_date_data=$report_date->format('Y-m-d H:i:s');
	if(in_array($report_date_data,$second_and_fourth)){
		$reporters=$WEEKLY + $BIWEEKLY;
	}
	else{
		$reporters=$WEEKLY;
	}
	$mysql_command.=make_report($report_date_data,"Report For ".$report_date->format('F j, Y'),$reporters,TERM_ID).",";
	$interval=new DateInterval('P7D'); #7 days
	$report_date->add($interval);
}

$mysql_command=rtrim($mysql_command,",").";";
insert_sql($mysql_command)
?>
