<?php
	

	class ContasDAO {
	    private $conexao = null;

	    public function __construct() {
	        $this->conexao = conexao::getInstance();
	    }

		public function inserirConta($conta){
			try{
		        $status = $this->conexao->prepare("Insert Into conta(id, usuario_id, tipo, saldo) values (null,?,?,?)");

		        $status->bindValue(1, $conta->usuario_id);
		        $status->bindValue(2, $conta->tipo);
		        $status->bindValue(3, $conta->saldo);
		        
		        $status->execute();

		        //Encerra a conexão com o banco
		        $this->conexao = null;
		        return true;
		    } catch (PDOException $e) {
		    	return false;
		    }
		}

		public function EditarConta($conta){
			try{
		        $status = $this->conexao->prepare("UPDATE conta SET tipo = ?, saldo = ? WHERE id = ?;");

		        $status->bindValue(1, $conta->tipo);
		        $status->bindValue(2, $conta->saldo);
		        $status->bindValue(3, $conta->id);
		        
		        $status->execute();
		       
		        //Encerra a conexão com o banco
		        $this->conexao = null;
		        return true;
		    } catch (PDOException $e) {
		    	return false;
		    }
		}

		public function buscarConta($conta_id){

			try{
				$status = $this->conexao->prepare("SELECT * FROM conta WHERE id = ?");
				$status->bindValue(1, $conta_id);
				$status->execute();

	            $resultado = $status->fetchAll();

	            $this->conexao = null;
	           
	            return $resultado[0];
	        } catch (PDOException $e){
	            echo 'Ocorreram erros ao buscar o conta' . $e;
	        }
		}

		public function buscarContas($usuario_id){
			try{
	            $status = $this->conexao->prepare("SELECT * FROM conta WHERE usuario_id = ?");
	            $status->bindValue(1, $usuario_id);
				$status->execute();

	            $array = array();
	            $array = $status->fetchAll(PDO::FETCH_OBJ);

	            $this->connection = null;

	            return $array;
	        } catch (PDOException $e){
	            echo 'Ocorreram erros ao buscar contas' . $e;
	        }
	    }

	    public function excluirConta($conta_id){
	    	try{
				$status = $this->conexao->prepare("DELETE FROM conta WHERE id = ?");
				$status->bindValue(1, $conta_id);
				$status->execute();
			
	            if($status){
					return true;
				}else{
					return false;
				}
	        
	        } catch (PDOException $e){
	            echo 'Ocorreram erros ao excluir o conta' . $e;
	        }
	    }
	}
?>