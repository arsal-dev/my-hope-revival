<?php
require dirname(__DIR__) . '/vendor/autoload.php';
use \App\Config;
use \App\Controllers\EmailController;
use App\Models\Batches;
use App\Models\Courses;
use App\Models\CronJob;

$db_host = Config::DB_HOST;
$db_user = Config::DB_USER;
$db_pass = Config::DB_PASSWORD;
$db_name = Config::DB_NAME;
try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
} catch (PDOException $e) {
}
$cronModel = new CronJob();
$enrollments = $cronModel->getVerifiedEnrollments();
foreach ($enrollments as $enroll) {
    $sd = date('Y-m-d H:i:s', strtotime(" +31 minutes"));
    $ed = date('Y-m-d H:i:s', strtotime(" -31 minutes"));
    $batchModel = new Batches();
    $courseModel = new Courses();
    $course = $courseModel->getCourse($enroll['course_id']);
    $batch = $batchModel->getBatchInfo($enroll['batch_id']);
    $hour24 = date('Y-m-d H:i:s', strtotime($batch['start_date']." ".$batch['start_time'] . " -24 hours"));
    if ($hour24 < $sd && $hour24 > $ed) {
        $email = new EmailController();
        $email->sendEmail('course_reminder', [
            'email_to' => $enroll['email'],
            'course' => $course['course_name'],
            'course_date' => date("l F d, Y", strtotime($batch['start_date'])),
            'course_time' => date('h:i A', strtotime($batch['start_time']))
        ]);
    }
}
?>