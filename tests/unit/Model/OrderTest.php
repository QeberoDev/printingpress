<?php

use PHPUnit\Framework\TestCase;
use App\Model\Customer;
use App\Model\Editor;
use App\Model\Order;
use App\Model\PrintWorker;

class OrderTest extends TestCase
{
	/** @var \App\Model\Order $order */
	protected $order;

	/** @before */
	public function setup(): void
	{
		$customer = new Customer('name', '+251910203040');
		$this->order = new Order($customer, Order::EDIT_AND_PRINT);
	}

	/** @after */
	public function cleanup()
	{
		$this->order = null;
	}
	
	/** @test */
	public function can_create_order()
	{
		$this->assertNotNull($this->order);
		$this->assertInstanceOf(Order::class, $this->order);
	}

	/** @test */
	public function can_set_customer()
	{
		$customer = new Customer('another name', '0933445566');
		$this->order->SetCustomerId($customer->GetId());

		$this->assertEquals($this->order->GetCustomerId(), $customer->GetId());
	}

	/** @test */
	public function can_set_order_type()
	{
		$this->order->SetOrderType(Order::EDIT_AND_PRINT);
		$this->assertEquals($this->order->getOrderType(), Order::EDIT_AND_PRINT);
		$this->order->SetOrderType(Order::EDIT_ONLY);
		$this->assertEquals($this->order->getOrderType(), Order::EDIT_ONLY);
		$this->order->SetOrderType(Order::PRINT_ONLY);
		$this->assertEquals($this->order->getOrderType(), Order::PRINT_ONLY);
	}

	/** @test */
	public function can_set_employee()
	{
		$editor = new Editor('editor', 'name', 'bole 04', '+251911223344', 'emp1@ourmail.com');
		$worker = new PrintWorker('worker', 'name', 'bole chaf', '+251910203040', 'emp2@ourmail.com');
		$editor->SetId(12);
		$worker->SetId(12);

		$this->order->SetEditorId($editor->GetId());
		$this->order->SetPrintWorkerId($worker->GetId());

		$this->assertInstanceOf(Editor::class, $editor);
		$this->assertInstanceOf(PrintWorker::class, $worker);
		$this->assertEquals($editor->GetId(), $this->order->GetEditorId());
		$this->assertEquals($worker->GetId(), $this->order->GetPrintWorkerId());
	}

	/** @test */
	public function can_set_deliverydate()
	{
		$this->order->SetDeliveryDate(3);

		$date = new DateTime('now');
		$date->modify('+3 day');

		$this->assertEquals($this->order->GetDeliveryDate(), $date->format('d-m-Y'));
	}

	/** @test */
	public function can_set_createddate()
	{
		$date = new DateTime('now');
		$date = $date->format('d-m-Y');
		$this->order->SetCreatedDate($date);

		$this->assertEquals($this->order->GetCreatedDate(), $date);
	}
}