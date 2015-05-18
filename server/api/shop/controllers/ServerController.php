<?php  
class ServerController
{
	protected $model, $encode, $view, $valid, $userModel;
	public function __construct()
	{
		$this -> model = new ServerModel();
		$this -> encode = EncoderModel::getInstance();
		$this -> view = new ServerView();
		$this -> valid = new ValidatorsModel();
		$this -> userModel = new UserModel();
	}

	public function infoAction()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		switch($method)
		{
			case 'GET':
			$this -> getInfo();
			break;
			case 'POST':
			$this -> postInfo();
			break;
			case 'PUT':
			$this -> putInfo();
			break;
			case 'DELETE':
			$this -> deleteInfo();
			break;
		}
	}
	public function orderAction()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		switch($method)
		{
			case 'GET':
			$this -> getOrders();
			break;
			case 'POST':
			$this -> postOrder();
			break;
		}
	}
	public function postOrder()
	{
		$arr = array();
		foreach($_POST as $key => $val)
		{
			$arr[$key] = $this -> valid -> FilterFormValues($val);
		}
		if(true == $this -> userModel -> checkLogin($arr['hash']))
		{
			$result = $this -> model -> saveOrder($arr);
			$this -> view -> returns($result);
		}
		else
		{
			$this -> view -> returns(false);
		}
	}
	public function getOrders()
	{
		$data = $this -> model -> getOrders();
		$this -> view -> returns($this -> encode -> encode(ENCODE, $data));
	}
	public function getDataAction()
	{
		$data = $this -> model -> getData();
		$this -> view -> returns($this -> encode -> encode(ENCODE, $data));
	}
	public function searchAction()
	{
		$arr = array();
		foreach($_POST as $key => $val)
		{
			$arr[$key] = $this -> valid -> FilterFormValues($val);
		}
		$res = $this -> model -> search($arr);
		$this -> view -> returns($this -> encode -> encode(ENCODE, $res));
	}
	public function loginAction()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		switch($method)
		{
			case 'GET':
			$this -> getLogin();
			break;
			case 'PUT':
			$this -> putLogin();
			break;
			case 'DELETE':
			$this -> deleteLogin();
			break;
		}
  }
}   
?> 
