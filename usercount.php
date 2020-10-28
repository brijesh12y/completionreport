<?php
require_once('../../config.php');
require_once('lib.php');
global $USER, $CFG, $DB , $PAGE;
require_once($CFG->libdir . "/completionlib.php");
require_once($CFG->libdir . "/accesslib.php");


$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('User Count');
$PAGE->navbar->add(get_string('usercount', 'local_completionreport'));
$PAGE->set_heading('User Count');
$PAGE->set_url($CFG->wwwroot.'/local/completionreport/usercount.php');
echo $OUTPUT->header();
$courseid = $_GET['cid'];
$usercount = courseCompletionUserCount($courseid);
$i = 0;
foreach($usercount as $userdata){
	$userdata;
	$i++;
}
echo $i;

?>



<?php
echo $OUTPUT->footer();

?>
