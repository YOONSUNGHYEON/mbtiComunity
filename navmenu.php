<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="index.php">MBTI</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
			data-bs-target="#navbarColor03" aria-controls="navbarColor03"
			aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor03">
			<ul class="navbar-nav me-auto">
				<li class="nav-item"><a class="nav-link active" href="#">Home <span
						class="visually-hidden">(current)</span>
				</a></li>
				<li class="nav-item"><a class="nav-link" href="#">Features</a></li>
				<li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
				<li class="nav-item"><a class="nav-link" href="#">About</a></li>
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					data-bs-toggle="dropdown" href="#" role="button"
					aria-haspopup="true" aria-expanded="false">Dropdown</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="#">Action</a> <a
							class="dropdown-item" href="#">Another action</a> <a
							class="dropdown-item" href="#">Something else here</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Separated link</a>
					</div></li>
			</ul>
			<form class="d-flex">
				<input class="form-control me-sm-2" type="text" placeholder="Search">
				<button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
			</form>
			<div class="btn-group" role="group"
				aria-label="Button group with nested dropdown">
				<button type="button" class="btn btn-primary">Primary</button>
				<div class="btn-group" role="group">
					<button id="btnGroupDrop1" type="button"
						class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false"></button>
					<div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
						<a class="dropdown-item" href="#">Dropdown link</a> <a
							class="dropdown-item" href="#">Dropdown link</a>
					</div>
				</div>
			</div>
      
      <?php
    // Generate the navigation menu
    echo '<hr />';
    if (isset($_SESSION['user_id'])) {
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