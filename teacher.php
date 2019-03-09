<?php
    $current_page=2;
    include("includes/arrays.php");
    
?>
<?php 
    include("includes/header.php");
    include("includes/nav.php");
?>

<div class="main-content">
	<p>This section is for teachers to view all students' submissions in one place. Teachers can also compare two students' codes to check if they match.</p>
	<form method="get" action="teacher.php">
		<label>Password: </label>
		<input type="text" name="password">
		<input type="submit" id="submit-btn" name="submit" value="Show">
	</form>
	
	<?php 
	   if (isset($_GET['submit'])) {
	       $fp = fopen("data/teacher_pass.txt","r");
	       $realPass = fgets($fp);
	       fclose($fp);
	       if ($realPass == $_GET['password']) {
	           /*
	       }
	           echo "<p>Note: Only the last Accepted submission of each student is shown.<br>
                    Click on a roll number to view all submissions of that student.<br>
                    Click on a submission ID to view that code.<br>
                    Select two submission IDs and click Compare Codes to compare them.</p>";
	           */
	           
	           echo "<h5>Notes</h5><ul><li>Only the last Accepted submission of each student is shown.</li>
                    <li>Click on a roll number to view all submissions of that student.</li>
                    <li>Click on a submission ID to view that code.</li>
                    <li>Select two submission IDs and click Compare Codes to compare them.</li></ul>";
	           echo "Best submissions of all students: <br>";
	           echo "<table><tr><th>Roll</th><th>Submission ID</th><th>Time</th><th>Verdict</th><tr>";
	           $files = scandir($SUBMISSIONS);
	           $n = count($files) - 2;
	           $i=0;
	           foreach($files as $file) {
	               if ($file === "." || $file === "..") continue;
	               $best = "Nothing";
	               $fp = fopen($SUBMISSIONS.$file,"r");
	               while (($line = fgets($fp)) !== false) {
	                   $last = $line;
	                   $info = explode(" ", $line);
	                   if ($info[count($info)-1][0]=="A") $best = $info;
	               }
	               fclose($fp);
	               if ($best === "Nothing") $best = explode(" ", $last);
	               $file = substr($file, 0, count($file)-5);
	               $rollLink = "<a href=\"teacher.php?password=".$_GET['password']."&submit=Show&roll=$file\">$file</a>";
	               $id = $best[0];
	               $verdict = $best[4];
	               $idLink = "<input type=\"checkbox\" id=\"chk$i\" value=\"$file $id $verdict\" onchange=\"validateBoxes(this)\">";
	               $i++;
	               $idLink .= "<a href=\"viewcode.php?roll=$file&verdict=$verdict"."&id=$id\">$id</a>";
	               $dateAndTime = $best[1]." ".$best[2]." ".$best[3];
	               if ($verdict[0]=="A") {
	                   echo "<tr class=\"accepted\"><td>$rollLink</td><td>$idLink</td><td>$dateAndTime</td><td>$verdict</td></tr>";
	               } else if ($verdict[0]=="W") {
	                   echo "<tr class=\"wrong\"><td>$rollLink</td><td>$idLink</td><td>$dateAndTime</td><td>$verdict</td></tr>";
	               } else if ($verdict[0]=="C") {
	                   echo "<tr class=\"compile\"><td>$rollLink</td><td>$idLink</td><td>$dateAndTime</td><td>$verdict</td></tr>";
	               } else if ($verdict[0]=="T") {
	                   echo "<tr class=\"time\"><td>$rollLink</td><td>$idLink</td><td>$dateAndTime</td><td>$verdict</td></tr>";
	               }
	           }
	           echo "</table>";
	           echo "<br><button id=\"compare-btn\" onclick=\"compareCodes()\">Compare codes</button>";
	           
	           // show single student's submissions if requested
	           if (isset($_GET['roll'])) {
	               $roll = $_GET['roll'];
	               $fp = fopen($SUBMISSIONS . $roll . ".txt", "r");
	               if (!$fp) {
	                   echo "<p>Sorry, the submissions with roll $roll could not be found. Make sure it is correct</p>";
	               } else {
	                   $sub_data = array();
	                   while (($line=fgets($fp))!==false) {
	                       $info = explode(" ", $line);
	                       array_unshift($sub_data, $info);
	                   }
	                   fclose($fp);
	                   echo "<p>All submissions of roll $roll</p>";
	                   echo "<table><tr><th>Submission ID</th><th>Time</th><th>Verdict</th><tr>";
	                   foreach ($sub_data as $info) {
	                       $verdict = $info[4];
	                       $idLink = "<a href=\"viewcode.php?roll=$roll&id=$info[0]&verdict=$verdict\">$info[0]</a>";
	                       $dateAndTime = $info[1]." ".$info[2]." ".$info[3];
	                       if ($verdict[0]=="A") {
	                           echo "<tr class=\"accepted\"><td>$idLink</td><td>$dateAndTime</td><td>$verdict</td></tr>";
	                       } else if ($verdict[0]=="W"){
	                           echo "<tr class=\"wrong\"><td>$idLink</td><td>$dateAndTime</td><td>$verdict</td></tr>";
	                       } else if ($verdict[0]=="C") {
	                           echo "<tr class=\"compile\"><td>$idLink</td><td>$dateAndTime</td><td>$verdict</td></tr>";
	                       } else if ($verdict[0]=="T") {
	                           echo "<tr class=\"time\"><td>$idLink</td><td>$dateAndTime</td><td>$verdict</td></tr>";
	                       }
	                   }
	                   echo "</table>";
	               }
	           }
	       } else {
	           echo "<span style=\"color:red\">Password Incorrect!</span>";
	       }
	   }
	?>
</div> <!-- main-content -->

<?php 
    include("includes/footer.php");

?>