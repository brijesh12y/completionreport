<?php
require_once('../../config.php');
require_once('bulksms_form.php');

global $USER, $CFG, $DB , $PAGE;
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Bulk SMS');
$PAGE->navbar->add(get_string('bulksms', 'local_bulksms'));
$PAGE->set_heading('Bulk SMS');
$PAGE->set_url($CFG->wwwroot.'/local/bulksms/index.php');
echo $OUTPUT->header();

$mform = new bulksms_form();
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
} else if ($fromform = $mform->get_data()) {
  //In this case you process validated data. $mform->get_data() returns data posted in form.
  $data = new stdclass();
  $data->email = $fromform->email;
  $emails = explode(",",$data->email);
  $data->message = $fromform->message[text];
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-type: text/html\r\n";
  $subject = "RLG License Varification";
  foreach($emails as $emailid){
	   $retval = mail ($emailid,$subject,$data->message,$header);        
         
  }
  if( $retval == true ) {
		echo "Message sent successfully...";
	 }else {
		echo "Message could not be sent...";
	 }

} else {
  // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
  // or on the first display of the form.
 
  //Set default data (if any)
  $mform->set_data($toform);
  //displays the form
  $mform->display();
}


echo $OUTPUT->footer();

?>
