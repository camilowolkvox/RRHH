<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Empleados_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		require_once APPPATH . 'third_party/vendor/autoload.php';
	}

	function getEmployees()
	{

		$client = new Google_Client();
		$client->setApplicationName('Recursos Humanos');
		$client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
		$client->setAccessType('offline');
		$client->setAuthConfig(APPPATH . 'third_party/vendor/credential.json');
		$service = new Google_Service_Sheets($client);
		$spreadsheetId = "1Ia_Tr_gj3WaQiipJ4sf69LTM1G0NZETHZRZ15_NQgNE";

		$range = "A2:D5";

		$response = $service->spreadsheets_values->get($spreadsheetId, $range);

		$employees = $response->getValues();

		return $employees;
	}

	function can_login($email, $password)
	{
		$employees = $this->getEmployees();
		foreach ($employees as $employee) {

			if ($employee[3] === $password) {
				$data["nombre"] = $employee[0];
				$data["puesto"] = $employee[1];
				$data["salario"] = $employee[2];
				$data["cedula"] = $employee[3];

				return $data;
			} else {
				return 'Wrong Email Address';
			}
		}
	}
}
