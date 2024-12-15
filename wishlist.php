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


$c3 = "SELECT * FROM wishlist W JOIN Packages P ON W.package_id=P.package_id WHERE W.user_id = :user_id";
$st3 = $dbo->conn->prepare($c3);
$st3->bindParam(':user_id', $current_user, PDO::PARAM_STR);
$st3->execute();
$wish = $st3->fetchAll(PDO::FETCH_ASSOC);

$c2 = "SELECT * FROM Reviews R JOIN Packages P ON R.package_id=P.package_id WHERE R.user_id = :user_id";
$st2 = $dbo->conn->prepare($c2);
$st2->bindParam(':user_id', $current_user, PDO::PARAM_STR);
$st2->execute();
$rev = $st2->fetchAll(PDO::FETCH_ASSOC);

$c4 = "SELECT * FROM Bookings B LEFT JOIN Payments P ON B.booking_id=P.booking_id WHERE B.user_id = :user_id";
$st4 = $dbo->conn->prepare($c4);
$st4->bindParam(':user_id', $current_user, PDO::PARAM_STR);
$st4->execute();
$pay = $st4->fetchAll(PDO::FETCH_ASSOC);

$c5 = "SELECT * FROM Bookings B JOIN Tickets T ON B.booking_id=T.booking_id WHERE B.user_id = :user_id";
$st5 = $dbo->conn->prepare($c5);
$st5->bindParam(':user_id', $current_user, PDO::PARAM_STR);
$st5->execute();
$tickets = $st5->fetchAll(PDO::FETCH_ASSOC);


unset($dbo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY WISHLIST</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/final.css">
    <style>
    </style>
</head>
<body>
    <img class="bg_main" src="resources\bg_5.png" alt="field">
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
    <div class="ribbon">
        <div></div>
        <div></div>
        <p>Don't want to continue.....?</p>
        <button id="btnlogout">LOGOUT</button>
        <div></div>
    </div>
    <div class="box">
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
    <br>
    <br>
    
    <div class="container">
        <div class="cont">
        <table border="1">
            <caption>MY WISHLIST</caption>
            <thead>
            <tr>
                <th>
                    <p><strong>wishlist_id</strong></p>
                </th>
                <th>
                    <p><strong>package_id</strong></p>
                </th>
                <th>
                    <p><strong>created_at</strong></p>
                </th>
                <th>
                    <p><strong>title</strong></p>
                </th>
                <th>
                    <p><strong>inclusions</strong></p>
                </th>
                <th>
                <p><strong>duration_days</strong></p>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($wish)): ?>
            <?php foreach ($wish as $fl): ?>
            <tr>
                <td>
                    <p><?php echo htmlspecialchars($fl['wishlist_id']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($fl['package_id']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($fl['created_at']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($fl['title']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($fl['inclusions']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($fl['duration_days']); ?></p>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No dream destination found for the user_id <?php echo htmlspecialchars($current_user) ?></td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="cont">
        <table border="1">
            <caption>MY REVIEWS</caption>
            <thead>
            <tr>
                <th>
                    <p><strong>review_id</strong></p>
                </th>
                <th>
                    <p><strong>package_id</strong></p>
                </th>
                <th>
                    <p><strong>title</strong></p>
                </th>
                <th>
                    <p><strong>rating</strong></p>
                </th>
                <th>
                    <p><strong>review_date</strong></p>
                </th>
                <th>
                    <p><strong>comment</strong></p>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($rev)): ?>
            <?php foreach ($rev as $rv): ?>
            <tr>
                <td>
                    <p><?php echo htmlspecialchars($rv['review_id']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($rv['package_id']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($rv['title']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($rv['rating']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($rv['review_date']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($rv['comment']); ?></p>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No review found by the user_id <?php echo htmlspecialchars($current_user) ?></td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="cont">
        <table border="1">
            <caption>MY PAYMENTS</caption>
            <thead>
            <tr>
                <th>
                    <p><strong>payment_id</strong></p>
                </th>
                <th>
                    <p><strong>payment_date</strong></p>
                </th>
                <th>
                    <p><strong>payment_method</strong></p>
                </th>
                <th>
                    <p><strong>status</strong></p>
                </th>
                <th>
                    <p><strong>transaction_id</strong></p>
                </th>
                <th>
                    <p><strong>amount</strong></p>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($pay)): ?>
            <?php foreach ($pay as $py): ?>
            <tr>
                <td>
                    <p><?php echo htmlspecialchars($py['payment_id']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($py['payment_date']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($py['payment_method']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($py['status']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($py['transaction_id']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($py['amount']); ?></p>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No payments made by the user_id <?php echo htmlspecialchars($current_user) ?> yet</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="cont">
        <table border="1">
            <caption>MY TICKETS</caption>
            <thead>
            <tr>
                <th>
                    <p><strong>ticket_id</strong></p>
                </th>
                <th>
                    <p><strong>booking_id</strong></p>
                </th>
                <th>
                    <p><strong>ticket_number</strong></p>
                </th>
                <th>
                    <p><strong>issue_date</strong></p>
                </th>
                <th>
                    <p><strong>status</strong></p>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($tickets)): ?>
            <?php foreach ($tickets as $tk): ?>
            <tr>
                <td>
                    <p><?php echo htmlspecialchars($tk['ticket_id']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($tk['booking_id']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($tk['ticket_number']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($tk['issue_date']); ?></p>
                </td>
                <td>
                    <p><?php echo htmlspecialchars($tk['status']); ?></p>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No ticket found for the user_id <?php echo htmlspecialchars($current_user) ?></td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        </div>
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
    <script src="js/dests.js"></script>
    <script src="js/foot.js"></script>
    <script src="js/scroll.js"></script>
</body>
</html>