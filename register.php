
<?php
// Insert the page header
$page_title = 'Sign Up';
require_once ('header.php');

require_once ('appvars.php');
require_once ('connectvars.php');

require_once ('navmenu.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
    
    $option = isset($_POST['mbtiOption']) ? $_POST['mbtiOption'] : false;

    if(!isset($_POST['mbtiOption'])  || empty($username) || empty($password1) || empty($password2))
    {
        echo '<div class="alert alert-dismissible alert-danger">';
        echo '<strong>모든 데이터를 입력해주세요!</strong>';
        echo '</div>';
    }
    else if($password1 != $password2)
    {
        echo '<div class="alert alert-dismissible alert-danger">';
        echo '<strong>비밀번호가 같지 않습니다.</strong>';
        echo '</div>';
    }
    else
    {
        $query = "SELECT * FROM tMemberList WHERE sName = '$username'";
        $data = mysqli_query($dbc, $query);
        if (mysqli_num_rows($data) == 0) {
            $query = "INSERT INTO tMemberList (sName, sPassword, dtJoinDate, nMbtiSeq ) VALUES ('$username', SHA('$password1'), NOW(), '$option')";
            mysqli_query($dbc, $query);
            
            echo '<div class="alert alert-dismissible alert-success">';
            echo '<strong>회원가입 성공!</strong> 바로 <a href="login.php" class="alert-link">로그인 하러가기</a>.';
            echo '</div>';
            $username = "";
        }
        else {
            echo '<div class="alert alert-dismissible alert-danger">';
            echo '<strong>중복된 아이디입니다.</strong>';
            echo '</div>';
            $username = "";
        }
    }
 
}
$query = "SELECT * FROM tMbtiOption";
$data = mysqli_query($dbc, $query);
$responses = array();
while ($row = mysqli_fetch_array($data)) {
    array_push($responses, $row);
}
mysqli_close($dbc);

?>

<div id="main-wrapper" class="content">
	<h1>회원가입</h1>
	<div id="content-wrapper" class="">
		<form method="post" action= <?php  $_SERVER['PHP_SELF'] ?>>
			<fieldset>
				<div class="form-group">
					<label for="exampleInputEmail1" class="form-label mt-4">Username </label>
					<input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" class="form-control"
						aria-describedby="emailHelp" placeholder="Enter id"> <small
						id="emailHelp" class="form-text text-muted">We'll never share your
						email with anyone else.</small>

				</div>
				<div class="form-group">
					<label for="exampleInputPassword1" class="form-label mt-4">Password</label>
					<input type="password" id="password1" name="password1"
						class="form-control" placeholder="Password">

				</div>
				<div class="form-group">
					<label for="exampleInputPassword2" class="form-label mt-4">Password (retype)</label>
					<input type="password" id="password2" name="password2"
						class="form-control" placeholder="Password">

				</div>
				<div class="form-group">
					<label for="exampleSelect1" class="form-label mt-4">Example select</label>
					<select class="form-select" id="exampleSelect1" name="mbtiOption">
					<?php
                    foreach ($responses as $response) {
                        echo '<option id="' . $response['nSeq'] . '" name="' . $response['nSeq'] . '" value="' . $response['nSeq'] . '">' .$response['sName'] . '</option>';
                    }
                    ?>
					</select>
				</div>

				<button type="submit" value="Sign Up" name="submit"
					class="register-btn btn btn-primary">Submit</button>
			</fieldset>
		</form>
	</div>
</div>

<?php
require_once ('footer.php');
