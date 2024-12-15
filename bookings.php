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

$c2 = "SELECT * FROM Bookings B JOIN Packages P ON B.package_id=P.package_id WHERE user_id = :user_id";
$st2 = $dbo->conn->prepare($c2);
$st2->bindParam(':user_id', $current_user, PDO::PARAM_STR);
$st2->execute();
$booking = $st2->fetchAll(PDO::FETCH_ASSOC);


unset($dbo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY BOOKINGS</title>
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
    <img class="bg_main" src="resources\bg_7.png" alt="field">
    <nav class="ribbon" id="navbar" style='margin-top: 0;'>
        <nav class="container">
        <img class="logo" style='height: 7%' src="resources\logo1.png" alt="hustla'">
            <ul class="cont blur_box">
            <li class="item"><img id ="user" width="24" height="24" src="https://img.icons8.com/material-outlined/24/user--v1.png" alt="user"/></li>
                <li class="item wt" id="bookings">My Bookings</li>
                <li class="item wt" id="wishlist">Wishlist</li>
                <li class="item wt" id="dests">Destinations</li>
                <li class="item wt" id="more">More</li>
            </ul>
        </nav>
    </nav>
    <nav class="miniline" style='visibility: hidden;'></nav>
    <h1>Hey <?php echo htmlspecialchars($user['first_name']); ?>!</h1>
    <nav class="miniline" style='background-color: rgba(255,255,255,0.4);'></nav>
    <div class="ribbon">
        <div></div>
        <div></div>
        <p>Don't want to continue.....?</p>
        <button id="btnlogout">LOGOUT</button>
        <div></div>
    </div>
    <div class="box" style='background-color: rgba(255,255,255,0.4);'>
        <p class="move"><strong>Name :</strong> <?php echo htmlspecialchars($user['first_name']); ?>
        <?php echo htmlspecialchars($user['last_name']); ?>
        </p>
        <p class="move"><strong>Passenger ID :</strong> <?php echo htmlspecialchars($user['user_id']); ?></p>
        <p class="move"><strong>DOB :</strong> <?php echo htmlspecialchars($user['date_of_birth']); ?></p>
        <p class="move"><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p class="move"><strong>Phone Number :</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
    </div>
    <br>
    <br>
    <br>
    <div class="ribbon wt"><div></div>Planning on a new journey?
        <button class="loginbtn" id="bookNow">Book Now</button>
        <div></div>
    </div>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="cont" style='padding-left: 10%;'>
            <table border="1">
                <caption style="font-weight: 600; background-color: rgba(255,255,255,0.4); padding: 4%;">MY BOOKINGS</caption>
                <div></div>
            <thead>
                <tr>
                    <th>
                        <p><strong>booking_id</strong></p>
                    </th>
                    <th>
                        <p><strong>package_id</strong></p>
                    </th>
                    <th>
                        <p><strong>title</strong></p>
                    </th>
                    <th>
                        <p><strong>booking_date</strong></p>
                    </th>
                <th>
                    <p><strong>travel_date</strong></p>
                </th>
                <th>
                    <p><strong>status</strong></p>
                </th>
                <th>
                    <p><strong>total_price</strong></p>
                </th>
                <th>
                    <p><strong>created_at</strong></p>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($booking)): ?>
                <?php foreach ($booking as $book): ?>
                    <tr>
                        <td>
                            <p><?php echo htmlspecialchars($book['booking_id']); ?></p>
                        </td>
                        <td>
                            <p><?php echo htmlspecialchars($book['package_id']); ?></p>
                        </td>
                        <td>
                            <p><?php echo htmlspecialchars($book['title']); ?></p>
                        </td>
                        <td>
                            <p><?php echo htmlspecialchars($book['booking_date']); ?></p>
                        </td>
                        <td>
                            <p><?php echo htmlspecialchars($book['travel_date']); ?></p>
                        </td>
                        <td>
                            <p><?php echo htmlspecialchars($book['status']); ?></p>
                        </td>
                        <td>
                            <p><?php echo htmlspecialchars($book['total_price']); ?></p>
                        </td>
                        <td>
                            <p><?php echo htmlspecialchars($book['created_at']); ?></p>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No bookings found for the user_id <?php echo htmlspecialchars($current_user) ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="ribbon"><div></div>Want to cancel your bookings?
            <button class="loginbtn" id="cancelNow">Cancel Booking</button>
            <div></div>
        </div>
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
    <script src="js/bookNow.js"></script>
    <script src="js/more.js"></script>
    <script src="js/dests.js"></script>
    <script src="js/cancel.js"></script>
    <script src="js/foot.js"></script>
    <script src="js/scroll.js"></script>
</body>
</html>