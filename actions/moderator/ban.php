<?php
	$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
	$target = isset($_POST['target']) ? $_POST['target'] : '';
	$roomid = isset($_POST['roomid']) ? $_POST['roomid'] : '';
	$data = array();
	
	if ($username !== '' || $target == '' || $roomid == ''){
		$userstable = 'chat_' . $roomid . '_users';
		$query = mysql_query("SELECT * FROM `$userstable` WHERE username='$target'");
		$rows = mysql_num_rows($query);
		if ($rows === 0){
			$globalquery = mysql_query("SELECT * FROM `users` WHERE username='$target'");
			$g_rows = mysql_num_rows($query);
			if ($g_rows === 0){
				$data['error'] = 'The user (' . $target . ') has not been found. Please try again later.';
				$data['errorcode'] = 102;
			} else {
				$bannedusers = 'chat_' . $roomid . '_ban_list';
				$query = mysql_query("INSERT INTO `$bannedusers` (`username`) VALUES (`$target`)");
				$logtable = 'chat_' . $roomid . '_logs';
				$message = $target . ' has been banned by ' . $username . '.';
				$q = mysql_query("INSERT INTO `$logtable` (`type`, `message`) VALUES ('ban', '$message')");
				$data['user'] = $username;
				$data['target'] = $target;
				$data['message'] = $message;
			}
		} else {
			$sql = mysql_query("DELETE FROM `$userstable` WHERE username='$target'");
			$bannedusers = 'chat_' . $roomid . '_ban_list';
			$query = mysql_query("INSERT INTO `$bannedusers` (`username`) VALUES (`$target`)");
			$logtable = 'chat_' . $roomid . '_logs';
			$message = $target . ' has been banned by ' . $username . '.';
			$q = mysql_query("INSERT INTO `$logtable` (`type`, `message`) VALUES ('ban', '$message')");
			$data['user'] = $username;
			$data['target'] = $target;
			$data['message'] = $message;
		}
	}
	echo json_encode($data);
?>
