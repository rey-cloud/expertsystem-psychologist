<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
</head>
<body>
  <div>
    <form action="">
        <button>Back</button>
    </form>
	<?php
    
    require ('single-result.php');
    while ($row = $result->fetch_assoc()) {
    ?>

    <div>
        <p>Name: <?php echo $row['first_name'] . " " . $row['last_name'];?></p>
        <p>Age: <?php echo $row['age'];?></p>
        <p>email: <?php echo $row['email'];?></p>
    </div>

    <?php }
    require('user-result.php');

    // Check if the result_id is set in the URL
    if (isset($_GET['result_id'])) {
        $result_id = $_GET['result_id'];

        // Display the result based on the result_id
        if (array_key_exists($result_id - 1, $resultsArray)) {
            $result = $resultsArray[$result_id - 1];
            echo "<div style='border: 2px solid black;'>";
            echo "<p>Result ID: " . $result['result_id'] . "</p>";
            echo "<p>Result: " . $result['result'] . "</p>";
            $result1 = $result['result'];
            include("result-decision.php"); 
            echo "<p>Diagnosis: " . $diagnose . "</p>" ;
            echo "<p>Recommendation: " . $reco . "</p>" ;
            echo "<h4>Date Taken: " . $result['created_at'] . "</h4>";
            echo "</div>";
        } else {
            echo "pangalawa";
        }
    } else {
        // Redirect the user to the first result if no result_id is provided in the URL
        if (!empty($resultsArray)) {
            $firstResultId = 1;
            header("Location: view-results.php?result_id=$firstResultId");
            exit;
        } else {
            echo "simula pa lang";
        }
    }
    ?>
  </div>

  <div>
    <?php
        // Previous and Next buttons
        if(isset($_GET['result_id'])){
            $currentResultId = $_GET['result_id'];
            // Previous button
            if($currentResultId > 1){
                $previousResultId = $currentResultId - 1;
                echo "<a href='view-results.php?result_id=$previousResultId'>Previous</a>";
            }

            // Next button
            if($currentResultId < count($resultsArray)){
                $nextResultId = $currentResultId + 1;
                echo "<a href='view-results.php?result_id=$nextResultId'>Next</a>";
            }
        }
    ?>
  </div>

  <form action="">
      <button>Home</button>
      <button>Print</button>
      <button>Download</button>
  </form>
</body>
</html>
