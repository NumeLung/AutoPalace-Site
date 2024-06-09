<?php
require_once "include.php";
require_once "Database.php";
$db = new Database();

if (isset($_POST['brand_id'])) {
    $brand_id = $_POST['brand_id'];
    $models = $db->select("SELECT id, name FROM model WHERE id_brand = ?", [$brand_id]);

    $options = "<option value='default'>избери</option>";
    foreach ($models as $model) {
        $options .= "<option value='{$model['id']}'>{$model['name']}</option>";
    }

    echo $options;
}
?>
