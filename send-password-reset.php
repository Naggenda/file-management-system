<?php

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expirery = date("Y-m-d H:i:s",time() + 60 * 10);

require "database.php";

$sql = "UPDATE accounts
SET token = ?,
expirery = ?
WHERE email = ?";

$stmt = $con->prepare($sql);

$stmt -> bind_param("sss", $token_hash, $expirery, $email);

$stmt -> execute();

if($con -> affected_rows){

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("naggendajoshua@gmail.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="http://localhost/reset-password.php?token=$token">here</a>
    to reset your password.

    END;

    try{
    $mail->send();
} catch (Exception $e) {
    echo "message could not be sent, Mailer error: {$mail->ErrorInfo}";
}

}