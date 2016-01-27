<?php
namespace User;
require_once 'db_connect.php';
use DataBase\Connect as connect;

$cnn = new connect('Sup');

/**
* Клас для роботи з користувачами
*/
class User
{
	protected $email;
	protected $pass;
	
	/**
	 * [__construct для створення користувача]
	 * @param [String] $email [мило користувача]
	 * @param [String] $pass  [пароль користувача]
	 */
	private function __construct($email, $pass)
	{
		$this->email = $email;
		$this->pass = $pass;
	}

/**
 * [userVerefication перевірка користувача]
 * @return [boolean] [true якщо користувач існує, false якщо користувача не має в базі даних]
 */
	public function userVerefication()
	{

	}

	public function userFirstSteapAdding()
	{
	}

	public function userSecondSteapAdding()
	{

	}
}
?>