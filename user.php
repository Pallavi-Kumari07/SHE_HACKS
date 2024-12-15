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
if (isset($_POST['submit'])) {
    $dest = '_';
    $dest = $_POST['dest'];
    $query = "SELECT * FROM Destinations WHERE direction like :dest;";
    $res = $dbo->conn->prepare($query);
    $res->bindParam(':dest', $dest);
    $res->execute();

    $result = $res->fetchAll(PDO::FETCH_ASSOC);
}


unset($dbo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/final.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    
</head>
<body>
    <img class="bg_main" src="resources\bg_9.png" alt="field">
    <nav class="ribbon" id="navbar" style='margin-top: 0;'>
        <nav class="container">
            <img class="logo" style='height: 7%' src="resources\logo1.png" alt="hustla'">
            <ul class="cont blur_box" id="navlist">
                <li class="item"><img id ="user" width="24" height="24" src="https://img.icons8.com/material-outlined/24/user--v1.png" alt="user--v1"/></li>
                <li class="item" id="bookings">My Bookings</li>
                <li class="item" id="wishlist">Wishlist</li>
                <li class="item" id="dests">Destinations</li>
                <li class="item" id="more">More</li>
            </ul>
        </nav>
    </nav>
     <div class="container">
         <h1 style='text-align: left;'>Hey <?php echo htmlspecialchars($user['first_name']); ?>!</h1>
    </div>
    
    <div class="ribbon">
    <p class="side2">--- Ready to take off ?? ---</p>
    <div></div>OR
        <div></div>
        <span>Don't want to continue?</span>
        <button id="btnlogout">LOGOUT</button>
        <div></div>
    </div>
    <div class="miniline" style="visibility: hidden;"></div>
    <br>
    <br>
    <br>
    <section class="slide">
        <div class="box">
            <p class="move"><strong>Name :</strong> <?php echo htmlspecialchars($user['first_name']); ?>
            <?php echo htmlspecialchars($user['last_name']); ?>
            </p>
            <p class="move"><strong>Passenger ID :</strong> <?php echo htmlspecialchars($user['user_id']); ?></p>
            <p class="move"><strong>DOB :</strong> <?php echo htmlspecialchars($user['date_of_birth']); ?></p>
            <p class="move"><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p class="move"><strong>Phone Number :</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
        </div>
        <div class="box card-box">
            <img class="pic airport card card1" src="resources\img_user.jpg" alt="">
            <img class="pic airport card card2" src="resources\img_user.jpg" alt="">
            <img class="pic airport card card3" src="resources\img_user.jpg" alt="">
        </div>
    </section>
    <nav class="miniline" style="visibility: hidden;"></nav>
    <section class="slide" style='padding-left: 3%;'>
        <div class="box"  style='width: 30%; margin-left: 0;'>
            <p class="para">Welcome back to Hustla'!
                Your adventure begins here. Dive into exclusive deals, personalized travel recommendations, and tailored itineraries crafted just for you. Explore hidden gems, bucket-list destinations, and unique experiences—all at your fingertips.
                <br>
                <br>
                Ready to plan your next getaway? Whether it's a weekend escape or the trip of a lifetime, we've got everything you need to make it unforgettable.
                <br>
                <br>
                Start your journey now, and let Hustla' take care of the rest. Adventure awaits!</p>
        <img class="pic airport" src="resources\img_2.png" alt="">
        </div>
        <div class="cont">
            <div class="slide">
            <div class="slide2" >-- <b class='my_comp'>HUSTLA' </b>--  IS YOUR WAY OF DISCOVERING LIFE!
            <div class="box box1">PASSION</div>
            <div class="box box1">ADVENTURE</div>
            <div class="box box1">BLISS</div>
        </div>
    </section>
    <nav class="miniline"></nav>
    <nav class="ribbon"></nav>
    <br><br><br><br><br><br><br><br>
    <h1>Looking for Destinations ?</h1>
    <nav class="miniline" style="visibility: hidden;"></nav>
    <br><br><br><br>
    <div class="container">
        <div class="cont">
            <form action="" method="POST">
                <label for="dest">Tour in :</label>
                <select name="dest" id="dest">
                    <option value="_">SELECT</option>
                    <option value="north">North</option>
                    <option value="east">East</option>
                    <option value="northeast">North-East</option>
                    <option value="west">West</option>
                    <option value="central">Central</option>
                    <option value="south">South</option>
                    <option value="park">National Parks</option>
                    <option value="%">All</option>
                </select>

                <br><br><br><br>
                <input type="submit" id="submit" name="submit" value="Go" class="loginbtn">
            </form>
        </div>
    </div>

    <div class="container">
    <div class="cont">
        <table border="1">
            <caption style="font-weight: 600; background-color: rgba(255,255,255,0.4); padding: 2%;">DESTINATIONS AVAILABLE</caption>
            <thead>
            <tr>
                <th><strong>Destination ID</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Image</strong></th>
                <th><strong>Description</strong></th>
                <th><strong>Location</strong></th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($result) && !empty($result)): ?>
                <?php foreach ($result as $fl): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fl['destination_id']); ?></td>
                        <td><?php echo htmlspecialchars($fl['dest_name']); ?></td>
                        <td><p class='cont'><img class="card" style='width: 5%; height: 7%' src="<?php echo htmlspecialchars($fl['image_url']); ?>" alt="<?php echo htmlspecialchars($fl['image_url']); ?>"></p></td>
                        <td><?php echo htmlspecialchars($fl['descr']); ?></td>
                        <td><?php echo htmlspecialchars($fl['dest_location']); ?></td>         
                    </tr>
                    <?php endforeach; ?>
                <?php elseif (isset($result) && empty($result)): ?>
                    <tr>
                        <td colspan="5">No destinations available for the selected criteria.</td>
                    </tr>
                <?php else: ?>
                        <tr>
                            <td colspan="5">No destinations available. Please select a valid destination.</td>
                        </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<br><br><br><br><br><br><br><br>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    $('form').submit(function (event) {
        event.preventDefault();

        const dest = $('#dest').val();
        if (!dest) {
            alert("Please select a valid destination.");
            return;
        }

        $.ajax({
            url: '',
            type: 'POST',
            data: { dest: dest, submit: true },
            success: function (response) {
                const tableStart = response.indexOf('<table');
                const tableEnd = response.indexOf('</table>') + 8;
                const tableHTML = response.substring(tableStart, tableEnd);
                $('table').replaceWith(tableHTML);
            },
            error: function () {
                alert("An error occurred while fetching destination details.");
            }
        });
    });
});
</script>

</body>
</html>
