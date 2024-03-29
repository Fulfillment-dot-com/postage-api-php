<?php


namespace Fulfillment\Postage\Api;

use Fulfillment\Postage\Models\Request\Contracts\BaseRatePostage;
use Fulfillment\Postage\Models\Request\Contracts\BaseRateRequest;
use Fulfillment\Postage\Models\Request\Contracts\Postage as PostageContract;
use Fulfillment\Postage\Models\Response\NormalizedRate;
use Fulfillment\Postage\Models\Response\RatesResponse;
use Fulfillment\Postage\Models\Response\RequestedRate;

class RatesApi extends ApiRequestBase {
	/**
	 * Get an array of PriceGroup objects based on service, desination, and weight.
	 *
	 * Note: If the service is zone-based then zoneName is required
	 *
	 * @param int             $serviceId
	 * @param string          $sourceIso2
	 * @param string          $destinationIso2
	 * @param float           $weight
	 * @param null            $zoneName     Required if the service is zone-based
	 *
	 * @param null|string|int $fromPostalCode
	 * @param null|string|int $toPostalCode
	 * @param int             $weightTypeId Defaults to 1 (OZ)
	 *
	 * @return \Fulfillment\Postage\Models\Response\PriceGroup[]|mixed
	 */
	public function getPriceGroups($serviceId, $sourceIso2, $destinationIso2, $weight, $zoneName = null, $fromPostalCode = null, $toPostalCode = null, $weightTypeId = 1)
	{
		$queryString = [
			'serviceId'              => $serviceId,
			'destinationCountryISO2' => $destinationIso2,
			'sourceCountryISO2'      => $sourceIso2,
			'weight'                 => $weight,
			'weightTypeId'           => $weightTypeId,
			'fromPostalCode'         => $fromPostalCode,
			'toPostalCode'           => $toPostalCode,
			'XDEBUG_SESSION_START'   => 'postage',
		];

		if (null !== $zoneName)
		{
			$queryString['zoneName'] = $zoneName;
		}
		$json = $this->apiClient->get('rates/priceGroups/shipment', $queryString);

		return ($this->jsonOnly ? $json : $this->jsonMapper->mapArray($json, [], new NormalizedRate()));
	}


	/**
	 * Get cost and markup rates for a shipper, service, desination, and weight.
	 *
	 * Note: If the service is zone-based then zoneName is required
	 *
	 * @param string          $shipperSymbol
	 * @param string          $serviceSymbol
	 * @param string          $sourceIso2
	 * @param string          $destinationIso2
	 * @param float           $weight
	 * @param null            $zoneName     Required if the service is zone-based
	 *
	 * @param null|string|int $fromPostalCode
	 * @param null|string|int $toPostalCode
	 * @param null|float      $cost
	 * @param int             $weightTypeId Defaults to 1 (OZ)
	 * @param bool            $diagnose
	 *
	 * @param null            $validAt
	 *
	 * @return \Fulfillment\Postage\Models\Response\PriceGroup[]|mixed
	 */
	public function getRatesAsPostage($shipperSymbol, $serviceSymbol, $sourceIso2, $destinationIso2, $weight, $zoneName = null, $fromPostalCode = null, $toPostalCode = null, $cost = null, $weightTypeId = 1, $diagnose = false, $validAt = null)
	{
		$queryString = [
			'shipperSymbol'          => $shipperSymbol,
			'serviceSymbol'          => $serviceSymbol,
			'destinationCountryISO2' => $destinationIso2,
			'sourceCountryISO2'      => $sourceIso2,
			'weight'                 => $weight,
			'weightTypeId'           => $weightTypeId,
			'fromPostalCode'         => $fromPostalCode,
			'toPostalCode'           => $toPostalCode,
			'cost'                   => $cost,
			'diagnose'               => $diagnose,
			'validAt'                => null,
			'XDEBUG_SESSION_START'   => 'postage',
		];

		if (null !== $zoneName)
		{
			$queryString['zoneName'] = $zoneName;
		}
		$json = $this->apiClient->get('rates/priceGroups/postage', $queryString);

		return ($this->jsonOnly ? $json : $this->jsonMapper->map($json, new RatesResponse()));
	}

	/**
	 * Get cost and markup rates for a shipper, service, desination, and weight.
	 *
	 * Note: If the service is zone-based then zoneName is required
	 *
	 * @param BaseRatePostage|array $ratePostage
	 * @param array|null            $queryString
	 *
	 * @return RatesResponse|mixed
	 */
	public function ratePostage($ratePostage, $queryString = null)
	{
		$json = $this->apiClient->post('rate', $ratePostage, $queryString);

		return ($this->jsonOnly ? $json : $this->jsonMapper->mapArray($json->data, [], RequestedRate::class));
	}
}