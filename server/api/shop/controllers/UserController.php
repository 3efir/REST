<?php
class UserController
{
	protected $model, $encode, $view, $valid;
	public function __construct()
	{
		$this -> model = new UserModel();
		$this -> encode = EncoderModel::getInstance();
		$this -> view = new UserView();
		$this -> valid = new ValidatorsModel();
	}
	public function registerAction()
	{
		$arr = array();
		foreach($_POST as $key => $val)
		{
			$arr[$key] = $this -> valid -> FilterFormValues($val);
		}
		if($this -> valid -> validEmail($arr['email']) === true)
		{
			if($arr['pass'] == $arr['confPass'])
			{
				$arr['pass'] = $this -> encode -> getHashPass($arr['pass']);
				$arr['token'] = $this -> encode -> createToken($arr['email']);
				$res = $this -> model -> registerUser($arr);
				if($res === true)
				{
					$this -> view -> returns("Thanks for registration");
					return true;
				}
				else
				{
					$this -> view -> returns($res);
					return true;
				}
			}
			else
			{
				$this -> view -> returns("Passwords must match ");
				return true;
			}
		}
		else
		{
			$this -> view -> returns("not correct email");
			return true;
		}
	}
}
?>