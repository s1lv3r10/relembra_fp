<?php

    include('../config.php');
    include(DBAPI);
	include(PDF);

    $usuarios = null;
    $usuario = null;
	
	/**
	* Listagem de Usuários
	*/
    function index() {
        global $usuarios;
        if(!empty($_POST['users'])) {
            $usuarios = filter("usuarios", "%" . $_POST['users'] . "%");
        } else{
            $usuarios = find_all("usuarios");
        }
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
        if (!empty($_POST['usuario'])) {
            try{
                $usuario = $_POST['usuario'];

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
                
                    $usuario['foto'] = $nomearquivo;
                }   

                //criptografando a senha
                if(!empty($usuario['password'])) {
                    $senha = criptografia($usuario['password']);
                    $usuario['password'] = $senha;
                }

                save('usuarios', $usuario);

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
				
				if (isset($_POST['usuario'])) {
					$usuario = $_POST['usuario'];
					
					//criptografando a senha
					if (!empty($usuario['password'])) {
						$senha = criptografia($usuario['password']);
						$usuario['password'] = $senha;
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
						
						$usuario['foto'] = $nomearquivo;
						
					}
					
					update('usuarios', $id, $usuario);
					header('Location: index.php');
				} else {
					global $usuario;
					$usuario = find("usuarios", $id);
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
		global $usuario;
		$usuario = find ("usuarios", $id);
	}
	
	/**
	* Exclusão de um Usuario
	*/
	function delete($id = null) {
		
		global $usuarios;
		$usuarios = remove("usuarios", $id);
		
		header("Location: index.php");
	}
	
	/**
	*Gerando PDF
	*/
      function BasicTable($header, $data, $pdf)
        {
            // Header
            foreach($header as $col)
                $pdf->Cell(40,7,$col,1);
                $pdf->Ln();
            // Data
            foreach($data as $row)
            {
                foreach($row as $col)
                
                if(pathinfo(basename($col), PATHINFO_EXTENSION) == 'jpg' || pathinfo(basename($col), PATHINFO_EXTENSION) == 'png' || $col == null){
                    if($col == null){
                        $imagePath = 'http://' . SERVERNAME . BASEURL.  "usuarios/fotos/sem_foto.png";
                    }else{
                        $imagePath = 'http://' . SERVERNAME . BASEURL.  "usuarios/fotos/". $col;
                    }
                    // Mova para a próxima célula
                    $pdf->Rect($pdf->getX(), $pdf->getY(), 40, 25);
                    $pdf->Cell(30, 20, $pdf->Image($imagePath, $pdf->GetX(), $pdf->GetY(), 40, 25), 0);
                }else{
                    $pdf->Cell(40,25, $col ,1);
                } 
                $pdf->Ln(25);
            }
        }

      function pdf($p = null){
    $pdf = new PDF();
    $pdf->setTitulo("Listagem de Usuários");
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFont('Times','',12);
    $pdf->SetTitle("Listagem de Usuarios");
    $usuarios = null;
    if ($p) {
        $usuarios = filter("usuarios", "%" . $p . "%");
    }else{
        $usuarios = find_all("usuarios");
    }

    // Cabeçalho da tabela
    $pdf->Cell(30, 10, 'ID', 1, 0, 'C');
    $pdf->Cell(70, 10, 'Nome', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Usuário', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Foto', 1, 1, 'C'); // Adiciona uma célula para a foto

    // Altura fixa para todas as células
    $cellHeight = 20;

    // Adiciona os dados dos usuários na tabela
    foreach ($usuarios as $usuario) { 
        $pdf->Cell(30, $cellHeight, $usuario['id'], 1, 0, 'C');
        $pdf->Cell(70, $cellHeight, $usuario['nome'], 1, 0, 'C');
        $pdf->Cell(40, $cellHeight, $usuario['user'], 1, 0, 'C');
        
        // Calcula a proporção da imagem
        $imagePath = "fotos/{$usuario['foto']}";
        if(file_exists($imagePath)){
            list($width, $height) = getimagesize($imagePath);
            $aspectRatio = $width / $height;

            // Calcula a largura da imagem com base na altura fixa da célula e na proporção
            $imageHeight = $cellHeight - 2; // Deixar um pequeno espaço para bordas
            $imageWidth = $imageHeight * $aspectRatio;
            
            // Centraliza a imagem na célula
            $xPos = $pdf->GetX() + (50 - $imageWidth) / 2;
            $yPos = $pdf->GetY() + 1; // Pequeno ajuste para centralização vertical

            // Desenha a imagem
            $pdf->Image($imagePath, $xPos, $yPos, $imageWidth, $imageHeight);
        } else {
            // Se a imagem não existir, exibe "Sem foto"
            $pdf->Cell(50, $cellHeight, 'Sem foto', 1, 1, 'C');
        }

        $pdf->Cell(50, $cellHeight, '', 1, 1); // Célula vazia para alinhar a próxima linha
    }
    $pdf->Output();
	}

?>