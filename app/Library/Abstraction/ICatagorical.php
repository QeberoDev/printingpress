<?php

namespace App\Library\Abstraction;

use App\Model\Catagory as Catagory;

interface ICatagorical
{
	public function addCatagory(Catagory $catagory);
	public function removeCatagory(Catagory $catagory);
	public function clearCatagory();
}