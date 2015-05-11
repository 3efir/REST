<?php
class CarController extends ServerController
{
	protected $model, $encode, $view, $valid;
	public function __construct()
	{
		$this -> model = new CarModel();
		$this -> encode = EncoderModel::getInstance();
		$this -> view = new CarView();
		$this -> valid = new ValidatorsModel();
	}
	public function getInfo()
	{
		$id = $this -> valid -> FilterFormValues(FrontController::getParams());
		$detail = $this -> model -> getDetail($id);
		$this -> view -> returns($this -> encode -> encode(ENCODE, $detail));
	}
	public function getAllCarsAction()
	{
		$cars = $this -> model -> getAllCars();
		$this -> view -> returns($this -> encode -> encode(ENCODE, $cars));
	}
}
?>