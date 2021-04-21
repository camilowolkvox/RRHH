<?php

require __DIR__ . '/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('Recursos Humanos');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credential.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId = "1Ia_Tr_gj3WaQiipJ4sf69LTM1G0NZETHZRZ15_NQgNE";

$range = "A2:D5";

$response = $service->spreadsheets_values->get($spreadsheetId, $range);

$values = $response->getValues();

if (empty($values)) {
	print("No data found. \n");
} else {
	return $values;
}
