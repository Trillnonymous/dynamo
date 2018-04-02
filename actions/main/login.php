<?php
	$username = isset($_POST['username']) ? $_POST['username'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	$data = array();
	
	if ($username !== '' && $password !== ''){
		$sql = mysql_query("SELECT * FROM `users` WHERE username='$username' AND password='$password'");
		$rows = mysql_num_rows($sql);
		if ($rows === 0){
			$data['error'] = 'You have either entered the wrong password or the wrong username.';
			$data['errorcode'] = 21;
		} else {
			$check = mysql_query("SELECT * FROM `ban_list` WHERE username='$username' AND password='$password'");
			$c_rows = mysql_num_rows($check);
			if ($c_rows === 0){
				$set = mysql_query("UPDATE `users` SET status='1' WHERE username='$username'");
				setcookie('username', $username, time()+(60*60*24*180));
				header('Location: ./index.html');
			} else {
				$duration = isset($check['duration']) ? $check['duration'] : null;
				$reason = isset($check['reason']) ? $check['reason'] : 'Violating the Terms of Use.';
				$message = (isset($duration) || !is_null($duration)) ? 'You have been banned from Dynamo for ' . $duration : 'You have been permanently banned from Dynamo';
				$data['error'] = $message . '. Reason: ' . $reason;
				$data['errorcode'] = 23;
			}
		}
	}
	echo json_decode($data);
?>
