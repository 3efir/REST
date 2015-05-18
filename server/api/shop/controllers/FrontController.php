<?php
class FrontController
{
	protected $_controller, $_action;
	static $_instance, $_body, $_params, $_format;

	public static function getInstance()
	{
		if(!(self::$_instance instanceOf self))
			self::$_instance = new self();
		return self::$_instance;
	}

	private function __construct()
	{
		$request = $_SERVER['REQUEST_URI'];
		//user/get/id/1
		$splits = explode('/',trim($request,'/'));
		//Выбор контроллера
		$this->_controller = !empty($splits[4])?ucfirst($splits[4]).'Controller':'IndexController';
		//Выбор экшена
		$this->_action = !empty($splits[5])?$splits[5].'Action':'indexAction';
		if(!empty($splits[6]))
		{
			$pieces = explode(".", $splits[6]);
			self::$_params = $pieces[0];
			if(empty($pieces[1]))
			{
				self::$_format = ENCODE;
			}
			else
			{
				self::$_format = $pieces[1];
			}
		}
		else
		{
			self::$_format = ENCODE;
		}
	}
	public function route()
	{
		if(class_exists($this->getController()))
		{
			$rc = new ReflectionClass($this->getController());
			if($rc->hasMethod($this->getAction()))
			{
				$controller = $rc->newInstance();
				$method = $rc->getMethod($this->getAction());
				$method->invoke($controller);
			}
			else
			{
				self::setBody("<img src='http://hq-wallpapers.ru/wallpapers/4/hq-wallpapers_ru_computer_17752_1920x1200.jpg'/>");
			}
		}
		else
		{
			self::setBody("<img src='http://hq-wallpapers.ru/wallpapers/4/hq-wallpapers_ru_computer_17752_1920x1200.jpg'/>");
		}
	}
	public static function render($file,$replace='')
	{
		ob_start();
		$test = $replace;
		include(__DIR__.'/'.$file);
		return ob_get_clean();
    }
    public static function templateRender($file, $arr)
    {
        foreach($arr as $key=>$val)
        {
            $file = str_replace($key, $val, $file);
        }
        return $file;
    }
	public static function getParams()
	{
		return self::$_params;
	}
	public static function getFormat()
	{
		return self::$_format;
	}
	function getController()
	{
		return $this->_controller;
	}
	function getAction()
	{
		return $this->_action;
	}
	function getBody()
	{
		return self::$_body;
	}
	public static function setBody($body)
	{
		self::$_body = $body;
		return self::$_body;
	}
}
?>
