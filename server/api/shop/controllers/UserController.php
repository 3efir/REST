<?php
class UserController extends ServerController
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
	public function putLogin()
	{
		$putData = json_decode(file_get_contents('php://input')); 
		$email = $this -> valid -> FilterFormValues($putData -> test -> email);
		$pass = $this -> valid -> FilterFormValues($putData -> test -> pass);
		$result = $this -> model -> logIn($email, $pass);
		$this -> view -> returns($result);
	}
	public function getLogin()
	{
		$hash = substr($this -> valid -> FilterFormValues(FrontController::getParams()), 3);	
		$res = $this -> model -> checkLogin($hash);
		$this -> view -> returns($res);
	}
	public function deleteLogin()
	{
		$hash = substr($this -> valid -> FilterFormValues(FrontController::getParams()), 3);	
		$res = $this -> model -> LogOut($hash);
		$this -> view -> returns($res);
	}
}
?>