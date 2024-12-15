<!-- http://localhost/SHE_HACKS/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                    url("http://localhost/SHE_HACKS/resources/bg_2.png");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
    }
    </style>

</head>
<body>
    <h1 class="heading">Login/Register</h1>
    <div class="airplane-icon"></div>
    <div class="logform">
    <div class="container">
        <div class="innercont">
        <div class="box">
            <input
            type="text"
            id="username"
            required
            >
            <label for="username">Name</label>
        </div>
        <div class="box">
            <input
            type="password"
            id="password"
            required
            >
            <label for="password">Password</label>
        </div>
        <div class="logcont">
            <button class="inactive logbutton">
                LOGIN
            </button>
        </div>
        <div class="diverror" id="diverror">
            <label class="errormessage" id="errormessage"></label>
        </div>
        <h5 style="font-family: sans-serif; font-style: oblique;">Haven't yet made an account?
        <a href="register.php" id="regNow" style="color: #e02a16;">Register</a></h5>
        </div>
    </div>
    </div>
    <div class="lockscreen" id="lockscreen">
        <div class="spinner" id="spinner"></div>
        <label class="plwait" id="plwait">PLEASE WAIT</label>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/userlogin.js"></script>
</body>
</html>
