<?php
class EncoderModel
{
	private static $instance = null;
	private function __construct()
    {}
	// singleton
    static public function getInstance()
    {
        if (is_null(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
	public function encode($type, $data)
	{
		switch($type)
		{
			case 'json':
			return $this -> json($data);
			break;
			case 'xml':
			return $this -> xml($data);
			break;
			case 'html':
			return $this -> html($data);
			break;
			case 'txt':
			return $data;
			break;
		}
	}
	public function json($data)
	{
		return json_encode($data);
	}
	public function html($data)
	{
		$res = '';
		foreach($data as $k => $v)
		{
			$res .= "<ul>$k";
			$res .= "<li>$v</li>";
			$res .= "</ul>";
		}
		return $res;
	}
	public function xml($data)
	{
		$dom = new DOMDocument('1.0', 'utf-8');
		foreach($data as $key => $val)
		{
			$new = $dom -> createElement("key");
			foreach($val as $k => $v)
			{
				$node = $dom -> createElement($k);
				$text = $dom -> createTextNode($v);
				$node -> appendChild($text);
				$new -> appendChild($node);
			}
			$dom -> appendChild($new);
		}
		return $dom -> saveXML();
	}
	// incoming param: password
// return hash password
	public function getHashPass($pass)
	{
		return password_hash($pass, PASSWORD_DEFAULT);
	}
// incoming params: hash and pass
// return true if hash = pass or false
	public function validPass($hash, $pass)
	{
		return password_verify($pass, $hash);
	}
	public function createToken()
	{
		return md5(rand(20, 50));
	}
}
?>