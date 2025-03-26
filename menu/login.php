<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="assets/img/login.gif" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <style>
        body {
    background-image: url('assets/img/roti.jpg'); /* Change this to your desired background image URL */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.form-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 30px;
    margin-bottom: 30px;
}

.form-form-wrap {
    background: rgba(255, 255, 255, 0.5); /* Increased transparency */
    backdrop-filter: blur(5px); /* Removed blur effect */
    padding: 20px 15px; /* Adjusted padding */
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    width: 100%; /* Adjust width as needed */
    max-width: 400px; /* Set maximum width */
    height: auto; /* Adjust height as needed */
    max-height: 600px; /* Set maximum height */
}

.form-content {
    text-align: center;
}

h1, h5 {
    margin-bottom: 5px; /* Adjust margin */
}

.field-wrapper {
    margin-bottom: 15px; /* Adjust margin */
}

.field-wrapper input {
    width: 100%; /* Ensure input field takes full width */
    padding: 10px; /* Adjust padding for better spacing */
    border: 1px solid rgba(0, 0, 0, 0.2); /* Add a light border for visibility */
    background: transparent; /* Make background transparent */
    border-radius: 5px; /* Optional: Add border-radius for smoother edges */
    color: #000; /* Set text color */
}

.field-wrapper input::placeholder {
    color: rgba(0, 0, 0, 0.5); /* Adjust placeholder text color */
}

.terms-conditions {
    margin-top: 15px;
}

#btnLogin {
    width: 100%;
    height: 40px; /* Adjust height */
}
    </style>
</head>

<body class="form">
    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1>Silahkan Login</h1>
                        <h5>Sistem Persediaan Stok Bahan Baku</h5>
                        <form class="text-left">
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="txt_username" name="username" type="text" class="form-control" placeholder="Username">
                                </div>
                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="txt_password" name="password" type="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button onclick="check_login();" type="button" id="btnLogin" class="btn btn-primary" value="Log In">Log In</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="terms-conditions">© 2024 All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/authentication/form-1.js"></script>
</body>

</html>

<script type="text/javascript">
    function check_login() {
        var username = $('#txt_username').val();
        var password = $('#txt_password').val();
        var url_login = 'proccess/login_proccess.php';
        var url_admin = './';
        $('#btnLogin').attr('value', 'Memproses ...');

        $.ajax({
            url: url_login,
            data: { var_usn: username, var_pwd: password },
            type: 'POST',
            dataType: 'html',
            success: function(response) {
                if (response === 'ok') {
                    window.location = url_admin;
                } else {
                    alert(response);
                    $('#btnLogin').attr('value', 'Coba Lagi ...');
                }
            },
            error: function() {
                alert('Error in the AJAX request');
                $('#btnLogin').attr('value', 'Coba Lagi ...');
            }
        });
    }
</script>
