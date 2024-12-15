<?php
require_once "C:/xampp/htdocs/SHE_HACKS/database/database.php";
session_start();

if (!isset($_SESSION["current_user"])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in.']);
    header("Location: /SHE_HACKS/main.php");
    die();
}

$current_user = $_SESSION["current_user"];

if (!isset($_POST['package_id']) || empty($_POST['package_id'])) {
    echo json_encode(['success' => false, 'error' => 'Invalid package ID.']);
    die();
}

$package_id = $_POST['package_id'];

try {
    $dbo = new Database();
    $dbo->conn->exec("USE she_hacks;");

    $query = "INSERT INTO Wishlist (user_id, package_id) VALUES (:user_id, :package_id)";
    $stmt = $dbo->conn->prepare($query);
    $stmt->bindParam(':user_id', $current_user, PDO::PARAM_STR);
    $stmt->bindParam(':package_id', $package_id, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to add package to wishlist.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} finally {
    unset($dbo);
}
?>
