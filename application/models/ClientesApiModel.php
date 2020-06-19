<?php

class ClientesApiModel extends CI_Model {

	function read() {

		$this->db->order_by('idCliente', 'DESC');
		$clientes = $this->db->get('clientes');

		return $clientes->result_array() ;

	}

	function getClientePlanos($idCliente = null) {

		$this->db->select('*');
		$this->db->where('idCliente', $idCliente);
		$this->db->order_by('idCliente', 'DESC');
		$resultCli = $this->db->get('clientes');

		$clientes = $resultCli->result_array();

		/*$this->db->select('*');
		$this->db->where('idCliente', $idCliente);
		$resultPlan = $this->db->get('clientesplanos');*/


		/*select pl.idPlano, pl.nomePlano, cli.idCliente from planos as pl
left join clientesplanos as cp on cp.idPlano = pl.idPlano
left join clientes as cli on cp.idCliente = cli.idCliente and cli.idCliente  = 18*/

		$this->db->select('pl.idPlano, pl.nomePlano, cli.idCliente');
		$this->db->from('planos as pl');
		$this->db->join('clientesplanos as cp', 'cp.idPlano = pl.idPlano', 'LEFT');
		$this->db->join('clientes as cli', 'cp.idCliente = cli.idCliente and cli.idCliente = '.$idCliente, 'LEFT');

		$resultPlan = $this->db->get();

		$clientePlanos = $resultPlan->result_array();

		$dados = array(
			'clientes' 		=> $clientes,
			'clientePlanos' => $clientePlanos
		);

		//return $clientes->result_array() ;
		return $dados;

	}

	function getPlanos() {

		$this->db->select('*');
		$planos = $this->db->get('planos');

		return $planos->result_array() ;

	}

	function insert($cliente, $planos) {

		// Verifica se possui todas as infos necessárias
		if(!empty($cliente) && !empty($planos)){

			$planos = $planos['planos'];

			// Verifica se já existe o e-mail sendo utilizado por outro cliente
			$this->db->where('emailCliente', $cliente['emailCliente']);
			$result = $this->db->get('clientes');

			if($result->num_rows() >= 1){
				return array('erro' => true, 'errorEmail' => "E-mail já existente!");
			}

			$this->db->trans_begin();

			// Insere as infos do cliente
			$this->db->insert('clientes', $cliente);

			// Recupera o id do cliente que foi inserido
			$idCliente = $this->db->insert_id();

			// Vincula o cliente cadastro com os planos selecionados
			for($iPlano = 0 ; $iPlano < count($planos); $iPlano++){

				$data = array(
					'idCliente' => $idCliente,
					'idPlano'   => $planos[$iPlano],
				);

				$this->db->insert('clientesplanos', $data);

			}


			// Finaliza a execução do comando
			if ($this->db->trans_status() === false) {
				$this->db->trans_rollback();
				return FALSE;
			} else {
				$this->db->trans_commit();
				return TRUE;
			}

		}

	}

	function update($idCliente, $cliente, $planos) {

		// Verifica se possui todas as infos necessárias
		if((!empty($idCliente)) && (!empty($cliente) && !empty($planos))){

			$planos = $planos['planos'];

			// Verifica se já existe o e-mail sendo utilizado por outro cliente
			$this->db->where('emailCliente', $cliente['emailCliente']);
			$this->db->where('idCliente !=', $idCliente);
			$result = $this->db->get('clientes');

			if($result->num_rows() >= 1){
				return array('erro' => true, 'errorEmail' => "E-mail já existente!");
			}

			$this->db->trans_begin();

			// Atualiza as infos do cliente
			$this->db->where('idCliente', $idCliente);
			$this->db->update('clientes', $cliente);

			// Exclui os planos antigos
			$this->db->where('idCliente', $idCliente);
			$this->db->delete('clientesplanos');

			// Insere os novos planos selecionados
			for($iPlano = 0 ; $iPlano < count($planos); $iPlano++){

				$data = array(
					'idCliente' => $idCliente,
					'idPlano'   => $planos[$iPlano],
				);

				$this->db->insert('clientesplanos', $data);

			}

			// Finaliza a execução do comando
			if ($this->db->trans_status() === false) {
				$this->db->trans_rollback();
				return FALSE;
			} else {
				$this->db->trans_commit();
				return TRUE;
			}

		}

	}

	function delete($idCliente) {

		if(!empty($idCliente)){

			$this->db->select('cli.ufCliente, cp.idPlano');
			$this->db->from('clientes as cli');
			$this->db->join('clientesplanos AS cp', 'cli.idCliente = cp.idCliente', 'INNER');
			$this->db->where('cli.idCliente', $idCliente);
			$this->db->where('cli.ufCliente', 'São Paulo');
			$this->db->where('cp.idPlano', 1);

			$clientesplanos = $this->db->get();

			$resultclientesplanos = $clientesplanos->result_array();

			//var_dump($clientesplanos->num_rows());

			if($clientesplanos->num_rows() == 1){

				if($resultclientesplanos[0]['idPlano'] == 1){
					return array('erro' => true, 'msgError' => "Exclusão Proibida. Este cliente é de São Paulo e pertence ao plano Free.");
				}

			}

			$this->db->trans_begin();

			// Exclui os vinculos entre cliente e planos
			$this->db->where('idCliente', $idCliente);
			$this->db->delete('clientesplanos');

			// Exclui o cliente
			$this->db->where('idCliente', $idCliente);
			$this->db->delete('clientes');

			$excluidos = $this->db->affected_rows();

			// Finaliza a execução do comando
			if ($this->db->trans_status() === false || $excluidos <= 0) {
				$this->db->trans_rollback();
				return FALSE;
			} else {
				$this->db->trans_commit();
				return TRUE;
			}

		} else {
			return FALSE;
		}

	}
}

?>
