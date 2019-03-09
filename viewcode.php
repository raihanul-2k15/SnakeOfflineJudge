<?php
    $current_page=3;
    include("includes/arrays.php");
    include("includes/functions.php");
    
?>
<?php 
    include("includes/header.php");
    include("includes/nav.php");
?>

<div class="main-content">
	<p>Only teachers can view submitted codes. Go to the <a href="teacher.php">Teacher</a> page</p>
	<?php 
	if (isset($_GET['roll']) && isset($_GET['id']) && isset($_GET['verdict'])) {
	       $roll = $_GET['roll'];
	       $id = $_GET['id'];
	       $verdict = $_GET['verdict'];
	       echo "<div class=\"scrollable\">";
	       echoCode($roll, $id, $verdict, $CODES);
	       echo "</div>";
	   }
	?>
</div> <!-- main-content -->

<?php 
    include("includes/footer.php");

?>