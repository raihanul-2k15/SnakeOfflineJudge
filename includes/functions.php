<?php 
    function lcs($str1, $str2) {
        $m = strlen($str1);
        $n = strlen($str2);
        $L = array();
        
        for ($j = 0; $j <= $n; $j++)
            $L[0][$j]=0;
        for ($i = 0; $i <= $m; $i++)
            $L[$i][0]=0;
        
        for ($i=1; $i<=$m; $i++)
        {
            for ($j=1; $j<=$n; $j++)
            {
                    if ($str1[$i-1] == $str2[$j-1])
                        $L[$i][$j] = $L[$i-1][$j-1] + 1;
                    else
                        $L[$i][$j] = max($L[$i-1][$j], $L[$i][$j-1]);
            }
        }
        
        return $L[$m][$n];
    }
    
    function echoCode ($roll, $id, $verdict, $CODESdir) {
        $full = "";
        $line_count=0;
        $fp = fopen ($CODESdir."$roll/$id.cpp","r");
        while (($line = fgets($fp)) !== false) {
            // html things <..> as tag, so replace them
            $line = str_replace("<","&lt",$line);
            $line = str_replace(">","&gt",$line);
            $line = str_replace("\r","",$line);
            $full.=$line;
            $line_count++;
        }
        fclose ($fp);
        echo "Code of roll: $roll<br>";
        echo "Submission ID: $id<br>";
        switch ($verdict[0]) {
            case "A":
                echo "Verdict: <span class=\"accepted\">$verdict</span><br>";
                break;
            case "W":
                echo "Verdict: <span class=\"wrong\">$verdict</span><br>";
                break;
            case "T":
                echo "Verdict: <span class=\"time\">$verdict</span><br>";
                break;
            case "C":
                echo "Verdict: <span class=\"compile\">$verdict</span><br>";
                break;
            default:
                echo "Verdict: <span>$verdict</span><br>";
        }
        echo "$line_count lines, ".strlen($full)." characters.<br>";
        echo "<div class=\"code-container\"><pre><code class=\"cpp\">";
        echo $full;
        echo "</code></pre></div>";
    }
    
    function getThreatColor($p, $x1, $y1, $x2, $y2) {
        // cubic interpolation
        $a = 0;
        $b = 0;
        $c = 0;
        __cubicInterpolCoeffs($x1, $y1, $x2, $y2, $a, $b, $c);
        $p= $a * $p*$p*$p + $b * $p*$p + $c * $p;
        
        $p = __bound($p, 0, 100);
        
        $r = __map($p, 0, 50, 0, 255);
        $g = __map($p, 50, 100, 255, 0);
        
        $r = __bound($r, 0, 255);
        $g = __bound($g, 0, 255);
        
        $r = round($r);
        $g = round($g);
        
        return "rgb($r,$g,0)";
    }
    
    function __bound($x, $min, $max) {
        if ($x < $min) return $min;
        if ($x > $max) return $max;
        return $x;
    }
    
    function __map($x, $xa, $xb, $ya, $yb) {
        return $ya + ($x - $xa) * ($yb - $ya) / ($xb - $xa);
    }
    
    function __cubicInterpolCoeffs($point_x1, $point_y1, $point_x2, $point_y2, &$x, &$y, &$z) {
        // solving 3 var linear equations
        $d = -$point_y1;
        $c = $point_x1;
        $b = $c * $point_x1;
        $a = $b * $point_x1;
        
        $k = -$point_y2;
        $n = $point_x2;
        $m = $n * $point_x2;
        $l = $m * $point_x2;
        
        $s = -100;
        $r = 100;
        $q = $r * 100;
        $p = $q * 100;
        
        $D = ($a*$m*$r+$b*$p*$n+$c*$l*$q)-($a*$n*$q+$b*$l*$r+$c*$m*$p);
        $x = (($b*$r*$k+$c*$m*$s+$d*$n*$q)-($b*$n*$s+$c*$q*$k+$d*$m*$r))/$D;
        $y = (($a*$n*$s+$c*$p*$k+$d*$l*$r)-($a*$r*$k+$c*$l*$s+$d*$n*$p))/$D;
        $z = (($a*$q*$k+$b*$l*$s+$d*$m*$p)-($a*$m*$s+$b*$p*$k+$d*$l*$q))/$D;
    }
?>