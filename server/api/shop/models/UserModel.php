<?php
class UserModel
{
	protected $DB;
	public function __construct()
	{
		$this -> DB = DataBase::getInstance();
	}
	public function registerUser($arr)
	{
		try
		{
			$arr = array($arr['name'], $arr['email'], $arr['pass'],
						$arr['token']);
			$this -> DB -> INSERT(" users ") -> keys(" name, email, pass,
			token ") -> values( " ?, ?, ?, ? " ) -> insertUpdate($arr);
			return true;
		}
		catch( Exception $e)
		{
			return $e->getMessage();
		}
	}
}
?>