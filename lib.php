<?php

function enrollmentount($courseid){
global $DB,$CFG;
	
$sql = "SELECT usr.firstname,usr.lastname,usr.email, usr.phone2,COUNT(distinct (usr.id)) AS enroled
FROM mdl_course_categories cc
INNER JOIN mdl_context cx ON cc.id = cx.instanceid
AND cx.contextlevel = '40'
INNER JOIN mdl_role_assignments ra ON cx.id = ra.contextid
INNER JOIN mdl_role r ON ra.roleid = r.id
INNER JOIN mdl_user usr ON ra.userid = usr.id INNER JOIN mdl_otp_varification as otp on otp.userid = usr.id WHERE cc.id = 2 AND usr.deleted='0' AND usr.confirmed='1' AND usr.suspended = 0 AND ra.roleid=5 AND otp.status=1 ORDER BY cc.depth, cc.path, usr.lastname, usr.firstname, r.name, cc.name";
$records = $DB->get_record_sql($sql);
return $records;
}

function enrolledUsers(){
global $DB;	
$sql = "SELECT distinct(usr.id) as userid,usr.firstname,usr.lastname,usr.email, usr.phone2
FROM mdl_course_categories cc
INNER JOIN mdl_context cx ON cc.id = cx.instanceid
AND cx.contextlevel = '40'
INNER JOIN mdl_role_assignments ra ON cx.id = ra.contextid
INNER JOIN mdl_role r ON ra.roleid = r.id
INNER JOIN mdl_user usr ON ra.userid = usr.id INNER JOIN mdl_otp_varification as otp on otp.userid = usr.id WHERE cc.id = 2 AND usr.deleted='0' AND usr.confirmed='1' AND usr.suspended = 0 AND ra.roleid=5 AND otp.status=1 ORDER BY cc.depth, cc.path, usr.lastname, usr.firstname, r.name, cc.name";
$records = $DB->get_records_sql($sql);
return $records;
}

function categoryModules($cat = 2){
global $DB;	
$sql = "SELECT distinct(id) as id,fullname from mdl_course where category=$cat AND visible=1";
$records = $DB->get_records_sql($sql);
return $records;
}

function courseModulesCount($course)
{
	global $DB;	
	$records = $DB->count_records('course_modules',array('course'=>$course));
	return $records;
}

function courseModulesCompletion($courseid, $userid)
{
	global $DB;	
	$sql = "SELECT cm.id as moduleid ,c.fullname, cm.course as courseid, cmc.userid as userid,cmc.completionstate 
	from mdl_course c 
	INNER JOIN mdl_course_modules cm ON cm.course = c.id 
	LEFT JOIN mdl_course_modules_completion cmc on cm.id = cmc.coursemoduleid  AND cmc.userid = $userid AND cmc.completionstate = 1 
	where cm.course = $courseid";
	$records = $DB->get_records_sql($sql);
	return $records;
}

function courseCompletionUserCount($courseid)
{
	global $DB;	
	$sql = "SELECT cmc.userid, cm.id, cm.course, cm.module,cmc.coursemoduleid,cmc.completionstate from mdl_course_modules cm INNER JOIN mdl_course_modules_completion cmc on cm.id = coursemoduleid 
	WHERE cm.course IN($courseid) GROUP BY cmc.userid ORDER BY cmc.userid";
	$records = $DB->get_records_sql($sql);
	return $records;
}







?>