<?php
header('Content-Type: application/json');

// Database connection details
$host = '127.0.0.1';
$dbname = 'torquegt';
$username = 'root';
$password = '';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the JSON input
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (!is_array($data) || count($data) !== 6) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
        exit;
    }

    // Extract data from the input array
    $id_brand = $data[0];
    $id_model = $data[1];
    $value = $data[2];
    $trim = $data[3];
    $year = $data[4];
    $price = $data[5];

    // Log extracted data for debugging
    file_put_contents('log.txt', print_r($data, true));

    // Main query construction
    $query = "SELECT cars.id, brand.name AS brand_name, model.name AS model_name, cars.value, cars.trim, cars.year, cars.price, cars.mileage, cars.hp, cars.gears, cars.desc
              FROM cars
              JOIN model ON cars.id_model = model.id
              JOIN brand ON model.id_brand = brand.id
              WHERE 1 
                AND brand.id = :id_brand AND model.id = :id_model AND cars.value = :value AND cars.trim = :trim AND cars.year = :year AND cars.price = :price";

    // Prepare the query
    $stmt = $pdo->prepare($query);

    // Bind parameters
    $stmt->bindParam(':id_brand', $id_brand, PDO::PARAM_INT);
    $stmt->bindParam(':id_model', $id_model, PDO::PARAM_INT);
    $stmt->bindParam(':value', $value, PDO::PARAM_STR);
    $stmt->bindParam(':trim', $trim, PDO::PARAM_STR);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->bindParam(':price', $price, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Fetch results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the result as JSON
    echo json_encode(['status' => 'success', 'result' => $result]);



} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
}
?>
