<?php
require_once('../../config.php');
require_once('lib.php');
require_once($CFG->dirroot . "/local/customenrol/lib.php");
global $USER, $CFG, $DB , $PAGE;
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Completion Report');
$PAGE->navbar->add(get_string('completionreport', 'local_completionreport'));
$PAGE->set_heading('Completion Report');
$PAGE->set_url($CFG->wwwroot.'/local/completionreport/index.php');
echo $OUTPUT->header();


$enrollcounts = enrollmentount(4);
$total_rows =  $enrollcounts->enroled;
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = enrolledUsers();
$course = categoryModules();
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script><script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<table>
<tr>
<td>
<b>User Count: <?php echo $total_rows; ?></b></td>
<td>
<select disabled id="profile_completed_notcompleted">
<option value="">Select option</option>
<?php

$category = get_enrolled_coursecategory($USER->id);
foreach($category as $key=>$value){
?>
<option value="<?php echo $key; ?>" <?php if($key == 2){echo "selected";} ?>><?php echo $value; ?></option>
<?php } ?>
</select>
</td>
<td>
<select id="programs">
<?php foreach($course as $courses){ ?>
<option style="font-weight:bold;" value="<?php echo $courses->id;?>"><?php echo $courses->fullname;?></option>
<?php } ?>
</select>
<button id='courseids'>Submit</button>
</td>
</tr>
</table>
<br/>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">User Id </th>
      <th class="th-sm">User Name </th>
      <th class="th-sm">Email </th>
      <th class="th-sm">Phone </th>      
      <th class="th-sm">Module Status </th>      
    </tr>
  </thead>
  <tbody>
  <?php foreach($sql as $sqlData){ ?>
    <tr>
	  <td><?php echo $sqlData->userid; ?></td>
      <td><?php echo $sqlData->firstname." ".$sqlData->lastname; ?></td>
      <td><?php echo $sqlData->email; ?></td>
      <td><?php echo $sqlData->phone2; ?></td>
      <td><a href="coursestatus.php?id=<?php echo $sqlData->userid; ?>">View Status</a></td>		
    </tr>   
  <?php } ?>
  </tbody>
  <tfoot>
    <tr>
      <th class="th-sm">User Id </th>
      <th class="th-sm">User Name </th>
      <th class="th-sm">Email </th>
      <th class="th-sm">Phone </th>
	 <th class="th-sm">Module Status</th>        
    </tr>
  </tfoot>
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
<script>

$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>

<script>
$(document).ready(function(){
	$('#courseids').click(function(){
	var cid = $('#programs').val(); 
	var url ="<?php echo $CFG->wwwroot; ?>/report/progress/index.php?course=" + cid;	
	window.open(url,'_blank');
});
});
</script>
<script>
$('#dtBasicExample').dataTable( {
  "pageLength": 50
} );
</script>



