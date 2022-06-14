<?php
require dirname(__DIR__) . '/vendor/autoload.php';
include "connection.php";
use App\Controllers\EmailController;
use App\Models\Batches;
use App\Models\Courses;
use App\Models\CronJob;
$cronModel = new CronJob();
$batchModel = new Batches();
$courseModel = new Courses();
$email = new EmailController();
$enrollments = $cronModel->getVerifiedEnrollments();
foreach ($enrollments as $enroll) {
    $sd = date('Y-m-d H:i:s', strtotime(" +31 minutes"));
    $ed = date('Y-m-d H:i:s', strtotime(" -31 minutes"));
    $course = $courseModel->getCourse($enroll['course_id']);
    $batch = $batchModel->getBatchInfo($enroll['batch_id']);
    $hour24 = date('Y-m-d H:i:s', strtotime($batch['start_date'] . " " . $batch['start_time'] . " -24 hours"));
    if ($hour24 < $sd && $hour24 > $ed) {
        $email->sendEmail('course_reminder', [
            'email_to' => $enroll['email'],
            'course' => $course['course_name'],
            'course_date' => date("l F d, Y", strtotime($batch['start_date'])),
            'course_time' => date('h:i A', strtotime($batch['start_time']))
        ]);
    }
}
$enrollments = $cronModel->getPendingPaymentEnrollments();
foreach ($enrollments as $enroll) {
    $hour48 = date('Y-m-d H:i:s', strtotime($enroll['created_at'] . " +48 hours"));
    $sd = date('Y-m-d H:i:s', strtotime(" +31 minutes"));
    $ed = date('Y-m-d H:i:s', strtotime(" -31 minutes"));
    if (date("Y-m-d") == date("Y-m-d", strtotime($hour48)) && date("H") == date("H", strtotime($hour48))) {
        $batch = $batchModel->getBatchInfo($enroll['batch_id']);
        if (strtotime($batch['start_date']) > time()) {
            $email->sendEmail('fee_reminder', [
                'email_to' => $enroll['email']
            ]);
        }
    }
}
?>