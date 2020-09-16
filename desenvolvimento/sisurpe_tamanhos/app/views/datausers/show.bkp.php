<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('mensagem');?>

<div class="row align-items-center mb-3"> 
    <div class="col-md-6">
        <h1>Alunos</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/datausers/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Adicionar
        </a>
    </div>
</div> 



<?php

// Caso ainda não tenham registros de aluno para o usuário
if(empty($data)){ 
  $data = ['error' => "Ainda não existem alunos cadastrados"]; 
}

if(isset($data['error'])){ 
  die($data['error']);
} 

?>    


<!-- MONTO A TABELA DENTRO DE UM CONTAINER FLUID PARA OCUPAR TODA A TELA -->
<div class="row">
    <div class="col text-center">
        <table class="table table-striped">
            <thead>
                <tr class="d-flex">                             
                    <th class="col-4">Nome da Criança</th>
                    <th class="col-1">Nascimento</th>
                    <th class="col-3">Última Atualização dos Dados Escolares</th>     
                    <th class="col-4">Ações</th>                  
                </tr>
            </thead>   
            <tbody>             
                <?php foreach ($data as $registro): ?>
                    <tr class="d-flex">
                        <td class="col-4"><?php echo $registro['nome_aluno'];?></td>
                        <td class="col-1"><?php echo date('d/m/Y', strtotime($registro['nascimento'])); ?></td>
                        <td class="col-3"><b><?php echo ($this->dadosModel->getDadosAnuaisByid($registro['aluno_id'])) ? date('d/m/Y', strtotime($registro['ultima_atualizacao']->ultima_atual)) : 'Sem Informação'; ?></b></td>
                        <td class="col-4">
                            <div class="btn-group">                        
                                <a href="<?php echo URLROOT; ?>/anuals/index/<?php echo $registro['aluno_id']; ?>" class="fa fa-bus btn btn-primary btn-lg">Dados Escolares</a>                            
                                <a href="<?php echo URLROOT; ?>/datausers/edit/<?php echo $registro['aluno_id']; ?>" class="fa fa-edit btn btn-success btn-lg">Editar</a>               
                                <a 
                                        href="<?php echo URLROOT; ?>/datausers/delete/<?php echo $registro['aluno_id'];?>" 
                                        class="fa fa-remove btn btn-danger btn-lg <?php echo ($this->dadosModel->getDadosAnuaisByid($registro['aluno_id'])) ? 'disabled' : ''; ?>"
                                        onclick="if(question('Tem certeza que deseja remover o registro?') == true)
                                                {
                                                    document.forms[0].submit();
                                                }
                                                else
                                                {										
                                                    return false;
                                                }"                       
                                    >                        
                                        Remover
                                    </a>                        
                            </div>
                        </td>                                                   
                    </tr>   
                <?php endforeach; ?>
            </tbody>
        </table>  
    </div>
</div>




<?php require APPROOT . '/views/inc/footer.php'; ?>