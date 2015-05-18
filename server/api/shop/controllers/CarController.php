<?php
class CarController extends ServerController
{
	protected $model, $encode, $view, $valid, $format;
	public function __construct()
	{
		$this -> model = new CarModel();
		$this -> encode = EncoderModel::getInstance();
		$this -> view = new CarView();
		$this -> valid = new ValidatorsModel();
		$this -> format = $this -> valid -> 
		FilterFormValues(FrontController::getFormat());
	}
	public function getInfo()
	{
		$id = $this -> valid -> FilterFormValues(FrontController::getParams());
		$format = $this -> valid -> FilterFormValues(FrontController::getFormat());
		//echo $id;
		$detail = $this -> model -> getDetail($id);
		$this -> view -> returns($this -> encode -> encode($format,
		$detail));
	}
	public function postInfo()
	{
		$arr = array();
		foreach($_POST as $key => $val)
		{
			$arr[$key] = $this -> valid -> FilterFormValues($val);
		}
		$res = $this -> model -> addAuto($arr);
		$this -> view -> returns(true);
	}
	public function getAllCarsAction()
	{
		$cars = $this -> model -> getAllCars();
		$format = $this -> valid -> 
		FilterFormValues(FrontController::getFormat());
		$this -> view -> returns($this -> encode -> encode($format,
		$cars));
	}
	public function getCarsForRedactAction()
	{
		$cars = $this -> model -> getCarsForRedact();
		$format = $this -> valid -> 
		FilterFormValues(FrontController::getFormat());
		$this -> view -> returns($this -> encode -> encode($format,
		$cars));
	}
	public function deleteInfo()
	{
		$id = FrontController::getParams();
		$this -> model -> deleteCar($id);
	}
}
?>
