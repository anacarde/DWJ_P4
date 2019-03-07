<?php

namespace App\model;

class Comment {

	protected $id,
			  $author,
			  $content,
			  $dateAdd,
			  $dateModif;

	public function setId()
	{
		$this->id = (int) $id;
	}

	public function setAuthor()
	{
		if (!is_string($author) || empty($author))
		{
			throw new Exception
		}
	}

	public function setContent()
	{
		
	}

	public function setDateAdd()
	{
		
	}

	public function setDateModif()
	{
		
	}


	public function getId()
	{
		return $this->id;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getDateAdd()
	{
		return $this->dateAdd;
	}

	public function getDateModif()
	{
		return $this->dateModif;
	}

}