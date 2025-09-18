<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM user WHERE reset_token_hash = ?";

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($account === null) {
    die("token not found");
}

if (strtotime($user["expirery"]) <= time()) {
    die("token has expired");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>

<body>
    <div class="login">
        <h1>Reset Password</h1>

        <form method="post" action="process-reset-password.php" class="form login-form">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <label class="form-label" for="password">New Password</label>
            <div class="form-group">
                <svg class="form-icon-left" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z" />
                </svg>
                <input class="form-input" type="password" name="password" placeholder="Password" id="password" required>
            </div>

            <label for="password_confimation">Repeat Password</label>
            <div class="form-group mar-bot-5">
                <svg class="form-icon-left" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z" />
                </svg>
                <input class="form-input" type="password" name="password_confirmation" placeholder="Password"
                    id="password_confirmation" required>
            </div>


            <button class="btn blue">Send</button>

        </form>
    </div>
</body>

</html>