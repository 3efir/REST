<?php
class UserModel
{
	protected $DB, $encode;
	public function __construct()
	{
		$this -> DB = DataBase::getInstance();
		$this -> encode = EncoderModel::getInstance();
	}
	public function registerUser($arr)
	{
		try
		{
			$arr = array($arr['name'], $arr['email'], $arr['pass']);
			$this -> DB -> INSERT(" dnk_users ") -> keys(" name, email, pass") ->
			values( " ?, ?, ? " ) -> insertUpdate($arr);
			return true;
		}
		catch( Exception $e)
		{
			return $e->getMessage();
		}
	}
	public function logIn($email, $pass)
	{
		$res = $this -> DB -> SELECT("id, pass ") -> from(" dnk_users ") -> where(" 
		email = \"$email\" ") -> selected();
		if(empty($res))
		{
			return false;
		}
		$checkPass = $this -> encode -> validPass($res[0]['pass'], $pass);
		if(false == $checkPass)
		{
			return false;
		}
		$token = $this -> encode -> createToken();
		$arr = array($token);
		$this -> DB -> UPDATE(" dnk_users ") -> SET(" token ") ->
		where(" id = ".$res[0]['id']) -> insertUpdate($arr);
		return $token;
	}
	public function checkLogin($hash)
	{
		$res = $this -> DB -> SELECT(" id ") -> from(" dnk_users ") -> 
		where(" token =\"$hash\"") -> selected();
		if(empty($res))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	public function logOut($hash)
	{
		$newHash = null;
		$arr = array($newHash);
		$this -> DB -> UPDATE(" dnk_users ") -> SET(" token ") -> 
		where(" token = \"$hash\" ") -> insertUpdate($arr);
		return true;
	}
}
?>
