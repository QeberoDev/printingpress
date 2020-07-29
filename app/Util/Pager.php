<?php

namespace App\Util;

class Pager
{
	private $_pageCount;
	private $_currentPage;

	public function __construct(int $pageCount, int $currentPage)
	{
		$this->_pageCount = $pageCount;
		$this->_currentPage = $currentPage;
	}

	public function pageExists()
	{
		return ($this->_currentPage <= $this->_pageCount && $this->_currentPage >= 1) ? true : false;
	}

	public function getCount()
	{
		return $this->_pageCount;
	}
	
	public function getCurrent()
	{
		return $this->_currentPage;
	}

	public function getNext()
	{
		if($this->getCurrent() >= $this->getCount()) {
			return null;
		}

		return $this->getCurrent() + 1;
	}

	public function getPrevious()
	{
		if($this->getCurrent() <= 1) {
			return false;
		}

		return $this->getCurrent() - 1;
	}
}