<?php
require dirname(__DIR__) . '/vendor/autoload.php';
use \App\Config;
use \App\Controllers\EmailController;
use App\Models\Batches;
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
$enrollments = $cronModel->getPendingPaymentEnrollments();
foreach ($enrollments as $enroll) {
    $hour48 = date('Y-m-d H:i:s', strtotime($enroll['created_at'] . " +48 hours"));
    $sd = date('Y-m-d H:i:s', strtotime(" +31 minutes"));
    $ed = date('Y-m-d H:i:s', strtotime(" -31 minutes"));
    if (date("Y-m-d") == date("Y-m-d", strtotime($hour48)) && date("H") == date("H", strtotime($hour48))) {
        $batchModel = new Batches();
        $batch = $batchModel->getBatchInfo($enroll['batch_id']);
        if ($batch['start_date'] < date('Y-m-d')) {
            $email = new EmailController();
            $email->sendEmail('fee_reminder', [
                'email_to' => $enroll['email']
            ]);
        }
    }
}
?>