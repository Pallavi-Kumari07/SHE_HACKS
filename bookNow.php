<?php
require_once "C:/xampp/htdocs/SHE_HACKS/database/database.php";
session_start();

if (!isset($_SESSION["current_user"])) {
    header("Location: /SHE_HACKS/main.php");
    die();
}

$dbo = new Database();
if (!$dbo->conn) {
    die("Database connection failed....");
}

$dbo->conn->exec("USE she_hacks");

$current_user = $_SESSION["current_user"];

// For the user details :
$c = "SELECT * FROM user_details WHERE user_id = :user_id";
$st = $dbo->conn->prepare($c);
$st->bindParam(':user_id', $current_user, PDO::PARAM_STR);
$st->execute();
$user = $st->fetch(PDO::FETCH_ASSOC);

if ($user) {
} else {
    echo "No user found with the user_id " . htmlspecialchars($current_user);
    die();
}

$c1 = "SELECT * FROM Packages WHERE availability_status LIKE 'available';";
$st1 = $dbo->conn->prepare($c1);
$st1->execute();
$packs = $st1->fetchAll(PDO::FETCH_ASSOC);

if (!$packs) {
    echo "No packages found.";
    die();
}

$final_res = false;
if (isset($_POST['submit'])) {

    $travel_date = $_POST['travel_date'];
    $travel_time = $_POST['travel_time'];
    $class = $_POST['class'];
    $pay_mode = $_POST['pay_mode'];
    $user_id = $current_user;
    $booking_date = date('Y-m-d H:i:s');
    $price=0;
    $dest = $_POST['dest'];

    switch ($class) {
        case 'General':
            $price = rand(100, 600);
            break;
        case 'Premium':
            $price = rand(700, 1500);
            break;
        case 'VIP':
            $price = rand(1500, 3000);
            break;
    }
    //ticket_number
    $ticket_start = 'TCKT';
    $ticket_rest = random_int(1050,9999);
    $ticket_num = $ticket_start.$ticket_rest;
    
    //transaction_number
    $transac_start = 'TXN';

    //$status_all = ['confirmed','pending','canceled'];
    $i = rand(0,1);
    $status = 'confirmed';
    if($i<0.3) $status = 'pending';
    //$pay_status_all = ['completed','pending','failed'];
    $j = rand(0,1);
    $pay_status = 'completed';
    if($j<0.3) $pay_status = 'pending';
    elseif($j<0.6) $pay_status = 'failed';
    if($status == 'canceled') $pay_status = 'failed';
    $bid_query = "SELECT * FROM Bookings WHERE booking_id = (SELECT MAX(booking_id) FROM Bookings)";
    $bid_result = $dbo->conn->prepare($bid_query);
    $bid_result->execute();
    $row1 = $bid_result->fetch(PDO::FETCH_ASSOC);
    if($row1){
        $bid = $row1['booking_id']+1;
    }else{
        exit;
    }
    $transac_id = '';
    do {
        $transac_rest = random_int(10000000,99999999);
        $transaction_id = $transac_start.$transac_rest;
        $transac_id = $transaction_id;
        $tid_check_query = "SELECT * FROM Payments WHERE payment_id = :bid AND transaction_id = :transaction_id";
        $tid_check_stmt = $dbo->conn->prepare($tid_check_query);
        $tid_check_stmt->bindParam(':bid', $bid);
        $tid_check_stmt->bindParam(':transaction_id', $transaction_id);
        $tid_check_stmt->execute();
    
    } while ($tid_check_stmt->rowCount() > 0);

    $sql = "INSERT INTO Bookings (booking_id, package_id, user_id, booking_date, travel_date, status, total_price) 
            VALUES (:bid, :package_id, :user_id, :booking_date, :travel_date, :status, :total_price)";
    
    $insert_stmt = $dbo->conn->prepare($sql);
    $insert_stmt->bindParam(':bid', $bid);
    $insert_stmt->bindParam(':package_id', $dest);
    $insert_stmt->bindParam(':user_id', $user_id);
    $insert_stmt->bindParam(':booking_date', $booking_date);
    $insert_stmt->bindParam(':travel_date', $travel_date);
    $insert_stmt->bindParam(':status', $status);
    $insert_stmt->bindParam(':total_price', $price);
    

    $cc = "INSERT INTO Payments (payment_id, booking_id, payment_date, amount, payment_method, status, transaction_id)
               VALUES (:payment_id, :booking_id, :payment_date, :amount, :pay_mode, :pay_status, :tid)";
    $stt = $dbo->conn->prepare($cc);
    $stt->bindParam(':payment_id', $bid);
    $stt->bindParam(':booking_id', $bid);
    $stt->bindParam(':payment_date', $booking_date);
    $stt->bindParam(':amount', $price);
    $stt->bindParam(':pay_mode', $pay_mode);
    $stt->bindParam(':pay_status', $pay_status);
    $stt->bindParam(':tid', $transaction_id);

    $ct = "INSERT INTO Tickets (ticket_id, booking_id, issue_date, ticket_number, status)
               VALUES (:ticket_id, :bid, :booking_date, :ticket_num, :status)";
    $stt1 = $dbo->conn->prepare($ct);
    $stt1->bindParam(':ticket_id', $bid);
    $stt1->bindParam(':bid', $bid);
    $stt1->bindParam(':booking_date', $booking_date);
    $stt1->bindParam(':ticket_num', $ticket_num);
    $stt1->bindParam(':status', $status);
    if ($insert_stmt->execute() && $stt->execute() && $stt1->execute()) {
        echo "Booking successful!";
        
    } else {
        $error = $insert_stmt->errorInfo();
        echo "Error: " . $sql . "<br>" . $error[2];
    }
}

