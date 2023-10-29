<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        session_start();
        if (isset($_POST['pass'])) {
            $pin = $_POST['pass'];
            if (empty($pin)) {
                header("Location: new-acc.php?error=PIN is required.");
            } elseif (strlen($pin) < 4) {
                header("Location: new-acc.php?error=Password should be exactly 4 digits and contain only numbers.");
            } elseif (strlen($pin) > 4 || !ctype_digit($pin)) {
                header("Location: new-acc.php?error=Password should be exactly 4 digits and contain only numbers.");
            } else {
                $f_name = $_POST['f_name'];
                $l_name = $_POST['l_name'];
                $_SESSION['first'] = $f_name;
                $_SESSION['last'] = $l_name;
                $_SESSION['pass-pin'] = $pin; // Storing the pin in session
                header("Location: proceed-to-q.php");
            }
        }
        if (isset($_POST['cancel'])) {
            header("Location: login-page.php");
        }
    ?>

</body>
</html>
