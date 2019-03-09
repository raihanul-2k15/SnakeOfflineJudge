<?php
    $current_page=4;
    include("includes/arrays.php");
    include("includes/functions.php");
    
?>
<?php 
    include("includes/header.php");
    include("includes/nav.php");
?>

<div class="main-content">
	<p>Only teachers can compare submitted codes. Go to the <a href="teacher.php">Teacher</a> page</p>
</div> <!-- main-content -->

<?php 
if (isset($_GET['r1']) && isset($_GET['r2']) && isset($_GET['c1']) && isset($_GET['c2']) && isset($_GET['v1']) && isset($_GET['v2'])) {
        $r1 = $_GET['r1'];
        $r2 = $_GET['r2'];
        $c1 = $_GET['c1'];
        $c2 = $_GET['c2'];
        
        echo "<div class=\"main-content\">";
        $code1 = "";
        $code2 = "";
        $line_count1 = 0;
        $line_count2 = 0;
        $fp = fopen($CODES.$r1."/$c1.cpp", "r");
        while (($line = fgets($fp)) !== false) {
            $code1.=$line;
            $line_count1++;
        }
        fclose($fp);
        $fp = fopen($CODES.$r2."/$c2.cpp", "r");
        while (($line = fgets($fp)) !== false) {
            $code2.=$line;
            $line_count2++;
        }
        fclose($fp);
        
        $code1 = str_replace("\r\n","", $code1);
        $code2 = str_replace("\r\n","", $code2);
        
        $lcs = lcs($code1, $code2);
        $percentageMatch = 100.0 * $lcs / min(strlen($code1), strlen($code2));
        
        $percentageMatch = round($percentageMatch, 0);
        $line_count_diff = round(100 * abs($line_count1 - $line_count2) / ($line_count1 + $line_count2));
        $overall = ($percentageMatch * 0.8 + (100 - $line_count_diff) * 0.2);
        
        $spanStr = "______";
        echo "<table>";
        echo "<tr><td>Character sequence match</td><td>$percentageMatch%</td><td class=\"color-indicator\" style=\"background-color:".getThreatColor($percentageMatch, 25, 20, 75, 70)."\"></td></tr>";
        echo "<tr><td>Line count difference</td><td>$line_count_diff%</td><td class=\"color-indicator\" style=\"background-color:".getThreatColor(100 - $line_count_diff, 50, 25, 85, 70)."\"></td></tr>";
        echo "<tr><td>Overall match</td><td>$overall%</td><td class=\"color-indicator\" style=\"background-color:".getThreatColor($overall, 25, 20, 75, 70)."\"></td></tr>";
        echo "</table>";
        
        echo "</div>";
        
        echo "<div class=\"main-content\">"; // wrapper div for 2 colump layout
        
        echo "<div class=\"right scrollable\">";
        echoCode($r2, $c2, $_GET['v2'], $CODES);
        echo "</div>";
        echo "<div class=\"left scrollable\">";
        echoCode($r1, $c1, $_GET['v1'], $CODES);
        echo "</div>";
        
        echo "</div>";
    }
?>

<?php 
    include("includes/footer.php");

?>