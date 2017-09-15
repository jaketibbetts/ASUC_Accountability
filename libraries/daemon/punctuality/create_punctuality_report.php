<?php

/*
Create an html file that makes the punctuality report
The html file is basically a table
	X-Axis - Report Dates
	Y-Axis - Reporters Listed in lexicographical order

Each Cell (intersecting a report date and a reporter) has a color
	Green - Report Turned in on time
	Yellow - Report Turned in Late  (Yellow also has a number specifying the number of days late)
	Red - Report is past due and not turned in
	Gray - Cross Section does not apply or report not yet due
*/

require_once "/home/c/ca/cao/path_names.php";
require_once DEBUG;
require_once PDO_CONFIG;
require_once TOOLS;
require_once VARIABLES;

$start_date=get_sql("SELECT start FROM Term WHERE id=".TERM_ID.";")[0]['start'];
$YEAR=(new DateTime($start_date))->format("Y");

$output="";

$output.="<table>";
$output.="<th>X</th>";

$mid="<tr>";
$mid.="<td><b>X</b></td>";

$period_sql="SELECT id,turn_in_by,descript,reporters FROM ReportingPeriod WHERE term_id=".TERM_ID.";";
$periods=get_sql($period_sql);

foreach($periods as $period){
	$output.="<th>".$period['descript']."</th>";
	$mid.="<td><b>".$period['descript']."</b></td>";
}
$mid.="</tr>";

$user_sql="SELECT id,role_id,first_name,last_name,title FROM User WHERE term_id=".TERM_ID." ORDER BY last_name;";
$users=get_sql($user_sql);

$row_count=1;

foreach($users as $user){
	if($row_count%10===0){
		$output.=$mid;
	}
	$row_count+=1;
	$output.="<tr>";
	$output.="<td><b>".$user['last_name'].", ".$user['first_name'].", ".$user['title']."</b></td>";

	foreach($periods as $period){
		$bitwise=bitwise_breakdown($period['reporters']);
		if(in_array($user['role_id'],$bitwise)){
	
			$period_date=new DateTime($period['turn_in_by']);
			if($period_date<(new DateTime(date('Y-m-d H:i:s')))){
				$report_sql="SELECT path_name,turned_in FROM Report WHERE user_id=".$user['id']." AND reporting_period_id=".$period['id'].";";
				$report=get_sql($report_sql);
		
				if(count($report)>0){
					$turned_in=new DateTime($report[0]['turned_in']);
					$path=$report[0]['path_name'];
					if($turned_in<$period_date){
						$output.="<td bgcolor='#33cc33'><a href='$path'>ON TIME</a></td>";
					}
				else{
						$difference=(int)(date_diff($turned_in,$period_date,True)->d+1);
						if($difference>1){
							$output.="<td bgcolor='#F4FA58' style=\"text-align: center;\"><a href='$path'>LATE BY ".$difference." DAYS</a></td>";
						}
						else{
							$output.="<td bgcolor='#F4FA58' style=\"text-align: center;\"><a href='$path'>LATE BY ".$difference." DAY</a></td>";
						}
					}
				}
				else{
					$output.="<td bgcolor='#FF0040'>LATE</td>";
				}
			}
			else{
				$output.="<td bgcolor='#A4A4A4'>NOT DUE</td>";
			}
		}
		else{
			$output.="<td bgcolor='#A4A4A4'>N/A</td>";
		}
	}

	$output.="</tr>";
}

$output.="</table>";

$template=file_get_contents("/home/c/ca/cao/libraries/daemon/punctuality/template.html");
$file = fopen("/home/c/ca/cao/public_html/punctuality/$YEAR/index.html",'w+');

fwrite($file,str_replace("OUTPUT",$output,$template));

fclose($file);

//echo $output;

?>
