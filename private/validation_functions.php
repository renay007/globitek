<?php

  function is_blank($value='') {
		return !isset($value) || trim($value) == '';
  }

  function has_length($value, $options=array()) {
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  function has_valid_email_format($value) {
		$email = filter_var($value, FILTER_SANITIZE_EMAIL); 
		return  filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  function has_valid_name_format($value) {
		return  preg_match('/\A[A-Za-z\s\-,\.\']+\Z/', $value);
  }

  function has_valid_username_format($value) {
		return  preg_match('/\A[A-Za-z0-9\_]+\Z/', $value);
  }

	function is_unique_username($username) {
		global $db;
		$sql = "SELECT COUNT(*) AS `count` FROM globitek.users WHERE username='".$username."'";
		$usercount = db_query($db, $sql);
		$usercount = db_fetch_assoc($usercount);
		return $usercount['count'] == 0;
	}


?>
