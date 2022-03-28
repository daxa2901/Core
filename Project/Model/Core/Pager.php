<?php

class Model_Core_Pager
{
	protected $perPageCountOption = [10,20,30,50,100,200]; 
	protected $perPageCount = 20; 
	protected $totalCount = null; 
	protected $pageCount = null; 
	protected $start = null; 
	protected $end = null; 
	protected $current = null; 
	protected $prev = null; 
	protected $next = null; 
	protected $startLimit = null; 
	protected $endLimit = null; 

	public function setPerPageCount($perPageCount)
	{
		$this->perPageCount =$perPageCount;
		return $this;
	}
	
	public function getPerPageCount()
	{
		return $this->perPageCount;
	}
	
	public function setPerPageCountOption($perPageCountOption)
	{
		$this->perPageCountOption =$perPageCountOption;
		return $this;
	}
	
	public function getPerPageCountOption()
	{
		return $this->perPageCountOption;
	}

	public function setTotalCount($totalCount)
	{
		$this->totalCount =$totalCount;
		return $this;
	}
	
	public function getTotalCount()
	{
		return $this->totalCount;
	}
	
	public function setPageCount($pageCount)
	{
		$this->pageCount =$pageCount;
		return $this;
	}
	
	public function getPageCount()
	{
		return $this->pageCount;
	}
	
	public function setStart($start)
	{
		$this->start =$start;
		return $this;
	}
	
	public function getStart()
	{
		return $this->start;
	}
	
	public function setEnd($end)
	{
		$this->end =$end;
		return $this;
	}
	
	public function getEnd()
	{
		return $this->end;
	}
	
	public function setCurrent($current)
	{
		$this->current =$current;
		return $this;
	}
	
	public function getCurrent()
	{
		return $this->current;
	}
	
	public function setPrev($prev)
	{
		$this->prev =$prev;
		return $this;
	}
	
	public function getPrev()
	{
		return $this->prev;
	}
	
	public function setNext($next)
	{
		$this->next =$next;
		return $this;
	}
	
	public function getNext()
	{
		return $this->next;
	}
	
	public function setStartLimit($startLimit)
	{
		$this->startLimit =$startLimit;
		return $this;
	}
	
	public function getStartLimit()
	{
		return $this->startLimit;
	}
	public function setEndLimit($endLimit)
	{
		$this->endLimit =$endLimit;
		return $this;
	}
	
	public function getEndLimit()
	{
		return $this->endLimit;
	}
	
	public function execute($totalCount,$current,$perPageCount)
	{
		$this->setPerPageCount((!in_array($perPageCount,$this->getPerPageCountOption())) ? 10 : $perPageCount );
		$this->setTotalCount($totalCount);
		$this->setPageCount(ceil($this->getTotalCount()/$this->getPerPageCount()));
		if ($current > $this->getPageCount()+1) 
		{
			$this->setCurrent($this->getPageCount()+1);
		}
		elseif ($current < 1) {
			$this->setCurrent(1);
		}
		else
		{
			$this->setCurrent($current);
		}
		$this->setStart(($this->current == 1) ? NULL : 1);
		$this->setEnd(($this->current == $this->getPageCount()) ? NULL : $this->getPageCount());
		$this->setStartLimit($this->getPerPageCount() * ($this->getCurrent() - 1) + 1);
		$this->setEndLimit($this->getPerPageCount() * $this->getCurrent());
		$this->setPrev(($this->getCurrent() == 1) ? NULL : $this->getCurrent() - 1);
		$this->setNext(($this->getCurrent() >= $this->getPageCount()) ? NULL : $this->getCurrent() + 1);
	}
}