<?php
    $current_page=0;
    include("includes/arrays.php");
    
?>
<?php 
    include("includes/header.php");
    include("includes/nav.php");
?>

		
<div class="main-content">
	<?php 
	   echo "<h2 class=\"section-title\">Problem</h2>";
	   $lines = file ($JUDGE . "problem.txt");
	   echo "<p>";
	   foreach($lines as $line)
	       echo $line."<br>";
	   echo "</p>";
	
	   echo "<h2 class=\"section-title\">Sample Input</h2>";
	   $lines = file ($JUDGE . "sample_input.txt");
	   echo "<p>";
	   foreach($lines as $line)
	       echo $line."<br>";
	       echo "</p>";
	
	   echo "<h2 class=\"section-title\">Sample Output</h2>";
	   $lines = file ($JUDGE . "sample_output.txt");
	   echo "<p>";
	   foreach($lines as $line)
	       echo $line."<br>";
	       echo "</p>";
	?>
</div> <!-- main-content -->

<div class="main-content">
	<h2 class="section-title">Submit code</h2>
	<form method="post" action="home.php" onsubmit="return validateCode() && validateRoll();">
		<label for="roll">Roll: </label>
		<input type="text" id="roll" name="roll"><br>
		<label for="code">C++ code:</label><br>
		<textarea id="code" name="code" rows="35"></textarea><br>
		<input id="submit-btn" type="submit" value="Submit code" name="submit">
	</form>
	
	<?php 
    if (isset($_POST["submit"])) {
        $id = time();
        $dateAndTime = date("y/m/d h:i:s a");
        $roll = intval($_POST['roll']);
        $code = trim($_POST['code']);
        $fp = fopen($JUDGE."under_judgement.cpp","w");
        fwrite($fp,$code);
        fclose($fp);
        
        // save code in right folder (by roll)
        if (!file_exists("$CODES"."$roll")) {
            mkdir("$CODES"."$roll",0700);
        }
        $fp = fopen($CODES.$roll."/$id.cpp","w");
        fwrite($fp,$code);
        fclose($fp);
        
        // try compile
        $execStr = "g++ -w -o $JUDGE"."under_judgement $JUDGE"."under_judgement.cpp 2> $JUDGE"."log.txt";
        `$execStr`;
        
        // check for compile error
        $fp = fopen($JUDGE."log.txt","r");
        $line = fgets($fp);
        fclose($fp);
        if ($line !== false) {
            // compilation error
            $fp = fopen("$SUBMISSIONS$roll.txt","a");
            fwrite($fp, "$id $dateAndTime Compile_Error"."\r\n");
            fclose($fp);
            echo "<br><span style=\"color:red\">Compilation Error. Check code carefully and submit again!</span>";
        } else {
            // compilation finished. try to run
            $execStr = "run.bat";
            `$execStr`;
            
            // assume accepted and check for TLE
            $verdict = "accepted";
            $fp = fopen($JUDGE."tle.txt","r");
            $line = fgets($fp);
            if ($line !== false) {
                $verdict = "time";
            } else {
                $cor_out = fopen($JUDGE."main_output.txt","r");
                $test_out = fopen($JUDGE."test_output.txt","r");
                while (($cor_line = fgets($cor_out)) !== false) {
                    $test_line = fgets($test_out);
                    if ($test_line !== $cor_line) {
                        $verdict = "wrong";
                        break;
                    }
                }
            }
            
            // write verdict to submissions
            $fp = fopen("$SUBMISSIONS$roll.txt","a");
            if ($verdict === "accepted") {
                $verdictText = "Accepted";
                fwrite($fp, "$id $dateAndTime $verdictText"."\r\n");
            } else if ($verdict === "wrong") {
                $verdictText = "Wrong_Answer";
                fwrite($fp, "$id $dateAndTime $verdictText"."\r\n");
            } else if ($verdict === "time") {
                $verdictText = "Time_Limit";
                fwrite($fp, "$id $dateAndTime $verdictText"."\r\n");
            }
            fclose($fp);
            
            echo "<br>Test complete. Result: <span class=\"$verdict\">$verdictText</span> <a href=\"submissions.php?roll=$roll&submit=Get+Submissions\">Check your submissions here</a>";
        }
    }

?>
	
</div>

<?php 
    include("includes/footer.php");
?>