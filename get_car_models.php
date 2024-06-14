<?php
require_once "config.php";
require_once "Database.php";
$db = new Database();

if (isset($_POST['brand_id'])) {
    $brand_id = $_POST['brand_id'];
    $models = $db->select("SELECT id, name FROM model WHERE id_brand = ?", [$brand_id]);

    $options = "<option value=''>избери</option>";
    foreach ($models as $model) {
        $options .= "<option value='{$model['id']}'>{$model['name']}</option>";
    }

    echo $options;
}
?>
