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

// For packages details :
$c4 = "SELECT * FROM Packages P JOIN Destinations D ON P.destination_id=D.destination_id";
$st4 = $dbo->conn->prepare($c4);
$st4->execute();
$packs = $st4->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESTINATIONS</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/final.css">
    <style>
        table{
            border-collapse: collapse;
            width: 100%;
        }
        .item{
            color: white;
            
        }
        .miniline{
            background-color: rgba(182, 176, 176, 0.4);
        }
        .head1{
            color: whitesmoke;
            font-size: 60px;
            text-align: center;
            font-family: sans-serif;
        }
        .right{
            text-align: right;
            padding-right: 7%
        }
        
    </style>
</head>
<body>
    <img class="bg_main" src="resources\bg_11.png" alt="field">
    <nav class="ribbon" id="navbar" style='margin-top: 0;'>
        <nav class="container">
        <img class="logo" style='height: 7%' src="resources\logo1.png" alt="hustla'">
            <ul class="cont blur_box">
                <li class="item"><img id ="user" width="24" height="24" src="https://img.icons8.com/fluency-systems-filled/50/FFFFFF/user-male-circle.png" alt="user"/></li>
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
        <p style='color: white'>Don't want to continue.....?</p>
        <button style='color: white' id="btnlogout">LOGOUT</button>
        <div></div>
    </div>
    <h3>HILL STATIONS</h3>
    <div class="container" style='width: 100%; padding: 0; position: relative; margin: 0;'>
        <div class="cont" style="position: relative; left: 0; padding: 0; justify-content: start;">
            <div class="box cont-box card-box">
                <img class="pic airport card cd" src="resources\img3.png" alt="nainital">
                <img class="pic airport card cd" src="resources\img4.png" alt="mussoorie">
                <img class="pic airport card cd" src="resources\img5.png" alt="manali">
                <img class="pic airport card cd" src="resources\img6.png" alt="shimla">
                <img class="pic airport card cd" src="resources\img7.png" alt="kasauli">
                <img class="pic airport card cd" src="resources\img8.png" alt="mount abu">
            </div>
        </div>
    </div>
    <div class="miniline"></div>
    <h3 class='right'>PILGRIMAGE</h3>
    <div class="container" style='width: 100%; padding: 0; position: relative; margin: 0; justify-content: end;'>
        <div class="cont" style="position: relative; padding: 0; justify-content: start;">
            <div class="box cont-box card-box">
                <img class="pic airport card acd" src="resources\img9.png" alt="varanasi">
                <img class="pic airport card acd" src="resources\img10.png" alt="haridwar">
                <img class="pic airport card acd" src="resources\img11.png" alt="vrindavan">
                <img class="pic airport card acd" src="resources\img12.png" alt="jagannath puri">
                <img class="pic airport card acd" src="resources\img13.png" alt="badrinath">
                <img class="pic airport card acd" src="resources\img14.png" alt="tirupati">
            </div>
        </div>
    </div>
    <div class="miniline"></div>
    <h3>CULTURE AND HERITAGE</h3>
    <div class="container" style='width: 100%; padding: 0; position: relative; margin: 0;'>
        <div class="cont" style="position: relative; left: 0; padding: 0; justify-content: start;">
            <div class="box cont-box card-box">
                <img class="pic airport card cd" src="resources\img15.png" alt="taj mahal">
                <img class="pic airport card cd" src="resources\img16.png" alt="ajanta caves">
                <img class="pic airport card cd" src="resources\img17.png" alt="red fort">
                <img class="pic airport card cd" src="resources\img18.png" alt="nalanda">
                <img class="pic airport card cd" src="resources\img19.png" alt="surya mandir">
                <img class="pic airport card cd" src="resources\img20.png" alt="mahabodhi temple">
            </div>
        </div>
    </div>
    <div class="miniline"></div>
    <h3 class='right'>FROM NORTH-WEST</h3>
    <div class="container" style='width: 100%; padding: 0; position: relative; margin: 0; justify-content: end;'>
        <div class="cont" style="position: relative; left: 0; padding: 0; justify-content: start;">
            <div class="box cont-box card-box">
                <img class="pic airport card acd" src="resources\img21.png" alt="jaipur">
                <img class="pic airport card acd" src="resources\img22.png" alt="ladakh">
                <img class="pic airport card acd" src="resources\img23.png" alt="kashmir">
                <img class="pic airport card acd" src="resources\img24.png" alt="udaipur">
                <img class="pic airport card acd" src="resources\img25.png" alt="lotus temple">
                <img class="pic airport card acd" src="resources\img26.png" alt="amritsar">
            </div>
        </div>
    </div>
    <div class="miniline"></div>
    <h3>FROM NORTH-EAST</h3>
    <div class="container" style='width: 100%; padding: 0; position: relative; margin: 0;'>
        <div class="cont" style="position: relative; left: 0; padding: 0; justify-content: start;">
            <div class="box cont-box card-box">
                <img class="pic airport card cd" src="resources\img33.png" alt="shillong">
                <img class="pic airport card cd" src="resources\img34.png" alt="gangtok">
                <img class="pic airport card cd" src="resources\img35.png" alt="tsomgo">
                <img class="pic airport card cd" src="resources\img36.png" alt="dzukou">
                <img class="pic airport card cd" src="resources\img37.png" alt="ziro valley">
                <img class="pic airport card cd" src="resources\img38.png" alt="darjeeling">
            </div>
        </div>
    </div>
    <div class="miniline"></div>
    <h3 class='right'>FROM SOUTH</h3>
    <div class="container" style='width: 100%; padding: 0; position: relative; margin: 0; justify-content: end;'>
        <div class="cont" style="position: relative; left: 0; padding: 0; justify-content: start;">
            <div class="box cont-box card-box">
                <img class="pic airport card acd" src="resources\img27.png" alt="kochi">
                <img class="pic airport card acd" src="resources\img28.png" alt="madurai">
                <img class="pic airport card acd" src="resources\img29.png" alt="wayanad">
                <img class="pic airport card acd" src="resources\img30.png" alt="pondicherry">
                <img class="pic airport card acd" src="resources\img31.png" alt="hampi">
                <img class="pic airport card acd" src="resources\img32.png" alt="gokarna">
            </div>
        </div>
    </div>
    <div class="miniline"></div>
    <h3>FROM EAST</h3>
    <div class="container" style='width: 100%; padding: 0; position: relative; margin: 0;'>
        <div class="cont" style="position: relative; left: 0; padding: 0; justify-content: start;">
            <div class="box cont-box card-box">
                <img class="pic airport card cd" src="resources\img39.png" alt="bhubaneshwar">
                <img class="pic airport card cd" src="resources\img40.png" alt="victoria memorial">
                <img class="pic airport card cd" src="resources\img41.png" alt="jubilee park">
                <img class="pic airport card cd" src="resources\img42.png" alt="bodh gaya">
                <img class="pic airport card cd" src="resources\img43.png" alt="howrah bridge">
                <img class="pic airport card cd" src="resources\img44.png" alt="deoghar">
            </div>
        </div>
    </div>
    <div class="miniline"></div>
    <h3 class='right'>FROM CENTRAL</h3>
    <div class="container" style='width: 100%; padding: 0; position: relative; margin: 0; justify-content: end;'>
        <div class="cont" style="position: relative; left: 0; padding: 0; justify-content: start;">
            <div class="box cont-box card-box">
                <img class="pic airport card acd" src="resources\img45.png" alt="ujjain">
                <img class="pic airport card acd" src="resources\img46.png" alt="pachmarhi">
                <img class="pic airport card acd" src="resources\img47.png" alt="khajuraho temple">
                <img class="pic airport card acd" src="resources\img48.png" alt="gwalior">
                <img class="pic airport card acd" src="resources\img49.png" alt="gateway of india">
                <img class="pic airport card acd" src="resources\img50.png" alt="chhatrapati shivaji terminus">
            </div>
        </div>
    </div>
    <div class="miniline"></div>
    <h3>METRO CITIES</h3>
    <div class="container" style='width: 100%; padding: 0; position: relative; margin: 0;'>
        <div class="cont" style="position: relative; left: 0; padding: 0; justify-content: start;">
            <div class="box cont-box card-box">
                <img class="pic airport card cd" src="resources\img51.png" alt="delhi">
                <img class="pic airport card cd" src="resources\img52.png" alt="bangalore">
                <img class="pic airport card cd" src="resources\img53.png" alt="kolkata">
                <img class="pic airport card cd" src="resources\img54.png" alt="chennai">
                <img class="pic airport card cd" src="resources\img55.png" alt="ahmedabad">
                <img class="pic airport card cd" src="resources\img56.png" alt="mumbai">
            </div>
        </div>
    </div>
    <div class="miniline"></div>
    <h3 class='right'>NATIONAL PARKS</h3>
    <div class="container" style='width: 100%; padding: 0; position: relative; margin: 0; justify-content: end;'>
        <div class="cont" style="position: relative; left: 0; padding: 0; justify-content: start;">
            <div class="box cont-box card-box">
                <img class="pic airport card acd" src="resources\img57.png" alt="jim corbett">
                <img class="pic airport card acd" src="resources\img58.png" alt="ranthambore">
                <img class="pic airport card acd" src="resources\img59.png" alt="kaziranga">
                <img class="pic airport card acd" src="resources\img60.png" alt="sundarban">
                <img class="pic airport card acd" src="resources\img61.png" alt="kanchenjunga">
                <img class="pic airport card acd" src="resources\img62.png" alt="nanda devi">
            </div>
        </div>
    </div>
    <div class="miniline"></div>
    <br><br><br><br><br><br><br><br><br><br><br>
    <div class="box" style='color: white; background-color: rgba(182, 176, 176, 0.4);'>
        <p class='move'><strong>Name :</strong> <?php echo htmlspecialchars($user['first_name']); ?>
        <?php echo htmlspecialchars($user['last_name']); ?>
        </p>
        <p class='move'><strong>Passenger ID :</strong> <?php echo htmlspecialchars($user['user_id']); ?></p>
        <p class='move'><strong>DOB :</strong> <?php echo htmlspecialchars($user['date_of_birth']); ?></p>
        <p class='move'><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p class='move'><strong>Phone Number :</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
    </div>
    <br><br><br><br><br>
    <br><br><br><br>
    <h3 style='text-align: center;'>SUGGESTED FOR YOU</h3>
    <div class="container" style='width: 100%; padding: 0; position: relative; margin: 0; justify-content: center;'>
        <div class="cont" style="position: relative; left: 0; padding: 0; justify-content: start;">
            <div class="box cont-box card-box">
                <img class="pic airport card cr" src="resources\img51.png" alt="delhi">
                <img class="pic airport card cr" src="resources\img52.png" alt="bangalore">
                <img class="pic airport card cr" src="resources\img54.png" alt="chennai">
                <img class="pic airport card cr" src="resources\img55.png" alt="ahmedabad">
                <img class="pic airport card cr" src="resources\img56.png" alt="mumbai">
            </div>
        </div>
    </div>
    <div class="miniline"></div>
    <br><br><br><br>
    <br><br><br><br>

    <br><br><br><br>
    <br><br><br><br>
    <div class="miniline" style="color: white; font-size: x-large; opacity: 0.85;">Available Packages Details :</div>
    <br><br><br><br>
    <div class="container" style='padding-left: 9%; margin-left: 0;'>
        <div class="cont" style='padding-left: 0;'>
        <table border="1">
            <caption>PACKAGES</caption>
            <thead>
            <tr>
                <th>
                    <p><strong>package_id</strong></p>
                </th>
                <th>
                    <p><strong>destination</strong></p>
                </th>
                <th>
                    <p><strong>title</strong></p>
                </th>
                <th>
                    <p><strong>description</strong></p>
                </th>
                <th>
                    <p><strong>price</strong></p>
                </th>
                <th>
                    <p><strong>duration_days</strong></p>
                </th>
                <th>
                    <p><strong>inclusions</strong></p>
                </th>
                <th>
                    <p><strong>availability_status</strong></p>
                </th>
                <th>
                    <p><strong>created_at</strong></p>
                </th>
                <th>
                    <p><strong>last updated_at</strong></p>
                </th>
                <th>
                    <p><strong>Add to Wishlist?</strong></p>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($packs)): ?>
                <?php foreach ($packs as $pa): ?>
                <tr>
                    <td>
                        <p><?php echo htmlspecialchars($pa['package_id']); ?></p>
                    </td>
                    <td>
                        <p class='cont'><img class='card' style='width: 5%; height: 7%' src="<?php echo htmlspecialchars($pa['image_url']); ?>" alt="<?php echo htmlspecialchars($pa['image_url']); ?>"></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($pa['title']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($pa['description']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($pa['price']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($pa['duration_days']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($pa['inclusions']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($pa['availability_status']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($pa['created_at']); ?></p>
                    </td>
                    <td>
                        <p><?php echo htmlspecialchars($pa['updated_at']); ?></p>
                    </td>
                    <td>
                        <p><button class="add-to-wishlist loginbtn" value="<?php echo htmlspecialchars($pa['package_id']); ?>" onclick="addToWishlist(this.value)">Add</button></p>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="10">No  payment details found!</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
    <br><br><br><br><br><br>

    <br><br><br><br><br><br>
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
    <script src="js/more.js"></script>
    <script src="js/foot.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/slide.js"></script>
    <script src="js/wish.js"></script>
</body>
</html>