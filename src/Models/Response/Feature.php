<?php


namespace Fulfillment\Postage\Models\Response;


use Fulfillment\Postage\Models\Traits\SimpleSerializable;

class Feature implements \Fulfillment\Postage\Models\Response\Contracts\Feature, \JsonSerializable
{
	use SimpleSerializable;

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getSymbol()
	{
		return $this->symbol;
	}

	/**
	 * @param string $symbol
	 */
	public function setSymbol($symbol)
	{
		$this->symbol = $symbol;
	}
	/**
	 * @var string
	 */
	protected $name;
	/**
	 * @var string
	 */
	protected $symbol;
}