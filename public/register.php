<?php
  require_once('../private/initialize.php');

	$first_name = ucwords(h($_POST['first_name'] ?? ''));
	$last_name = ucwords(h($_POST['last_name'] ?? ''));
	$email = strtolower(h($_POST['email'] ?? ''));
	$username = strtolower(h($_POST['username'] ?? ''));
	$errors = array();

	if (is_post_request()) {
		if (is_blank($first_name))
			array_push($errors, "First name cannot be blank");
		elseif (!has_length($first_name, ['min' => 2, 'max' => 255]))
			array_push($errors, "First name must be between 2 and 255 characters"); 
		elseif (!has_valid_name_format($first_name))
			array_push($errors, "First name must be a valid format. (letters, spaces, symbols: - , . ' )");

		if (is_blank($last_name))
			array_push($errors, "Last name cannot be blank");
		elseif (!has_length($last_name, ['min' => 2, 'max' => 255]))
			array_push($errors, "Last name must be between 2 and 255 characters"); 
		elseif (!has_valid_name_format($last_name))
			array_push($errors, "Last name must be a valid format. (letters, spaces, symbols: - , . ' )");

		if (is_blank($email))
			array_push($errors, "Email cannot be blank");
		elseif (!has_length($email, ['max' => 255]))
			array_push($errors, "Email must be no longer than 255 characters"); 
		elseif (!has_valid_email_format($email))
			array_push($errors, "Email must be a valid format. (letters, numbers, symbols: _ @ )");

		if (is_blank($username))
			array_push($errors, "Username cannot be blank");
		elseif (!has_length($username, ['min' => 8, 'max' => 255]))
			array_push($errors, "Username must be between 8 and 255 characters"); 
		elseif (!has_valid_username_format($username))
			array_push($errors, "Username must be a valid format. (letters, numbers, symbols: _ )");
		elseif (!is_unique_username($username))
			array_push($errors, "Username exists already.");

		if (empty($errors)) {
			$date = date('Y-m-d H:i:s');
      $sql = "INSERT INTO `globitek`.`users` ";
			$sql .= "(`first_name`, `last_name`, `email`, `username`, `created_at`) ";
			$sql .= "VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$username."', '".$date."')";
			$sql = db_escape($db, $sql);
      $result = db_query($db, $sql);
      if($result) {
        db_close($db);
				redirect_to(raw_u("registration_success.php"));
      } else {
        echo db_error($db);
        db_close($db);
        exit;
      }
		}
	}

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content" class="container">
	<div class="row">
		<div class="col s6 offset-s3">
			<div class="text-center header-shadow overlay bg-crimson white col s10 offset-s1">
				<h3>Register</h3>
				<p>Register to become a Globitek Partner.</p>
			</div>
			<div class="row bg-white body-shadow">
				<?php echo display_errors($errors); ?>
				<form class="col s12 form-control" method="post" action="register.php">
					<div class="row">
						<div class="input-field col s6">
							<i class="material-icons prefix">account_circle</i>
							<input id="icon_first_name" name="first_name" type="text" value="<?php echo $first_name;?>">
							<label for="icon_first_name">First Name</label>
						</div>
						<div class="input-field col s6">
							<i class="material-icons prefix">account_circle</i>
							<input id="icon_last_name" name="last_name" type="text" value="<?php echo $last_name;?>">
							<label for="icon_last_name">Last Name</label>
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">email</i>
							<input id="icon_email" name="email" type="text" value="<?php echo $email;?>">
							<label for="icon_email">Email</label>
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">fingerprint</i>
							<input id="icon_username" name="username" type="text" value="<?php echo $username;?>">
							<label for="icon_username">Username</label>
						</div>
						<div class="text-center input-field col s12">
							<button class="btn bg-crimson waves-effect waves-light" type="submit" name="action">Submit
								<i class="material-icons right">send</i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
