<?php

/*
Creates a report using the pdf templates specified by template.fdf and template.pdf

@param $arr the key value pairs for the values being filled in
	Should exactly read
	$arr['NAME']->Name Of Reporter
	$arr['TITLE']->Title Of Reporter
	$arr['REPORT_WEEK']->Report Description
	$arr['MEETINGS_ATTENDED']->Meetings Attended That Week
	$arr['CURRENT_PROJECTS']->Current Projects Worked On That Week
	$arr['EXPENDITURES']->Expenditures That Week
	$arr['OTHER']->Other Information
@param $name the name of the output file 
@return path to created output file
*/
function create_report($arr,$name){
	//Maybe rewrite this as a shell script at some point
	$path_to_fdf="/home/c/ca/cao/libraries/php/pdf_creator/temp_files/" . $name . ".fdf";
	$path_to_pdf="/home/c/ca/cao/public_html/pdf/" . $name . ".pdf";
	exec("cp /home/c/ca/cao/libraries/php/pdf_creator/template.fdf $path_to_fdf");

	$fdf_text = file_get_contents($path_to_fdf);
	foreach($arr as $key => $val){
		$fdf_text = str_replace($key,$val,$fdf_text);
	}

	$fdf_file = fopen($path_to_fdf,"w+");
	fwrite($fdf_file,$fdf_text);
	fclose($fdf_file);

/*	$shell_fr="sed -i '";
	foreach($arr as $key => $val){
		//$escaped_val = preg_replace('/[^A-Za-z0-9\-]/', '', $val);
		$shell_fr.="s/$key/$val/g;";
	}
	$shell_fr.="' $path_to_fdf";
	exec($shell_fr);
*/

	//echo $path_to_pdf."<br>";
	//echo $path_to_fdf;

	$command = "pdftk /home/c/ca/cao/libraries/php/pdf_creator/template.pdf fill_form $path_to_fdf output $path_to_pdf flatten";
	//echo $command;

	exec($command);
	return "https://accountability.asuc.org/pdf/".$name.".pdf";
}

?>
