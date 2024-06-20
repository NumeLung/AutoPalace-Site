<?php
require_once "config.php";
require_once "Database1.php";
$db = new Database1();

$aParams = [];
$counter = 0;
if ($_POST) {
    ?>
    <script>
        document.getElementById("price").innerHTML = "<?php echo $_POST['price'];?>";
    </script>
    <?php

    $aParams = [
        'brand' => intval($_POST['search_brand'] ?? ''),
        'model' => intval($_POST['search_model'] ?? ''),
        'value' => $_POST['search_value'] ?? '',
        'trim' => $_POST['search_trim'] ?? '',
        'year' => intval($_POST['search_year'] ?? ''),
        'price' => intval($_POST['price'] ?? '')
    ];

    $sQuery = "
    SELECT c.id, b.`name` AS brand_name, m.`name` AS model_name, c.value, c.`trim`, c.`year`, c.price, c.mileage, c.hp, c.gears, c.`desc`, c.featured
    FROM cars c
    LEFT JOIN model m ON c.id_model=m.id
    LEFT JOIN brand b ON b.id = m.id_brand
    WHERE 1";

    $conditions = [];
    $params = [];

    if (!empty($aParams['brand'])) {
        $conditions[] = "b.id = {$aParams['brand']}";
        $params[] = (int)$aParams['brand'];
    }
    if (!empty($aParams['model'])) {
        $conditions[] = "m.id = {$aParams['model']}";
        $params[] = (int)$aParams['model'];
    }
    if (!empty($aParams['value'])) {
        $conditions[] = "c.value = " . "'" . $aParams['value'] . "'";
        $params[] = $aParams['value'];
    }
    if (!empty($aParams['trim'])) {
        $conditions[] = "c.trim = " . "'" . $aParams['trim'] . "'";
        $params[] = $aParams['trim'];
    }
    if (!empty($aParams['year'])) {
        $conditions[] = "c.year >= {$aParams['year']}";
        $params[] = (int)$aParams['year'];
    }
    if (!empty($aParams['price'])) {
        $conditions[] = "c.price <= {$aParams['price']}";
        $params[] = (int)$aParams['price'];
    }

    if (count($conditions) > 0) {
        $sQuery .= ' AND ' . implode(' AND ', $conditions);
    }

        $result = $db->select($sQuery, $params);
        echo "<div class='row'>"; // Start the first row
        foreach ($result as $res) {
            if ($counter > 0 && $counter % 4 == 0) {
                echo "</div><div class='row'>"; // Close the previous row and open a new row
            }
            echo "
            <div class=\"col-lg-3 col-md-4 col-sm-6\">
                <div class=\"single-featured-cars\">
                    <div class=\"featured-img-box\">
                        <div class=\"featured-cars-img\">
                            <img src=\"assets/images/featured-cars/{$res['id']}.png\" alt=\"cars\">
                        </div>
                        <div class=\"featured-model-info\">
                            <p>
                                model: {$res['year']}
                                <span class=\"featured-mi-span\">{$res['mileage']} km</span>
                                <span class=\"featured-hp-span\">{$res['hp']} HP</span>
                                {$res['gears']}
                            </p>
                        </div>
                    </div>
                    <div class=\"featured-cars-txt\">
                        <h2><a href=\"{$res['id']}.php\"><span>{$res['brand_name']} </span>{$res['model_name']}</a></h2>
                        <h3>{$res['price']} $</h3>
                        <p>
                            {$res['desc']}
                        </p>
                    </div>
                </div>
            </div>
            ";
            $counter++;
        }

} else {
    $featured = "
    SELECT c.id, b.`name` AS brand_name, m.`name` AS model_name, c.value, c.`trim`, c.`year`, c.price, c.mileage, c.hp, c.gears, c.`desc`, c.featured
    FROM cars c
    LEFT JOIN model m ON c.id_model=m.id
    LEFT JOIN brand b ON b.id = m.id_brand
    WHERE c.featured = 1";
    $featured = $db->select($featured);
    $counter = 0;
    echo "<div class='row'>"; // Start the first row
    foreach ($featured as $feat) {
        if ($counter > 0 && $counter % 4 == 0) {
            echo "</div><div class='row'>"; // Close the previous row and open a new row
        }
        echo "
        <div class=\"col-lg-3 col-md-4 col-sm-6\">
            <div class=\"single-featured-cars\">
                <div class=\"featured-img-box\">
                    <div class=\"featured-cars-img\">
                        <img src=\"assets/images/featured-cars/{$feat['id']}.png\" alt=\"cars\">
                    </div>
                    <div class=\"featured-model-info\">
                        <p>
                            model: {$feat['year']}
                            <span class=\"featured-mi-span\">{$feat['mileage']} km</span>
                            <span class=\"featured-hp-span\">{$feat['hp']} HP</span>
                            {$feat['gears']}
                        </p>
                    </div>
                </div>
                <div class=\"featured-cars-txt\">
                    <h2><a href=\"{$feat['id']}.php\"><span>{$feat['brand_name']} </span>{$feat['model_name']}</a></h2>
                    <h3>{$feat['price']} $</h3>
                    <p>
                        {$feat['desc']}
                    </p>
                </div>
            </div>
        </div>
        ";
        $counter++;
    }
    echo "</div>"; // Close the last row
}
?>
