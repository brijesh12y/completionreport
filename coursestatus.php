<?php
require_once('../../config.php');
require_once('lib.php');
global $USER, $CFG, $DB , $PAGE;
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Course Status');
$PAGE->navbar->add(get_string('course_status', 'local_completionreport'));
$PAGE->set_heading('Course Status');
$PAGE->set_url($CFG->wwwroot.'/local/completionreport/coursestatus.php');
echo $OUTPUT->header();
$userid = $_GET['id'];
?>

<table>
<tr style='background:#feee36'> 
<td><b>Course Modules</b></td>
<td><b>Status</b></td>
<tr>
<?php 
$courses = categoryModules($cat = 2);
 
foreach($courses as $coursedata)
{
	$courseModuleCount = courseModulesCount($coursedata->id);
	$courseModulecompletion = courseModulesCompletion($coursedata->id,$userid);
	//echo "<pre>";
//print_r($coursedata); 
//print_r($courseModulecompletion);
//exit;
	$status = true;
	if(!empty($courseModulecompletion))
	{
		foreach($courseModulecompletion as $data)
		{
			if(!isset($data->completionstate) || is_null($data->completionstate) || $data->completionstate == '' ) $status = false;

		}
	}
?>
			
			
			
				<tr>
					<td><?php echo $data->fullname;?></td>
					<td><?php if($status){echo $i. "Completed";}else{echo $i. "Not completed";}?></td>
				</tr>
			
<?php			
} 

?>
</table> 

</table> 

<?php
echo $OUTPUT->footer();

?>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
} 
  
 	
</style>

