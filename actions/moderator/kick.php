<?php
	$username = isset($_GET['username']) ? $_GET['username'] : '';
	$target = isset($_GET['target']) ? $_GET['target'] : '';
	$roomid = isset($_GET['roomid']) ? $_GET['roomid'] : '';
	$data = array();
	
	if ($username !== '' && $target !== '' && $roomid !== ''){
		$userstable = 'chat_' . $roomid . '_users';
		$query = mysql_query("SELECT * FROM `$userstable` WHERE username='$target'");
		$rows = mysql_num_rows($query);
		if ($rows === 0){
			$data['error'] = 'Unable to kick because the user is not present in the chat';
			$data['error_code'] = 101;
		} else {
			$roomtable = 'chat_' . $roomid . '_users';
			$sql = mysql_query("DELETE FROM `$roomtable` WHERE username='$target'");
			$roomlogtable = 'chat_' . $roomid . '_logs';
			$roomlogtext = $target . ' has been kicked by ' . $username '.';
			$sql2 = mysql_query("INSERT INTO `$roomlogtable` (`type`, `message`) VALUES ('kick', '$roomlogtext')");
			$data['user'] = $username;
			$data['target'] = $target;
			$data['message'] = $roomlogtext;
		}
	}
	echo json_encode($data);
?>
