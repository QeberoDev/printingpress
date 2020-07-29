<?php

use PHPUnit\Framework\Assert;

class SampleTest extends \PHPUnit\Framework\TestCase
{
	public function testTrueAssertsToTrue()
	{
		$this->assertTrue(true, "Does it Assert to True?");
	}
}