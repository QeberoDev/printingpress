<?php

namespace App\Model;

use App\Model\Abstraction\IDataModel;
use App\Model\Customer;

class Order implements IDataModel
{
	## Constants
	public const EDIT_ONLY = 1;
	public const PRINT_ONLY = 2;
	public const EDIT_AND_PRINT = 3;
	
	protected $_id;
	protected $_created_date;
	protected $_order_type;
	protected $_delivery_date;
	protected $_customer_id;
	protected $_worker_id;
	protected $_editor_id;

	public function __construct(Customer $customer, $order_type = null)
	{
		$this->customer_id = $customer->GetId();
		if($order_type > self::EDIT_ONLY && $order_type < self::EDIT_AND_PRINT) $this->SetOrderType($order_type);
	}

	#region Setter
	public function SetId(int $id)
	{
		$this->_id = $id;
	}
	public function SetOrderType($order_type)
	{
		if($order_type >= 1 && $order_type < 4) $this->_order_type = $order_type;
	}
	public function SetDeliveryDate(string $days)
	{
		$date = new \DateTime('now');
		$date->modify("+$days day");
		$this->_delivery_date = $date->format('d-m-Y');
	}
	public function SetCreatedDate($created_date)
	{
		$this->_created_date = $created_date;
	}
	public function SetCustomerId($id)
	{
		$this->_customer_id = $id;
	}
	public function SetPrintWorkerId(int $worker_id)
	{
		$this->_worker_id = $worker_id;
	}
	public function SetEditorId(int $editor_id)
	{
		$this->_editor_id = $editor_id;
	}
	#endregion
	#region Getter
	public function GetId()
	{
		return $this->_id;
	}
	public function GetCreatedDate()
	{
		return $this->_created_date;
	}
	public function GetOrderType()
	{
		return $this->_order_type;
	}
	public function GetDeliveryDate()
	{
		return $this->_delivery_date;
	}
	public function GetCustomerId()
	{
		$this->_customer_id;
	}
	public function GetPrintWorkerId()
	{
		return $this->_worker_id;
	}
	public function GetEditorId()
	{
		return $this->_editor_id;
	}
	#endregion
}