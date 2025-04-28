<?php

    include('../config.php');
    include(DBAPI);

    $pacientes = null;
    $paciente = null;
	
	/**
	* Listagem de Usuários
	*/
    function index() {
        global $pacientes;
		$pacientes = find_all("pacientes");
    }

	/**
	 *  Upload de imagens
	 */
	function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo){
		try {
			$nomearquivo = basename($arquivo_destino);
			$uploadOk = 1;
			if (!isset($_POST['submit'])) {			
				$check = getimagesize($nome_temp);
				if($check !== false) {
					$_SESSION['message'] = "File is an image - " . $check['mime'] . ".";
					$_SESSION['type'] = "info";
					$uploadOk = 1;
				}else{
					$uploadOk = 0;
					throw new Exception ("O arquivo não é uma imagem!");
				}
			}
		
			if (file_exists($arquivo_destino)) {
				$uploadOk = 0;
				throw new Exception("Desculpe, o arquivo já existe!");
			}
			
			if($tamanho_arquivo > 5000000) {
				$uploadOk = 0;
				throw new Exception("Desculpe, mas o arquivo é muito grande!");
			}
			
			if($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg" && $tipo_arquivo != "gif") {
				$uploadOk = 0;
				throw new Exception("Desculpe, mas nó são permitidos arquivos de imagem JPG, JPEG, PNG E GIF!");
			}
			
			if ($uploadOk==0) {
				throw new Exception("Desculpe, mas o arquivo não pode ser enviado.");
			}else {
				if (move_uploaded_file($_FILES['foto']['tmp_name'], $arquivo_destino)) {
					$_SESSION['message'] = "O arquivo " . htmlspecialchars($nomearquivo) . "foi armazenado.";
					$_SESSION['type'] = "success";
 				}else {
					throw new Exception("Desculpe, mas o aarquivo não pode ser enviado.");
				}
			}
		} catch (Exception $e) {
			$_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
			$_SESSION['type'] = "danger";
		}
	}
	
	/**
	* Cadastro Usuários
	*/
	function add() {
        if (!empty($_POST['paciente'])) {
            try{
                $paciente = $_POST['paciente'];

                if (!empty($_FILES["foto"]["name"])) {
                    // Upload da foto
                    $pasta_destino = "fotos/";
                    

                    $tipo_arquivo = strtolower(pathinfo(basename($_FILES["foto"]["name"]), PATHINFO_EXTENSION)); 

                    $nomearquivo = uniqid() . "." . $tipo_arquivo;  // extensão do arquivo
                    //pasta onde ficam as fotos

                    $arquivo_destino = $pasta_destino . $nomearquivo;
                   
                     //Caminho completo até o arquivo que será gravado
                    $tamanho_arquivo = $_FILES["foto"]["size"]; //tamanho do arquivo em bytes
                    $nome_temp = $_FILES["foto"]["tmp_name"]; // nome e caminho do arquivo no servidor
                    
                   
                    
                    // Chamda do da função upload para gravar uma imagem
                    upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
                
                    $paciente['foto'] = $nomearquivo;
                }   

                //criptografando a senha
                if(!empty($paciente['password'])) {
                    $senha = criptografia($paciente['password']);
                    $paciente['password'] = $senha;
                }

                save('pacientes', $paciente);

                header('Location; index.php');
            }catch(Exception $e){
                $_SESSION['message'] = 'Aconteceu um erro: ' . $e->getMessage();
		        $_SESSION['type'] = 'danger';
            }
        }
    }
	
	/**
	* Atualização/Edição de Usuários
	*/
	function edit() {
		try {
			if (isset($_GET['id'])){
				
				$id = $_GET['id'];
				
				if (isset($_POST['paciente'])) {
					$paciente = $_POST['paciente'];
					
					//criptografando a senha
					if (!empty($paciente['password'])) {
						$senha = criptografia($paciente['password']);
						$paciente['password'] = $senha;
					}
					
					if (!empty($_FILES['foto']['name'])) {
						//Upload da foto
						$pasta_destino = "fotos/";
						$arquivo_destino = $pasta_destino . basename($_FILES['foto']['name']);
						$nomearquivo = basename($_FILES['foto']['name']);
						$resolução_arquivo = getimagesize($_FILES['foto']['tmp_name']);
						$tamanho_arquivo = $_FILES['foto']['size'];
						$nome_temp = $_FILES['foto']['tmp_name'];
						$tipo_arquivo = strtolower(pathinfo($arquivo_destino,PATHINFO_EXTENSION));
						
						upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
						
						$paciente['foto'] = $nomearquivo;
						
					}
					
					update('pacientes', $id, $paciente);
					header('Location: index.php');
				} else {
					global $paciente;
					$paciente = find("pacientes", $id);
				}
			} else {
				header("Location: index.php");
			}
		} catch (Exeption $e) {
			$_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
			$_SESSION['type'] = "danger";
		}
	}
	
	/**
	* Visualização de um Usuário 
	*/
	function view($id = null) {
		global $paciente;
		$paciente = find ("pacientes", $id);
	}
	
	/**
	* Exclusão de um paciente
	*/
	function delete($id = null) {
		
		global $pacientes;
		$pacientes = remove('pacientes', $id);
		
		header('Location: index.php');
	}
?>