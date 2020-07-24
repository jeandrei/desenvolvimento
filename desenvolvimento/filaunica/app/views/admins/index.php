<?php require APPROOT . '/views/inc/header.php'; ?>


<?php 


// A CONEXÃO COM O BANCO DE DADOS É FEITO NA CONSTRUCT DO LIBRARIES/PAGINATOR
// PROCURE POR "AQUI EU ALTEREI FIZ A CONEXÃO COM O BANCO DE DADOS QUE ESTÁ NO DATABASE" 

/*
1 A BIBLIOTÉCA PAGINATION QUE ESTÁ EM libraries/Pagination E É CARREGADA AUTOMATICAMENTE PELO sql_autoload_register assim como as outras libraries Core, Database etc
2 Eu extendi a classe Pagination da biblioteca libraries/Pagination para a database Pagination extends Database assim eu consigo utilizar os mesmos parâmetros de conexão da classe database
- dúvida procure em libraries/Pagination "AQUI EU ALTEREI FIZ A CONEXÃO COM O BANCO DE DADOS QUE ESTÁ NO DATABASE"
3 Cria o controller com o código em comentário vai lá no controller Exemplo_paginacao.php index() que vc vai ver
4 Cria o model com um metodo para buscar os dados no banco de dados getfila($page, $options) E PRINCIPALMENTE ***EXTENDS PARA PAGINATION***
5 Atribua o resultado desse método a variável $paginate $paginate = $data['paginate'];
- a variável $data['paginate'] vem do resultado do método getfila
6 Para passar parâmetros na consulta sql tipo status = Aguardando
- no controller em options coloca assim  'named_params' => array(':status' => 'Aguardando') 
7 PARA POSSIBILITAR CONSULTA COM 'named_params' => array(':status' => $status) tem que colocar no input
e no controller abaixo do if(isset($_GET['page'])) como SESSION É SÓ IR LÁ QUE VC VAI ENTENDER  

*/

?>
<!-- FORMULÁRIO COM OS CAMPOS DE PESQUISA -->
<form id="filtrar" action="<?php echo URLROOT; ?>/admins/index" method="post" enctype="multipart/form-data">
    <!-- LINHA E COLUNAS PARA OS CAMPOS DE BUSCA -->
    <div class="row">     
        
        <!-- COLUNA 1 NOME-->
        <div class="col-lg-4">
            <label for="buscanome">
                Buscar por Nome
            </label>
            <input 
                type="text" 
                name="buscanome" 
                id="buscanome" 
                maxlength="60"
                class="form-control"
                value="<?php if(isset($_POST['buscanome'])){htmlout($_POST['buscanome']);} ?>"
                ><span class="invalid-feedback">
                    <?php // echo $data['nome_err']; ?>
                </span>
        </div>


         <!-- COLUNA 2 ETAPA -->
         <div class="col-lg-3">
            <label for="buscaetapa">
                Busca por Etapa
            </label>                               
            <!-- 1 BOTÃO BUSCA POR ETAPA VAI JOGAR PARA controlers/Admins.php-->
            <select 
                name="buscaetapa" 
                id="buscaetapa" 
                class="form-control"                                        
            >
                    <option value="Todos">Todos</option>
                    <?php 
                    $etapas = $this->adminModel->getEtapas();                     
                    foreach($etapas as $etapa) : ?> 
                        <option value="<?php echo $etapa['id']; ?>"
                                    <?php if(isset($_POST['buscaetapa'])){
                                    echo $_POST['buscaetapa'] == $etapa['id'] ? 'selected':'';
                                    }
                                    ?>
                        >
                            <?php echo $etapa['descricao'];?>
                        </option>
                    <?php endforeach; ?>  
            </select>
        </div>
        
        
        <!-- COLUNA 3 SITUAÇÃO-->
        <div class="col-lg-3">
            <label for="buscastatus">
                Busca por Situação
            </label> 
            <!--BOTÃO BUSCA SITUAÇÃO-->
            <select 
                name="buscastatus" 
                id="buscastatus" 
                class="form-control"                                        
            >   
                    <option value="Todos">Todos</option>
                    <?php 
                    $status = array('Aguardando','Matriculado','Cancelado');                    
                    foreach($status as $row => $value) : ?> 
                        <option value="<?php echo $value; ?>" 
                                        <?php // AQUI TIVE QUE COLOCAR COM SESSION POR CONTA DA PAGINAÇÃO
                                        if(isset($_POST['buscastatus'])){
                                                echo $_POST['buscastatus'] == $value ? 'selected':'';
                                            }
                                        ?>
                        >
                            <?php echo $value;?>
                        </option>
                    <?php endforeach; ?>  
            </select> 
        </div>
        
        
        
        
        <!-- LINHA PARA O BOTÃO ATUALIZAR -->
        <div class="row" style="margin-top:30px;">
            <div class="col-lg-4" style="padding-left:0;">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="submit" class="btn btn-primary mb-2" value="Atualizar">
                    <span class="badge align-middle text-danger" name="busca_err" id="busca_err"></span> 
                </div>                                                
            </div>
        <!-- FIM LINHA BOTÃO ATUALIZAR -->
        </div>



   <!-- DIV LINA PARA OS INPUTS E BOTÃO ATUALIZAR -->
    </div>

                                        


</form>




<?
// aqui eu passo o resultado da paginação esse $data['paginate'] vem lá do controller
$paginate = $data['paginate'];

if($paginate->success == true)
{

    /*
     * Fetch our results
     */
    $result = $paginate->resultset->fetchAll();

?>
<br>
<!-- MONTAR A TABELA -->
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Posição</th> 
      <th scope="col">Nome da Criança</th>
      <th scope="col">Data de Nascimento</th>
      <th scope="col">Etapa</th>
      <th scope="col">Responsável</th>
      <th scope="col">Protocolo</th>  
      <th scope="col">Registro</th>
      <th scope="col">Status</th> 
    </tr>
  </thead>
  <tbody>
    <?php foreach($result as $row) : ?> 
    <tr class="<?php 
                if($row['status'] == "Aguardando")
                echo "table-primary";
                if($row['status'] == "Cancelado")
                echo "table-danger";
                if($row['status'] == "Matriculado")
                echo "table-success";                        
                ?>"
        id="linha_<?php echo $row['fila_id'];?>"               
    >  
      <td><?php echo  $this->adminModel->buscaPosicaoFila($row['protocolo']);?></td> 
      <td><?php echo $row['nomecrianca']; ?></td> 
      <td><?php echo $row['nascimento']; ?></td>  
      <td><?php echo  $this->adminModel->getEtapaDescricao($row['nascimento']);?></td>
      <td><?php echo $row['responsavel']; ?></td>
      <td><?php echo $row['protocolo']; ?></td>  
      <td><?php echo date('d/m/Y h:i:s', strtotime($row['registro'])); ?></td>     
      <td><?php echo $row['status']; ?></td>
    </tr>
    <?php endforeach; ?>    
  </tbody>
</table>
<?    
    
  


    /*
     * Echo out the UL with the page links
     */
    echo '<p>'.$paginate->links_html.'</p>';

    /*
     * Echo out the total number of results
     */
    echo '<p style="clear: left; padding-top: 10px;">Total de Registros: '.$paginate->total_results.'</p>';

    /*
     * Echo out the total number of pages
     */
    echo '<p>Total de Paginas: '.$paginate->total_pages.'</p>';

    echo '<p style="clear: left; padding-top: 10px; padding-bottom: 10px;">-----------------------------------</p>';

   

}










?>







<?php require APPROOT . '/views/inc/footer.php'; ?>

