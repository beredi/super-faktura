<?php
require_once 'CZCompanyRegistryClient.php';


$registryClient = new CZCompanyRegistryClient();


try {
	//$data = $registryClient->getCompanyData('05141401');
	$data = $registryClient->getCompanyData('12345678');
	echo $data;
}
catch (Exception $e) {
	echo $e->getMessage();
}
?>