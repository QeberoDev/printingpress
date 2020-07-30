<?php

use App\Util\Collection as Collection;

class CollectionTest extends \PHPUnit\Framework\TestCase
{
	/** @test */
	public function empty_instantiated_collection_returns_null()
	{
		$collection = new Collection();
		$this->assertEmpty($collection->get());
	}

	/** @test */
	public function can_count_items_correctly()
	{
		$collection = new Collection([
			'one', 'two', 'three'
		]);

		$this->assertEquals(3, $collection->count());
	}

	/** @test */
	public function returned_items_match_passed_in()
	{
		$collection = new Collection([
			'one', 'two'
		]);

		$this->assertCount(2, $collection->get());
		$this->assertEquals($collection->get()[0], 'one');
		$this->assertEquals($collection->get()[1], 'two');
	}

	/** @test */
	public function if_collection_is_instance_of_iterator_aggregate()
	{
		$collection = new Collection();
		$this->assertInstanceOf(IteratorAggregate::class, $collection);
	}

	/** @test */
	public function collection_can_be_iterated()
	{
		$collection = new Collection([
			'one', 'two', 'three'
		]);

		$items = [];

		foreach( $collection as $item)
		{
			$items[] = $item;
		}

		$this->assertCount(3, $items);
	}

	/** @test */
	public function collection_can_be_merged_with_another_collection()
	{
		$collection1 = new Collection([
			'one', 'two', 'three'
		]);
		$collection2 = new Collection([
			'four', 'five', 'six'
		]);

		$collection1->merge($collection2);

		$this->assertCount(6, $collection1);
		$this->assertContains('four', $collection1);
		$this->assertContains('five', $collection1);
		$this->assertContains('six', $collection1);
	}
}
