<?php

/*
Creates a zip file that is meant to be unziped on a local machine and uploaded to google drive
Follows the directory structure example
2016-2017
---Senators
------Senator_1_Name
---------Report_1
---------Report_2
---------...
---------Report_n
------Senator_2_Name
------...
------Senator_20_Name
---Executives
------Executive_1_Name, Title
------...
------Executive_n_Name, Title
---Commission Chairs
------Commission_Chair_1_Name, Comission_Name
------...
------Commission_Chair_n_Name, Comission_Name
---Cheif Appointed Officials
------Chief_1_Name
------...
------Chief_n_Name
*/

require_once "/home/c/ca/cao/path_names.php";
require_once PDO_CONFIG;
require_once VARIABLES;

$UP_PREF="/home/c/ca/cao/backups/drive/";
$DOWN_PREF="/home/c/ca/cao/public_html/pdf/";

$role_sql="SELECT id,descript FROM Role;";
$roles=get_sql($role_sql);

$date_sql="SELECT start FROM Term WHERE id=".TERM_ID.";";
$dates=get_sql($date_sql);
$date=(new DateTime($dates[0]['start']))->format('Y');
$fl_dir="".$date."-".($date+1);//First Level Directory

$first_level_mkdir="mkdir '$UP_PREF"."$fl_dir';";
exec($first_level_mkdir);

foreach($roles as $role){
	$sl_dir=$role['descript']."s";
	$second_level_mkdir="mkdir '$UP_PREF"."$fl_dir/$sl_dir'";
	exec($second_level_mkdir);

	$user_sql="SELECT id,first_name,last_name,title FROM User WHERE term_id=".TERM_ID." AND role_id=".$role['id'].";";
	$users=get_sql($user_sql);
	foreach($users as $user){
		$th_dir=$user['first_name']." ".$user['last_name'].", ".$user['title'];
		$third_level_mkdir="mkdir '$UP_PREF"."$fl_dir/$sl_dir/$th_dir'";
		exec($third_level_mkdir);

		$report_sql="SELECT path_name FROM Report WHERE user_id=".$user['id'].";";
		$reports=get_sql($report_sql);
		foreach($reports as $report){
			$file_name=ltrim($report['path_name'],"https://accountability.asuc.org/pdf/");
			$copy_to_backup="cp $DOWN_PREF"."$file_name '$UP_PREF"."$fl_dir/$sl_dir/$th_dir'";
			exec($copy_to_backup);
		}
	}
}

$zip_name=$fl_dir."_".date('Ymd');
$zip_command="cd $UP_PREF;zip -r ".$zip_name." ".$fl_dir;
exec($zip_command);

//Maybe Attach the zip file to an email and send it

?>
