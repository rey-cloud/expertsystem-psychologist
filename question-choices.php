
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$questions = array(
    "Question 1" => array("I do not feel sad.", "I feel sad", "I am sad all the time and I can't snap out of it.", "I am so sad and unhappy that I can't stand it."),
    "Question 2" => array("I am not particularly discouraged about the future.", "I feel discouraged about the future.", "I feel I have nothing to look forward to.", "I feel the future is hopeless and that things cannot improve."),
    "Question 3" => array("I do not feel like a failure.", "I feel I have failed more than the average person.", "As I look back on my life, all I can see is a lot of failures.", "I feel I am a complete failure as a person."),
    "Question 4" => array("I get as much satisfaction out of things as I used to.", "I don't enjoy things the way I used to.", "I don't get real satisfaction out of anything anymore.", "I am dissatisfied or bored with everything."),
    "Question 5" => array("I don't feel particularly guilty", "I feel guilty a good part of the time.", "I feel quite guilty most of the time.", "I feel guilty all of the time."),
    "Question 6" => array("I don't feel I am being punished.", "I feel I may be punished.", "I expect to be punished.", "I feel I am being punished."),
    "Question 7" => array("I don't feel disappointed in myself.", "I am disappointed in myself.", "I am disgusted with myself.", "I hate myself."),
    "Question 8" => array("I don't feel I am any worse than anybody else.", "I am critical of myself for my weaknesses or mistakes.", "I blame myself all the time for my faults.", "I blame myself for everything bad that happens."),
    "Question 9" => array("I don't have any thoughts of killing myself.", "I have thoughts of killing myself, but I would not carry them out.", "I would like to kill myself.", "I would kill myself if I had the chance."),
    "Question 10" => array("I don't cry any more than usual.", "I cry more now than I used to.", "I cry all the time now.", "I used to be able to cry, but now I can't cry even though I want to."),
    "Question 11" => array("I am no more irritated by things than I ever was.", "I am slightly more irritated now than usual.", "I am quite annoyed or irritated a good deal of the time.", "I feel irritated all the time."),
    "Question 12" => array("I have not lost interest in other people.", "I am less interested in other people than I used to be.", "I have lost most of my interest in other people.", "I have lost all of my interest in other people."),
    "Question 13" => array("I make decisions about as well as I ever could.", "I put off making decisions more than I used to.", "I have greater difficulty in making decisions more than I used to.", "I can't make decisions at all anymore."),
    "Question 14" => array("I don't feel that I look any worse than I used to.", "I am worried that I am looking old or unattractive.", "I feel there are permanent changes in my appearance that make me look unattractive", "I believe that I look ugly."),
    "Question 15" => array("I can work about as well as before.", "It takes an extra effort to get started at doing something.", "I have to push myself very hard to do anything.", "I can't do any work at all."),
    "Question 16" => array("I can sleep as well as usual.", "I don't sleep as well as I used to.", "I wake up 1-2 hours earlier than usual and find it hard to get back to sleep.", "I wake up several hours earlier than I used to and cannot get back to sleep."),
    "Question 17" => array("I don't get more tired than usual.", "I get tired more easily than I used to.", "I get tired from doing almost anything.", "I am too tired to do anything."),
    "Question 18" => array("My appetite is no worse than usual.", "My appetite is not as good as it used to be.", "My appetite is much worse now.", "I have no appetite at all anymore."),
    "Question 19" => array("I haven't lost much weight, if any, lately.", "I have lost more than five pounds.", "I have lost more than ten pounds.", "I have lost more than fifteen pounds."),
    "Question 20" => array("I am no more worried about my health than usual.", "I am worried about physical problems like aches, pains, upset stomach, or constipation.", "I am very worried about physical problems and it's hard to think of much else.", "I am so worried about my physical problems that I cannot think of anything else."),
    "Question 21" => array("I have not noticed any recent change in my interest in sex.", "I am less interested in sex than I used to be.", "I have almost no interest in sex.", "I have lost interest in sex completely."),
);

$question_number = isset($question_number) ? $question_number : 0;
?>

<!-- HTML Form -->
<h3>Questionnaire</h3>
<form action="answers.php" method="post">
    <input type="hidden" name="question_number" value="<?php echo $question_number; ?>">
    <h4>Question <?php echo $question_number + 1; ?></h4>
    <?php
    foreach ($questions["Question " . ($question_number + 1)] as $index => $option) {
        $checked = (isset($_SESSION['answers'][$question_number]) && $index == $_SESSION['answers'][$question_number]) ? "checked" : "";
        echo "<div><input type='radio' name='answer' value='$index' $checked>$option</div>";
    }
    ?>
    <?php if ($question_number > 0) { ?>
        <button type="submit" name="previous">Previous</button>
    <?php } ?>
    <?php if ($question_number < count($questions) - 1) { ?>
        <button type="submit" name="next">Next</button>
    <?php } else { ?>
        <button type="submit" name="submit">Submit</button>
    <?php } ?>
</form>


</body>
</html>