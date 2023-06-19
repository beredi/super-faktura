<?php

class CZCompanyRegistryClient
{
	private const API_ENDPOINT = 'http://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi';
	
	/**
		Validate ICO format - number, 8 characters
		@params string $ico
		@return bool
	**/
	private static function validateICO(string $ico): bool
	{
		return is_numeric($ico) && strlen($ico) === 8;
	}

	/**
		Parse XML from ARES
		@params $content
		@throws Exception
		@return string - JSON
	**/
	private static function parseXml($content): string
	{
		if(!$content) {
			throw new Exception('Not found any data for the given IČO.');
		}
		
		$xml = simplexml_load_string($content);
		
		if(!$xml) {
			throw new Exception('Not found any data for the given IČO.');
		}
		
		$namespaces = $xml->getDocNamespaces();
		$result = $xml->children($namespaces['are']);
		$xml = $result->children($namespaces['D']);
		
		if(!empty($xml) && !empty($xml->E->EK)) {
			throw new Exception('Not found any data for the given IČO.');
		} elseif(empty($xml)) {
			throw new Exception('Some problem occurs.');
		}
		
		return json_encode($xml);
		
	}

	/**
		Get data from url
		@params string $url
		@return string
	**/
	private static function getData(string $url): string
	{
		return file_get_contents($url);
	}

	/**
		Get company data for specific ICO
		@params string $ico
		@throws InvalidArgumentException
		@return string - JSON
	**/
	public function getCompanyData(string $ico): string
	{
		if (!self::validateICO($ico)) {
			throw new InvalidArgumentException('Invalid IČO provided.');
		}

		$url = self::API_ENDPOINT . '?ico=' . $ico;
		$data = self::getData($url);
		$json = self::parseXml($data);

		return $json;
	}
}

?>
