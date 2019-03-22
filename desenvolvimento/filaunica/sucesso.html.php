<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Fila Única</title>

    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        #principal{
          margin: 10px 40px;
        }
    </style>  
  

   
  </head>
  <body>

<img src="img/LOGO.png" class="img-fluid" alt="Responsive image">


    
    
<div id="principal">
      <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Cadastro realizado com sucesso!</h4>
          <p>Seu cadastro na Fila Única de Penha/SC foi realizado com sucesso.</p>
          <p>Quando da disponibilidade de uma vaga para a sua solicitação e respeitando a ordem de inscrição, a secretaria de educação entrará em contato
            para o processo de matrícula do aluno.
            Dúvidas podem ser sanadas nos telefones:<br>
            <br>(47) 3345-4025
            <br>(47) 3345-2388            
          </p>
          Abaixo estão as informações do seu cadastro.
          Anote seu <b>protocolo.</b>
          <hr>
            <p class="mb-0">
              <?php echo "Seu protocolo é: <b>" . $protocolo . "</b><br>"; 
                    echo "O nome do aluno é: <b>" . $data['nome'] . "</b><br>";
                    echo "As opções que você escolheu são:";
                      if(!empty($data['setor1'])){
                        echo $data['setor1'];
                      }
                      if(!empty($data['setor2'])){
                        echo $data['setor2'];
                      }
                      if(!empty($data['setor2'])){
                        echo $data['setor2'];
                      }                    
              ?>
            </p>
        </div>
</div>
  </body>
</html>