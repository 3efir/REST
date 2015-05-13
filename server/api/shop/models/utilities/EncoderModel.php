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
}
?>