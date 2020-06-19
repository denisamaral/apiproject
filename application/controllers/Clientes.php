<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
		$this->load->model('ClientesApiModel');
	}

	public function index() {
		$this->load->view('clientes/controle');
	}

	public function add() {

		$planos = $this->ClientesApiModel->getPlanos();

		$dados = array(
			'planos' => $planos
		);

		$this->load->view('clientes/cadastro', $dados);
	}

	public function edit($idCliente) {

		$cliente = $this->ClientesApiModel->getClientePlanos($idCliente);

		$planos  = $this->ClientesApiModel->getPlanos();

		$dados = array(
			'cliente' 		=> $cliente['clientes'],
			'clientePlanos' => $cliente['clientePlanos'],
			'planos' 		=> $planos
		);

		$this->load->view('clientes/atualiza', $dados);

	}

	public function adicionar() {

		$api_url = "http://localhost/apiproject/ClientesApi/insert";

		$planos = $this->input->post('planossel');

		$form_data = array(
			'nome'		=>	$this->input->post('nome'),
			'email'		=>	$this->input->post('email'),
			'tel'		=>	$this->input->post('tel'),
			'estado'	=>	$this->input->post('estado'),
			'cidade'	=>	$this->input->post('cidade'),
			'dataNasc' 	=>	$this->input->post('dataNasc'),
			'planossel' =>	json_encode($planos),
		);

		$client = curl_init($api_url);

		curl_setopt($client, CURLOPT_POST, true);

		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($client);

		curl_close($client);

		echo $response;

	}

	public function editar() {

		$api_url = "http://localhost/apiproject/ClientesApi/update";

		$planos = $this->input->post('planossel');

		$form_data = array(
			'idCliente'	=> $this->input->post('idCliente'),
			'nome'		=> $this->input->post('nome'),
			'email'		=> $this->input->post('email'),
			'tel'		=> $this->input->post('tel'),
			'estado'	=> $this->input->post('estado'),
			'cidade'	=> $this->input->post('cidade'),
			'dataNasc' 	=> $this->input->post('dataNasc'),
			'planossel' => json_encode($planos),
		);

		$client = curl_init($api_url);

		curl_setopt($client, CURLOPT_POST, true);

		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($client);

		curl_close($client);

		echo $response;

	}

	function deletar(){

		$api_url = "http://localhost/apiproject/ClientesApi/delete";

		$form_data = array(
			'idCliente' =>	$this->input->post('idCliente')
		);

		$client = curl_init($api_url);

		curl_setopt($client, CURLOPT_POST, true);

		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($client);

		curl_close($client);

		echo $response;
	}

	function listar() {

		$api_url = "http://localhost/apiproject/ClientesApi/index";

		$client = curl_init($api_url);

		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($client);

		curl_close($client);

		$response = json_decode($response);

		$output = '';

		if(count($response) > 0) {

			foreach($response as $row) {

					$output .= '
							<tr>
								<td> '.$row->nomeCliente.' </td>
								<td> '.$row->emailCliente.' </td>
								<td> '.$row->telCliente.' </td>
								<td> '.$row->ufCliente.' </td>
								<td> '.$row->cidadeCliente.' </td>
								<td> '.$row->dtNascCliente.' </td>
								<td>
									
									<a href="'.base_url("Clientes/edit/".$row->idCliente) .'" class="btn btn-info btn-md"> Editar </a>
								</td>
								<td>
									<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->idCliente.'">
										Deletar
									</button>
								</td>
							</tr>
						';

				}

			} else {

				$output .= '
					<tr>
						<td colspan="8" align="center"> Nenhum registro encontrado! </td>
					</tr>
					';

			}

			echo $output;


	}

}
