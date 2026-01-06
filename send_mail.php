<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if ( empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        // jeśli coś jest nie tak, przekieruj z powrotem
        header("Location: kontakt.html?error=invalid");
        exit;
    }

    $to = "kontakt.prostekorki@gmail.com";
    $subject = "Nowa wiadomość od $name";
    $body = "Imię: $name\nEmail: $email\n\nWiadomość:\n$message";
    $headers = "From: $email\r\nReply-To: $email";

    if (mail($to, $subject, $body, $headers)) {
        header("Location: kontakt.html?success=1");
    } else {
        header("Location: kontakt.html?error=sendfail");
    }
    exit;
} else {
    // jeśli ktoś wchodzi bezpośrednio na PHP
    header("Location: kontakt.html");
    exit;
}
?>
