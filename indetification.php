<?php
require_once 'db_connect.php';

use DataBase\Connect as connect;

$cnn = new connect('Sup');

if(isset($_POST['reqest']) && isset($_POST['type'])) {
	switch($_POST['type']) {
		case 'signin':
			$user_data = $cnn->getRowTable('user', 'email='.$_POST['email']);
			if(!$user_data) {
				echo '{"s":"un`correct user"}';
			} else {
				if($user_data['password'] == $_POST['password']) {
					echo '{"s":"good", "user":"'.$user_data['id_user'].'"}';
				} else {
					echo '{"s":"un`correct password'};
				}
			}
			break;
		case 'signup':
			$values = array($_POST['password'], $_POST['email']);
			break;
	}
}
?>