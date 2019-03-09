<?php
    $current_page=1;
    include("includes/arrays.php");
    
?>
<?php 
    include("includes/header.php");
    include("includes/nav.php");
?>

<div class="main-content">
	<form method="get" action="submissions.php" onsubmit="return validateRoll();">
		<label>Your roll: </label>
		<input type="text" id="roll" name="roll">
		<input type="submit" value="Get Submissions" id="submit-btn" name="submit">
	</form>
	
	<?php
	if (isset($_GET['submit'])) {
	    $roll = intval($_GET['roll']);
	    if (!file_exists($SUBMISSIONS.$roll.".txt")) {
	           echo "<p>No submissions of roll $roll found. Make sure it is correct</p>";
	       } else {
	           $fp = fopen($SUBMISSIONS . $roll . ".txt", "r");
	           $sub_data = array();
	           while (($line=fgets($fp))!==false) {
	               $info = explode(" ", $line);
	               array_unshift($sub_data, $info);
	           }
	           fclose($fp);
	           echo "<p>Submissions of roll: $roll</p>";
	           echo "<table><tr><th>Submission ID</th><th>Time</th><th>Verdict</th><tr>";
	           foreach ($sub_data as $info) {
	               $id = $info[0];
	               $dateAndTime = $info[1]." ".$info[2]." ".$info[3];
	               $verdict = $info[4];
	               if ($verdict[0]=="A") {
	                   echo "<tr class=\"accepted\"><td>$id</td><td>$dateAndTime</td><td>$verdict</td></tr>";
	               } else if ($verdict[0]=="W"){
	                   echo "<tr class=\"wrong\"><td>$id</td><td>$dateAndTime</td><td>$verdict</td></tr>";
	               } else if ($verdict[0]=="C") {
	                   echo "<tr class=\"compile\"><td>$id</td><td>$dateAndTime</td><td>$verdict</td></tr>";
	               } else if ($verdict[0]=="T") {
	                   echo "<tr class=\"time\"><td>$id</td><td>$dateAndTime</td><td>$verdict</td></tr>";
	               }
	           }
	           echo "</table>";
	       }
	   }
	?>
</div> <!-- main-content -->

<?php 
    include("includes/footer.php");

?>