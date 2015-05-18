<?php
class ServerModel
{
	protected $DB;
	public function __construct()
	{
		$this -> DB = DataBase::getInstance();
	}
	public function saveOrder($arr)
	{
		$idArr = $this -> DB -> SELECT(" id ") -> from(" dnk_users ") -> 
		where(" token = \"".$arr['hash']."\"") -> selected();
		try
		{
			$arr = array($idArr[0]['id'], $arr['id']);
			$this -> DB -> INSERT(" dnk_orders ") -> keys(" idCar, idUser ") ->
			values(" ?, ? ") ->	insertUpdate($arr);
			return true;
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
	public function getOrders()
	{
		
	}
	public function getData()
	{
		$result = array();
		$result['models'] = $this -> DB -> SELECT(" distinct model ") -> from("
		 auto ") -> selected();
		$result['year'] = $this -> DB -> SELECT(" distinct year ") -> from(" 
		auto ") -> selected();
		$result['capacity'] = $this -> DB -> SELECT(" distinct capacity ") -> 
		from(" auto ") -> selected();
		$result['color'] = $this -> DB -> SELECT(" distinct color ") -> from(" 
		auto ") -> selected();
		$result['speed'] = $this -> DB -> SELECT(" distinct speed ") -> from(" 
		auto ") -> selected();
		return $result;
	}
	public function search($arr)
	{
		$result = $this -> DB -> SELECT(" a.id, a.model, a.photo, b.brand ") ->
		from(" auto a ") -> inner(" brand b ") -> on(" a.brand_id = b.id ") ->
		where(" a.year = ".$arr['year']." ");
		if(isset($arr['model']))
		{
			$result = $result -> whereAnd(" a.model = '".$arr['model']."' ");
		}
		if(isset($arr['capacity']))
		{
			$result = $result -> whereAnd(" a.capacity = '".$arr['capacity']."' ");
		}
		if(isset($arr['color']))
		{
			$result = $result -> whereAnd(" a.color = '".$arr['color']."' ");
		}
		if(isset($arr['speed']))
		{
			$result = $result -> whereAnd(" a.speed = '".$arr['speed']."' ");
		}
		if(isset($arr['price']))
		{
			$result = $result -> whereAnd(" a.price >= '".$arr['price']."' ");
		}
		$result = $result -> selected();
		return $result;
	}
}
?>
