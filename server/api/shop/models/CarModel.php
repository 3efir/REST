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
	public function addAuto($arr)
	{
		$brand = $arr['brand'];
		$brandId = $this -> getBrandId($brand);
		if(empty($brandId))
		{
			$this -> addBrand($brand);
			$brandId = $this -> DB -> getLastInsertId();
		}
		else
		{
			$brandId = $brandId[0]['id'];
		}
		$arr = array($brandId, $arr['model'], $arr['year'], $arr['capacity'],
					$arr['color'], $arr['speed'], $arr['price']);
		$this -> DB -> INSERT(" auto ") -> keys(" brand_id, model, year, 
		capacity, color, speed, price ") -> values(" ?, ?, ?, ?, ?, ?, ? ") -> 
		insertUpdate($arr);
		return true;
	}
	public function getBrandId($brand)
	{
		$result = $this -> DB -> SELECT(" id ") -> from(" brand ") -> where(" 
		brand LIKE '".$brand."' ") -> selected();
		return $result;
	}
	public function addBrand($brand)
	{
		$arr = array($brand);
		$this -> DB -> INSERT(" brand ") -> keys(" brand ") -> values(" ? ") ->
		insertUpdate($arr);
	}
	public function getCarsForRedact()
	{
		$result = $this -> DB -> SELECT(" a.id, a.model, a.color, a.price,
		a.capacity, a.speed, a.year, b.brand ") -> from(" auto a ") ->
		inner(" brand b ") -> on(" a.brand_id = b.id ") -> selected();
		return $result;
	}
	public function deleteCar($id)
	{
		$this -> DB -> DELETE(" auto ") -> where(" id = $id ") -> deleted();
		return true;
	}
}
?>