unset($dbo);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/final.css">
    <link rel="stylesheet" href="css/booking.css">

</head>
<body>
    <img class="bg_main" src="resources\bg_9.png" alt="field">
    <nav class="miniline"></nav>
    <h1>Oh Hi <?php echo htmlspecialchars($user['first_name']); ?> :)</h1>
    <nav class="miniline"></nav>
    <nav class="ribbon"></nav>
    <div class="container">
            <form action="" method="POST">
                <label for="travel_date">Travel Date :</label>
                <input type="date" id="travel_date" name="travel_date" required>
                
                <label for="dest">Package :</label>
                <select name="dest" id="dest">
                    <?php if (!empty($packs)): ?>
                    <?php foreach ($packs as $pa): ?>
                        <option value="<?php echo htmlspecialchars($pa['package_id']); ?>"><?php echo htmlspecialchars($pa['title']); ?> : <?php echo htmlspecialchars($pa['duration_days']); ?> days</option>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <option disabled>No Packages available</option>
                    <?php endif; ?>
                </select>

                <label for="travel_time">Starting from :</label>
                <input type="time" id="travel_time" name="travel_time" required>
                
                <label for="class">Pass :</label>
                <select id="class" name="class" required>
                    <option value="General">General</option>
                    <option value="Premium">Premium</option>
                    <option value="VIP">VIP</option>
                </select>
                <label for="pay_mode">Payment Mode :</label>
                <select name="pay_mode" id="pay_mode">
                    <option value="Credit Card">Credit Card</option>
                    <option value="Debit Card">Debit Card</option>
                    <option value="UPI">UPI</option>
                    <option value="Net Banking">Net Banking</option>
                </select>
                <br><br>
                <br><br>
                <input type="submit" name="submit" value="Book Now" class="loginbtn">
            </form>
    </div>
    <div></div>
    <nav class="ribbon"></nav>
    <div class="container">
        <div class="cont">Don't want to book right now....?
            <button id="back" style="color: rgb(70, 130, 180); background-color: transparent; border-radius: none; border: none; padding: 17px;">Go Back</button>
        </div>
    </div>
    <br>
    <br>
    <br>
    <nav class="miniline"></nav>
    <script src="js/bookNow.js"></script>
    <script src="js/back.js"></script>
</body>
</html>