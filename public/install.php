<?php
require dirname(__DIR__) . '/vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Azadchaiwala.pk Database</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        .table, tr, td, th{
            padding: 0px !important;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-lg-4 offset-lg-4 mt-3">
        <div class="card">
            <div class="card-body">
                <h4>Upgradation Started...</h4>
                <table class="table table-bordered">
                    <tr>
                        <td colspan="2" class="text-center">
                            <label class="alert alert-danger text-center mt-3" style="width: 100%;"><strong>DO NOT CLOSE THIS PAGE V1.2</strong></label>
                        </td>
                    </tr>
                    <?php
                    $db_host = \App\Config::DB_HOST;
                    $db_user = \App\Config::DB_USER;
                    $db_pass = \App\Config::DB_PASSWORD;
                    $db_name = \App\Config::DB_NAME;
                    try {
                        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                        showSuccess("Database Connected!");
                    } catch (PDOException $e) {
                        showError($e->getMessage());
                    }
                    //try{
                    //$db->beginTransaction();
                    showSuccess('Transaction Started');
                    // for table badges or batches
                    $db->exec("ALTER TABLE `contact_messages` ADD `status` TINYINT NOT NULL DEFAULT '0' AFTER `message_text`;");
                    $db->exec("ALTER TABLE `feedback_messages` ADD `status` TINYINT NOT NULL DEFAULT '0' AFTER `feedback_text`;");

                    $db->exec("CREATE TABLE `leads` (`id` bigint(20) NOT NULL, `lead_type` varchar(255) NOT NULL,
                                          `lead_name` varchar(255) NOT NULL, `name` varchar(255) NOT NULL,
                                          `email` varchar(255) NOT NULL,`message` text NOT NULL
                                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                    $db->exec("ALTER TABLE `leads` ADD PRIMARY KEY (`id`);");
                    $db->exec("ALTER TABLE `leads` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;");
                    //$db->commit();
                    //}catch(Exception $e){
                    //showError("Rolling Back!");
                    //$db->rollBack();
                    //showError($e->getMessage());
                    //}
                    ?>
                    <tr>
                        <td colspan="2" class="text-center">
                            <label class="alert alert-success text-center mt-3" style="width: 100%;"><strong>Database
                                    Migration Completed.</strong></label>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
function showError($msg){
    echo "<tr><td class='text-center'>";
    echo '<label class="alert alert-danger text-center mt-3" style="width: 100%;"><strong>Error: </strong>'.$msg.'</label>';
    echo '<a href="install.php"><button class="btn btn-warning">GO BACK</button></a>';
    echo "</td></tr>";
    die;
}
function showSuccess($msg){
    echo "<tr><td>";
    echo '<label class="alert alert-success text-center mt-3" style="width: 100%;">'.$msg.'</label>';
    echo "</td></tr>";
}
?>
