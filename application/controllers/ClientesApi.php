<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientesApi extends CI_Controller {

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

	public function index()	{

		$data = $this->ClientesApiModel->read();

		echo json_encode($data);

	}

	public function read()	{

		$data = $this->ClientesApiModel->read();

		echo json_encode($data);

	}

	function insert() {

		// Valida dos enviados pelo usuário via post
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required');
		$this->form_validation->set_rules('tel', 'Telefone', 'required');
		$this->form_validation->set_rules('estado', 'Estado', 'required');
		$this->form_validation->set_rules('cidade', 'Cidade', 'required');
		$this->form_validation->set_rules('dataNasc', 'Data de nascimento', 'required');
		$this->form_validation->set_rules('planossel', 'Planos', 'required');

		if($this->form_validation->run()) {

			$planosSel = json_decode($this->input->post('planossel'));

			$cliente = array(
				'nomeCliente'	=> $this->input->post('nome'),
				'emailCliente'	=> $this->input->post('email'),
				'telCliente'	=> $this->input->post('tel'),
				'ufCliente' 	=> $this->input->post('estado'),
				'cidadeCliente' => $this->input->post('cidade'),
				'dtNascCliente'	=> $this->input->post('dataNasc'),
			);

			$planos = array('planos' => $planosSel,);

			// Executa a ação de inserção
			$add = $this->ClientesApiModel->insert($cliente, $planos);

			// Verifica se a ação retornou/teve algum erro
			if(empty($add['erro'])){
				$array = array(
					'success' => true
				);
			} else {

				$array = array(
					'error' 	 => true,
					'emailError' =>	$add['errorEmail'],
				);

			}

		} else {
			$array = array(
				'error'			=>	true,
				'nomeError'		=>	"O nome do cliente é obrigatório",
				'emailError'	=>	"O e-mail do cliente é obrigatório",
				'telError'		=>	"O telefone do cliente é obrigatório",
				'estadoError'	=>	"O estado do cliente é obrigatório",
				'cidadeError'	=>	"A cidade do cliente é obrigatório",
				'dataNascError'	=>	"A data de nascimento do cliente é obrigatório",
			);
		}

		echo json_encode($array);
	}

	function update() {

		$idCliente = $this->input->post('idCliente');

		// Verifica se foi informado algum cliente
		if(!empty($idCliente)){

			// Valida dos enviados pelo usuário via post
			$this->form_validation->set_rules('nome', 'Nome', 'required');
			$this->form_validation->set_rules('email', 'E-mail', 'required');
			$this->form_validation->set_rules('tel', 'Telefone', 'required');
			$this->form_validation->set_rules('estado', 'Estado', 'required');
			$this->form_validation->set_rules('cidade', 'Cidade', 'required');
			$this->form_validation->set_rules('dataNasc', 'Data de nascimento', 'required');
			$this->form_validation->set_rules('planossel', 'Planos', 'required');

			if($this->form_validation->run()) {

				$planosSel = json_decode($this->input->post('planossel'));

				$cliente = array(
					'nomeCliente'	=> $this->input->post('nome'),
					'emailCliente'	=> $this->input->post('email'),
					'telCliente'	=> $this->input->post('tel'),
					'ufCliente' 	=> $this->input->post('estado'),
					'cidadeCliente' => $this->input->post('cidade'),
					'dtNascCliente'	=> $this->input->post('dataNasc'),
				);

				$planos = array('planos' => $planosSel,);

				// Executa a ação de atualização
				$add = $this->ClientesApiModel->update($idCliente, $cliente, $planos);

				// Verifica se a ação retornou/teve algum erro
				if(empty($add['erro'])){
					$array = array(
						'success' => true
					);
				} else {
					$array = array(
						'error' 	 => true,
						'emailError' =>	$add['errorEmail'],
					);
				}

			} else {
				$array = array(
					'error'			=>	true,
					'nomeError'		=>	"O nome do cliente é obrigatório",
					'emailError'	=>	"O e-mail do cliente é obrigatório",
					'telError'		=>	"O telefone do cliente é obrigatório",
					'estadoError'	=>	"O estado do cliente é obrigatório",
					'cidadeError'	=>	"A cidade do cliente é obrigatório",
					'dataNascError'	=>	"A data de nascimento do cliente é obrigatório",
				);
			}

		} else {
			$array = array(
				'error'	  => true,
				'idError' => "É necessário o ID do Cliente...",
			);
		}

		echo json_encode($array);

	}

	function delete() {

		$idCliente = $this->input->post('idCliente');

		// Verifica se foi informado algum cliente
		if(!empty($idCliente)) {

			// Executa a ação de exclusão
			$delete = $this->ClientesApiModel->delete($idCliente);

			// Verifica se a ação retornou/teve algum erro
			if(empty($delete['erro'])) {
				$array = array(
					'success'	=>	true
				);
			} else {
				$array = array(
					'error'	   => true,
					'msgError' => "Não foi possível deletar este usuário.",
				);
			}

		} else {
			$array = array(
				'error'	  => true,
				'idError' => "É necessário o ID do Cliente...",
			);
		}

		echo json_encode($array);

	}

}
