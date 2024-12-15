<?php
require_once "C:/xampp/htdocs/SHE_HACKS/database/database.php";
session_start();
if (!isset($_SESSION["current_user"])) {
    header("Location: /SHE_HACKS/main.php");
    die();
}

$dbo = new Database();
$dbo->conn->exec("USE she_hacks");

$current_user = $_SESSION["current_user"];

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


// For coupon details :
$c3 = "SELECT * FROM Coupons";
$st3 = $dbo->conn->prepare($c3);
$st3->execute();
$Coupons = $st3->fetchAll(PDO::FETCH_ASSOC);

// For inquiry details :
$c5 = "SELECT * FROM Inquiries";
$st5 = $dbo->conn->prepare($c5);
$st5->execute();
$Inquiries = $st5->fetchAll(PDO::FETCH_ASSOC);


unset($dbo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MORE</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/final.css">
    <style>
        table{
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</head>
<body>

    <img class="bg_main" src="resources\bg_6.png" alt="field">
    <nav class="ribbon" id="navbar" style='margin-top: 0;'>
        <nav class="container">
        <img class="logo" style='height: 7%' src="resources\logo1.png" alt="hustla'">
            <ul class="cont blur_box">
                <li class="item"><img id ="user" width="24" height="24" src="https://img.icons8.com/material-outlined/24/user--v1.png" alt="user--v1"/></li>
                <li class="item" id="bookings">My Bookings</li>
                <li class="item" id="wishlist">Wishlist</li>
                <li class="item" id="dests">Destinations</li>
                <li class="item" id="more">More</li>
            </ul>
        </nav>
    </nav>
    <nav class="miniline"></nav>
    <h1>Hey <?php echo htmlspecialchars($user['first_name']); ?>!</h1>
    <nav class="miniline"></nav>
    <p class="para">Ready to take off ??</p>
    <div class="ribbon">
        <div></div>
        <div></div>
        <p>Don't want to continue.....?</p>
        <button id="btnlogout">LOGOUT</button>
        <div></div>
    </div>
    <div class="box">
        <p class='move'><strong>Name :</strong> <?php echo htmlspecialchars($user['first_name']); ?>
        <?php echo htmlspecialchars($user['last_name']); ?>
        </p>
        <p class='move'><strong>Passenger ID :</strong> <?php echo htmlspecialchars($user['user_id']); ?></p>
        <p class='move'><strong>DOB :</strong> <?php echo htmlspecialchars($user['date_of_birth']); ?></p>
        <p class='move'><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p class='move'><strong>Phone Number :</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
    </div>
    <br><br><br><br><br>
    <div class="container">
        <div class="cont">
        <table border="1">
            <caption>COUPONS</caption>
            <thead>
            <tr>
                <th>
                    <p><strong>coupon_id</strong></p>
                </th>
                <th>
                    <p><strong>code</strong></p>
                </th>
                <th>
                    <p><strong>discount_percentage</strong></p>
                </th>
                <th>
                    <p><strong>expiry_date</strong></p>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($Coupons)): ?>
                <?php foreach ($Coupons as $coup): ?>
                <tr>
                    <td>
                        <p><?php echo htmlspecialchars($coup['coupon_id']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($coup['code']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($coup['discount_percentage']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($coup['expiry_date']); ?></p>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="4">No coupons found for the user_id " <?php htmlspecialchars($current_user) ?></td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
    <br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br>
    <div class="miniline" style="color: black; font-size: x-large; opacity: 0.85">All Inquiries so far :</div>
    <br><br><br><br>
    <br><br><br><br>
    <div class="container">
        <div class="cont">
        <table border="1">
            <caption>INQUIRIES</caption>
            <thead>
            <tr>
                <th>
                    <p><strong>inquiry_id</strong></p>
                </th>
                <th>
                    <p><strong>name</strong></p>
                </th>
                <th>
                    <p><strong>email</strong></p>
                </th>
                <th>
                    <p><strong>message</strong></p>
                </th>
                <th>
                    <p><strong>inquiry_date</strong></p>
                </th>
                <th>
                    <p><strong>resolved_status</strong></p>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($Inquiries)): ?>
                <?php foreach ($Inquiries as $cr): ?>
                <tr>
                    <td>
                        <p><?php echo htmlspecialchars($cr['inquiry_id']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($cr['first_name']); ?> <?php echo htmlspecialchars($cr['last_name']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($cr['email']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($cr['message']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($cr['inquiry_date']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($cr['resolved_status']); ?></p>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="8">No crew info available!</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
    <br><br><br><br>
    <br><br><br><br><br><br>
    <nav class="line"></nav>
    <div class="footer">
        <div class="footcont">
            <ul class="list">
                <li class="item2 home">Home</li>
                <li class="item2 bookings">My Bookings</li>
                <li class="item2 wishlist">My Wishlist</li>
            </ul>
            <ul class="list">
                <li class="item2 more">More</li>
                <li class="item2 dests">Destinations</li>
                <li class="item2">Insta Handle</li>
            </ul>
            <ul class="list">
                <li class="item2">Linked In</li>
                <li class="item2">Facebook</li>
                <li class="item2">Youtube</li>
            </ul>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/userlogout.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/dests.js"></script>
    <script src="js/foot.js"></script>
    <script src="js/scroll.js"></script>
</body>
</html>