<?php

namespace Helper;

class Account
{
	function __construct()
	{
		$this->DB = new Database();
	}
	function SetSession($username, $password)
	{
	}

	function SignIN($username, $password)
	{
		if (!$this->DB->confirm('id', 'users', ['username' => $username]))
			return ["Username doesn't exist in our database.", "username"];

		if (!$this->DB->confirm('id', 'users', ['username' => $username, 'password' => $password]))
			return ["Wrong username or password.", 'password'];

		return TRUE;
	}
	function SignUP($username, $password, $email, $sponsor)
	{

		$sponsor = $this->DB->confirm('id', 'users', ['username' => $sponsor]) ?? 1;

		if ($this->DB->confirm('id', 'users', ['username' => $username]))
			return ['Someone already use this username, try different one!', 'username'];
		if ($this->DB->confirm('id', 'users', ['email' => $email]))
			return ['Someone already use this email address, try different one!', 'email'];

		$this->DB->query('INSERT INTO users (username, email, password, sponsor) VALUES ("' . $username . '","' . $email . '","' . $password . '","' . $sponsor . '")');

		return TRUE;
	}
	function RecoveryPassword($email, $type = 1)
	{
	}
	function ConfirmRecovery($email, $code)
	{
	}


	//
	function ResetPassword($email, $code, $password)
	{
	}
}
