<?php 

if (isset($_POST['yes'])) {
    header("Location: question-choices.php");
    exit(); 
}
if (isset($_POST['no'])) {
    header("Location: new-acc.php");
    exit();
}
?>