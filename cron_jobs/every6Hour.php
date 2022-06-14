<?php
require dirname(__DIR__) . '/vendor/autoload.php';
include "connection.php";
use App\Controllers\EmailController;
use App\Models\CronJob;
use App\Models\Enrollments;
use App\Models\Courses;
use App\Models\Students;
$cronModel = new CronJob();
$email = new EmailController();
$enroll = new Enrollments();
$pending_fee = $enroll->getPendingFeeEnroll();
$pending_batch = $enroll->getPendingBatchEnroll();
$approved = $enroll->getApprovedEnroll();
$leads = $leads1 = array();
$lead_name = array(
    "10" => "Game Development",
    "11" => "Graphic Designing",
    "12" => "Web Development",
    "13" => "Mobile Development",
    "15" => "Basic Computer",
    "16" => "Videography",
    "17" => "Graphic Designing",
    "18" => "HTML",
    "19" => "Web Development"
);
foreach ($pending_fee as $pf){
    $u = new Students();
    $u = $u->getStudentsById($pf['student_id']);
    $leads[] = [
        ":name" => $u['name'],
        ":email" => $u['email'],
        ":message" => "Enrolled at: ".date("d-m-Y h:i A", strtotime($pf['created_at'])),
        ":lead_type" => "None Paying List",
        ":lead_name" => (isset($lead_name[$pf['course_id']])) ? $lead_name[$pf['course_id']]: "MISC"
    ];
}
foreach ($pending_batch as $bf){
    $u = new Students();
    $u = $u->getStudentsById($bf['student_id']);
    $leads[] = [
        ":name" => $u['name'],
        ":email" => $u['email'],
        ":message" => "Initiated Enrollment at: ".date("d-m-Y h:i A", strtotime($bf['created_at'])),
        ":lead_type" => "None Paying List",
        ":lead_name" => (isset($lead_name[$bf['course_id']])) ? $lead_name[$bf['course_id']]: "MISC"
    ];
}
foreach ($approved as $ap){
    $u = new Students();
    $u = $u->getStudentsById($ap['student_id']);
    $leads1[] = [
        ":name" => $u['name'],
        ":email" => $u['email'],
        ":message" => "Enrolled at: ".date("d-m-Y h:i A", strtotime($ap['created_at'])),
        ":lead_type" => "Paying List",
        ":lead_name" => (isset($lead_name[$ap['course_id']])) ? $lead_name[$ap['course_id']]: "MISC"
    ];
}
$l = new \App\Models\Leads();
$l->AddNonPayingLeads($leads);
$l->AddPayingLeads($leads1);