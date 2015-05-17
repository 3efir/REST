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
		}
	}
	public function json($data)
	{
		return json_encode($data);
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