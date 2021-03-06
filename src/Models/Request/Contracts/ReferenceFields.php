<?php
namespace Fulfillment\Postage\Models\Request\Contracts;

interface ReferenceFields extends \JsonSerializable {

	/**
	 * @return string
	 */
	public function getShipperReference();

	/**
	 * @param string $shipperReference
	 */
	public function setShipperReference($shipperReference);

	/**
	 * @return string
	 */
	public function getConsigneeReference();

	/**
	 * @param string $consigneeReference
	 */
	public function setConsigneeReference($consigneeReference);

	/**
	 * @return string
	 */
	public function getReference1();

	/**
	 * @param string $reference1
	 */
	public function setReference1($reference1);

	/**
	 * @return string
	 */
	public function getReference2();

	/**
	 * @param string $reference2
	 */
	public function setReference2($reference2);

	/**
	 * @return string
	 */
	public function getReference3();

	/**
	 * @param string $reference3
	 */
	public function setReference3($reference3);

	/**
	 * @return string
	 */
	public function getReference4();

	/**
	 * @param string $reference4
	 */
	public function setReference4($reference4);

	/**
	 * @return string
	 */
	public function getReference5();

	/**
	 * @param string $reference5
	 */
	public function setReference5($reference5);

	/**
	 * @return string
	 */
	public function getReference6();

	/**
	 * @param string $reference6
	 */
	public function setReference6($reference6);

}