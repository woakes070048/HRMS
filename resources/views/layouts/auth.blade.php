<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <meta name="author" content="">
    <title>HRMS Login</title>
    <link rel="stylesheet" href="voyager.css">
    <link href="icons.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">
</head>
<body class="login-page">
<div id="bgdim"></div>

<div id="title_section">
    <img class="logo-img" src="logo_icon_light.png" alt="Logo Icon">
    <div class="copy">
        <h1>{Voyager</h1>
        <p>Welcome to Voyager. The Missing Admin for Laravel</p>
    </div>
    <div style="clear:both"></div>
</div>

<div id="login_section">
    <div class="content">
        <h2>Sign In</h2>
        <p>Sign in below:</p>
        <div style="clear:both"></div>
        <form action="" method="POST" id="login">
            <input type="text" class="form-control" name="email" placeholder="email address" value="">
            <input type="password" class="form-control" name="password" placeholder="password">
            <button class="btn btn-primary btn-login" id="voyager-login-btn">
                <span class="login_text"><i class="voyager-lock"></i> Login</span>
                <span class="login_loader">
                        <i class="voyager-lock"></i> Logging in...
                    </span>
            </button>
            <img class="btn-loading" src="logo_icon.png'" alt="Voyager Loader">

        </form>

        <div class="error-login">
            The given credentials don't match with an user registered.
        </div>

    </div>
</div>

<script>
    login_btn = document.getElementById("voyager-login-btn");
    login_btn.addEventListener("click", function () {
        var originalHeight = login_btn.offsetHeight;
        login_btn.style.height = originalHeight + 'px';
        document.querySelector('#voyager-login-btn span.login_text').style.display = 'none';
        document.querySelector('#voyager-login-btn span.login_loader').style.display = 'block';
        document.querySelector('.btn-loading').style.display = 'block';
    });
</script>

</body>
</html>
