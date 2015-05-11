<?php
class CarModel
{
	protected $DB;
	public function __construct()
	{
		$this -> DB = DataBase::getInstance();
	}
	public function getAllCars()
	{
		$result = $this -> DB -> SELECT(" a.id, a.model, a.photo, b.brand ") ->
		from(" auto a ") -> inner(" brand b ") -> on(" a.brand_id = b.id ") ->
		selected();
		return $result;
	}
	public function getDetail($id)
	{
		$result = $this -> DB -> SELECT(" a.id, a.model, a.photo, a.year,
		a.capacity, a.color, a.speed, a.price, b.brand ") ->from(" auto a ") ->
		inner(" brand b ") -> on(" a.brand_id = b.id ") -> where(" a.id = $id ") 
		-> selected();
		return $result;
	}
}
?>