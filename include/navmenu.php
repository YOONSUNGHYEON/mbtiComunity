<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="index.php">MBTI</a>
		
			
      
      <?php
    // Generate the navigation menu
    echo '<hr />';
    if (isset($_SESSION['userId'])) {
        echo '<a href="logout.php">Log out</a> &#10084; ';
    } else {
        echo '<a href="login.php">Log In</a> &#10084; ';
        echo '<a href="register.php">Sign Up</a>';
    }
    echo '<hr />';
    ?>
      
    </div>
	</div>
</nav>