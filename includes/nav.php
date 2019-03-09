
		<nav class="page-nav">
			<ul>
				<?php 
				for ($i = 0; $i < count($pages); $i++) {
				    if ($i == $current_page) {
				        echo "<li class=\"current-page\">" . $pages[$i]["title"] . "</li>";
				    } else {
				        echo "<li><a href=\"" . $pages[$i]["slug"] . ".php\">" . $pages[$i]["title"] . "</a></li>";
				    }
				}
				?>
			</ul>
		</nav>