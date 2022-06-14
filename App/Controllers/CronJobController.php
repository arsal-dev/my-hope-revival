<?php


namespace App\Controllers;

use App\Models\Batches;
use App\Models\Courses;
use App\Models\CronJob;

class CronJobController
{
    public function __construct($request)
    {

    }

    // this will send an reminder for payment if not paid yet after 48 hours
    public function sendAfter48Hours()
    {
        $cronModel = new CronJob();
        $enrollments = $cronModel->getPendingPaymentEnrollments();
        foreach ($enrollments as $enroll) {
            $hour48 = date('Y-m-d H:i:s', strtotime($enroll['created_at'] . " +48 hours"));
            $sd = date('Y-m-d H:i:s', strtotime(" +31 minutes"));
            $ed = date('Y-m-d H:i:s', strtotime(" -31 minutes"));
            if ($hour48 > $sd && $hour48 < $ed) {
                $batchModel = new Batches();
                $batch = $batchModel->getBatchInfo($enroll['batch_id']);
                if ($batch['start_date'] < date('Y-m-d')) {
                    $email = new \App\Controllers\EmailController();
                    $email->sendEmail('fee_reminder', [
                        'email_to' => $enroll['email']
                    ]);
                }
            }
        }
    }

    // this will send an reminder for course start 24 hours before.
    public function sendBefore24Hours()
    {
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
                $email = new \App\Controllers\EmailController();
                $email->sendEmail('course_reminder', [
                    'email_to' => $enroll['email'],
                    'course' => $course['course_name'],
                    'course_date' => date("l F d, Y", strtotime($batch['start_date'])),
                    'course_time' => date('h:i A', strtotime($batch['start_time']))
                ]);
            }
        }
    }
}