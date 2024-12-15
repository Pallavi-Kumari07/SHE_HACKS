
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Here</title>
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
    
    <h1 class="heading">Register</h1>
    <div class="logform" style="height: 100vh">
    <div class="container" style="height: 97vh">
        <div class="innercont" style="height: 94vh; padding-top: 17px;">
        
            <div class="box">
                <input
                type="text"
                id="username"
                name="username"
                required
                >
                <label for="username">Username</label>
            </div>
            <div class="box">
                <input
                type="password"
                id="password"
                name="password"
                required
                >
                <label for="password">Password</label>
            </div>
            <div class="box">
                <input
                type="text"
                id="fname"
                name="fname"
                required
                >
                <label for="fname">First Name</label>
            </div>
            <div class="box">
                <input
                type="text"
                id="lname"
                name="lname"
                required
                >
                <label for="lname">Last Name</label>
            </div>
            <div class="box">
                <input
                type="text"
                id="dob"
                name="dob"
                placeholder="yyyy-mm-dd"
                required
                >
                <label for="dob">DOB</label>
            </div>
            <div class="box">
                <input
                type="text"
                id="email"
                name="email"
                required
                >
                <label for="email">Email</label>
            </div>
            <div class="box">
                <input
                type="text"
                id="phone"
                name="phone"
                required
                >
                <label for="phone">Contact</label>
            </div>
            <div class="box">
                <input
                type="text"
                id="address"
                name="address"
                required
                >
                <label for="address">Residential Address</label>
            </div>
            <form action="" method="POST">
            <div class="logcont" style="width: 20vw;">
                <button type="submit" name="submit" class="inactive logbutton regbutton" id="regbutton">
                    REGISTER
                </button>
            </div>
            <div class="diverror" id="diverror">
                <label class="errormessage" id="errormessage"></label>
            </div>
        </form>
        </div>
    </div>
    </div>
    <div class="lockscreen" id="lockscreen">
        <div class="spinner" id="spinner"></div>
        <label class="plwait" id="plwait">PLEASE WAIT</label>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/regi.js"></script>
</body>
</html>
