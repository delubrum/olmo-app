<head>
    <title>Olmo</title>
    <link rel="icon" sizes="192x192" href="assets/img/ico.png" />
    <link href="assets/css/login.css" rel="stylesheet" type="text/css" media="screen" />
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="robots" content="noindex">
    <script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

</head>

<body>
    <div class="contact">
        <center>
            <img src="assets/img/logo.jpg">
            <br>
            <div class="login">
                <br>
                <form method="post" action="?c=Login&a=Login">
                    <center>
                        <input type="text" name="user" placeholder="Email" autocomplete="off" autofocus required>
                        <br><br>
                        <input type="password" name="pass" placeholder="Contraseña" required>

                        <br><br><br>
                        <input type="submit" class="send" value="Login"></input>
                    </center>
                </form>
            </div>
    </div>
</body>