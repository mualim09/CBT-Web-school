<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | INOVINDO ACADEMY</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/logstyle.css">
</head>

<body>
    <div class="container">
        <div class="form">
            <div class="heading">
                <h1>INOVINDO | A C A D E M Y</h1>
                <h2>Welcome Admin</h2>
            </div>

            <!--Form-->
            <form class="wrap2" action="cek_login.php" method="POST">
                <div class="wrap2">
                    <b> <label>Masukan id</label> </b>
                    <input type="text" name="username" placeholder="Enter ID" autocomplete="off">
                    <span class="focus-input2"></span>
                </div>

                <div class="wrap2">
                    <b> <label>Password</label> </b>
                    <input type="password" name="password" placeholder="Password">
                    <span class="focus-input2"></span>
                </div>
                <br>
                <button type="submit" class="btn">Login</button>
        </div>
        </form>

        <!--Gambar-->
        <div class="image">
            <img src="../../assets/images/adm.png" class="img" alt="" />
        </div>
    </div>
</body>

</html>