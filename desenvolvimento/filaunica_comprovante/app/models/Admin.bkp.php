<?php
    class Admin{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        

        public function getFila($nome=NULL) {
            $this->db->query("
                    SELECT 
                        fila.id as fila_id,     
                        fila.registro as registro, 
                        fila.responsavel as responsavel, 
                        fila.nomecrianca as nome, 
                        fila.nascimento as nascimento,
                        fila.protocolo as protocolo,
                        fila.comprovanteres,
                        fila.comprovante_res_nome,
                        fila.comprovanteres_tipo,
                        fila.comprovantenasc,
                        fila.comprovantenasc_tipo,
                        fila.comprovante_nasc_nome,
                        fila.status as status,
                        (SELECT descricao FROM etapa WHERE fila.nascimento>=data_ini AND fila.nascimento<=data_fin) as etapa
                        
                    FROM                               
                        fila
                    ORDER BY
                        etapa"                    
            );
        
            
            if($nome <> NULL){
                $this->db->query .= " WHERE fila.nomecrianca LIKE '%$nome%'";   
            }
        
        
            $result = $this->db->resultSet();
            
            //verifica se obteve algum resultado
            if($result >0)
            {
                foreach ($result as $row)
                {
                $data[] = array(  
                        'fila_id' => $row->fila_id,
                        'registro' => $row->registro,
                        'nome' => $row->nome,
                        'responsavel' => $row->responsavel,
                        'nascimento' => $row->nascimento,
                        'etapa' => $row->etapa,
                        'protocolo' => $row->protocolo,
                        'comprovante_res_nome' => $row->comprovante_res_nome,
                        'comprovante_nasc_nome' => $row->comprovante_nasc_nome,
                        'status' => $row->status  
                    );
                }
                return $data;
            }
            else
            {
                return false;
            }   
            
            
        }


        // 3 CONSULTA MONTA SQL DINAMICAMENTE E RETORNA OS VALORES
        // PAGINAÇÃO $inicio_pag E $fim_pag definem em que registro começar a mostrar e em qual terminar
        // PASSO ESSES DOIS PARÂMETROS PARA FAZER A PAGINAÇÃO LÁ EM controlers/Admins.php
        public function getFilaBusca($nome="Todos",$etapa="Todos",$status="Todos",$inicio_pag=1, $fim_pag=2) {
                
            $sql = ("
                        SELECT 
                            fila.id as fila_id,     
                            fila.registro as registro, 
                            fila.responsavel as responsavel, 
                            fila.nomecrianca as nome, 
                            fila.nascimento as nascimento,
                            fila.protocolo as protocolo,
                            fila.comprovanteres,
                            fila.comprovante_res_nome,
                            fila.comprovanteres_tipo,
                            fila.comprovantenasc,
                            fila.comprovantenasc_tipo,
                            fila.comprovante_nasc_nome,
                            fila.status as status,
                            (SELECT descricao FROM etapa WHERE fila.nascimento>=data_ini AND fila.nascimento<=data_fin) as etapa                     
                        FROM                               
                            fila                                                      
                            "                    
                            
                );

                
                // CRIO UM ARRAY PARA ARMAZENAR OS CAMPOS QUE VOU FAZER O BIND
                $bindvalues = array();               
             

                // SE A ETAPA É DIFERENTE DE TODAS EU ADICIONO A CLAUSULA WHERE E REGISTRO O CAMPO E O VALOR PARA FAZER O BIND
                if($etapa != "Todos"){                    
                    $sql .= " WHERE (SELECT id FROM etapa WHERE fila.nascimento>=etapa.data_ini AND fila.nascimento<=etapa.data_fin) = :etapa_id";                    
                    // CAMPO E O VALOR PARA FAZER O BIND
                    $bindvalues[':etapa_id'] = $etapa;                                         
                } else {
                    // SE NÃO FOR DIFERENTE DE TODOS ADICIONO UMA CLAUSULA WHERE SEM NENHUM PARÂMETRO PARA MONTAR O SQL NESTE CASO WHERE fila.id VAI TRAZER TODOS OS REGISTROS MESMO ASSIM
                    $sql .= " WHERE fila.id";            
                   
                }

                // SE STATUS FOR DIFERENTE DE TODOS ADICIONO O SQL E REGISTRO CAMPO E O VALOR PARA FAZER O BIND
                if($status != "Todos"){
                    $sql .= " AND fila.status=:status";
                    $bindvalues[':status'] = $status;                    
                }


                // SE NOME FOR DIFERENTE DE TODOS E NÃO FOR VAZIO ADICIONO A SQL
                // AQUI NÃO PRECISA FAZER O BIND POIS PASSO O VALOR DIRETO PELA VARIÁVEL
                if(($nome != "Todos") && ($nome != "") ){
                    $sql .= " AND fila.nomecrianca LIKE '%$nome%'";                                       
                }
                
                // POR FIM ADICIONO COMO QUERO ORDENAR
                $sql .= " ORDER BY etapa ASC LIMIT $inicio_pag, $fim_pag";
                              
                
                // MONTO A SQL
                $this->db->query($sql);
               
                
                // ATRAVÉS DO FOREACH ADICIONO TODOS OS CAMPOS E VALORES PARA FAZER O BIND
                foreach($bindvalues as $field => $value){
                    // $this->db->bind(':status',$status);
                    $this->db->bind($field ,$value);  
                    //echo "<br>" . $field ."->". $value;
                }
               
                
                
                // JOGO TODOS OS VALORES DO RESULTADO DA CONSULTA NA VARIÁVEL result                
                $result = $this->db->resultSet();
               
                        
            // VERIFICO SE OBTEVE AO MENOS UM REGISTRO
            if($this->db->rowCount() > 0)
            {
                foreach ($result as $row)
                {
                $data[] = array(  
                        'fila_id' => $row->fila_id,
                        'registro' => $row->registro,
                        'nome' => $row->nome,
                        'responsavel' => $row->responsavel,
                        'nascimento' => $row->nascimento,
                        'etapa' => $row->etapa,
                        'protocolo' => $row->protocolo,
                        'comprovante_res_nome' => $row->comprovante_res_nome,
                        'comprovante_nasc_nome' => $row->comprovante_nasc_nome,
                        'status' => $row->status  
                    );
                }
                //RETORNO O RESULTADO
                return $data;
            }
            else
            {
                return false;
            }   
            
            
        }











        public function buscaProtocolo($protocolo) {
                $this->db->query("
                                    SELECT      
                                        fila.registro as registro, 
                                        fila.responsavel as responsavel, 
                                        fila.nomecrianca as nome, 
                                        fila.nascimento as nascimento,
                                        fila.protocolo as protocolo,
                                        fila.status as status,
                                        (SELECT descricao FROM etapa WHERE fila.nascimento>=data_ini AND fila.nascimento<=data_fin) as etapa
                                        
                                    FROM                               
                                        fila 
                                    WHERE 
                                        fila.protocolo=:protocolo
                                ");
            
            
            
            $this->db->bind(':protocolo',$protocolo);
           
           
            $row = $this->db->single();  
           
            if($this->db->rowCount() > 0){
                $data = [
                    'registro' => date('d/m/Y h:i:s', strtotime($row->registro)),
                    'nome' => $row->nome,
                    'responsavel' => $row->responsavel,
                    'nascimento' => date('d/m/Y', strtotime($row->nascimento)),
                    'etapa' => $row->etapa,
                    'status' => $row->status,
                    'protocolo' => $row->protocolo
                    
                ];
                return $data;
            }
            else{
                return false;
            }
        }








        function buscaPosicaoFila($protocolo) {
                $this->db->query(' 
                                    SELECT 
                                            count(fila.id) as posicao,
                                            (SELECT fila.status FROM fila WHERE fila.protocolo=:protocolo) as statusprotocolo
                                    FROM 
                                            fila, etapa
                                    WHERE 
                                            fila.nascimento>=data_ini
                                    AND 
                                            fila.nascimento<=data_fin
                                    AND 
                                            etapa.id = (
                                                        SELECT 
                                                            etapa.id 
                                                        FROM etapa,
                                                            fila 
                                                        WHERE 
                                                            fila.nascimento>=data_ini
                                                        AND 
                                                            fila.nascimento<=data_fin
                                                        AND 
                                                            fila.protocolo = :protocolo
                                                    )
                                    AND 
                                            fila.registro <= (SELECT fila.registro FROM fila WHERE fila.protocolo = :protocolo)
                                    
                                    AND
                                            fila.status = "Aguardando"                            
            
                                ');
            
            
            
            $this->db->bind(':protocolo',$protocolo);            
            
            $row = $this->db->single();  
            //var_dump($row);
                       
            if($row->statusprotocolo == "Aguardando"){
                return $row->posicao . 'º';
            } else {
                return false;
            }       
            
           
        }












        function buscaPosicaoFilaTemp($protocolo) {
            
            $this->db->query('  SELECT
                                    count(fila.id) as posicao,
                                    (SELECT fila.status FROM fila WHERE fila.protocolo=:protocolo) as statusprotocolo
                                FROM
                                    fila
                                WHERE
                                    (fila.nascimento>=(SELECT etapa.data_ini FROM etapa WHERE data_ini<=(SELECT fila.nascimento FROM fila WHERE protocolo = :protocolo) AND data_fin>=(SELECT fila.nascimento FROM fila WHERE protocolo = :protocolo))) 
                                AND 
                                    (fila.nascimento<=(SELECT etapa.data_fin FROM etapa WHERE data_ini<=(SELECT fila.nascimento FROM fila WHERE protocolo = :protocolo) AND data_fin>=(SELECT fila.nascimento FROM fila WHERE protocolo = :protocolo)))
                                AND
                                    fila.registro < (SELECT fila.registro FROM fila WHERE protocolo = :protocolo) 
                                
                                AND fila.status = "Aguardando"                      
                                
                            ');
        
        
        
        $this->db->bind(':protocolo',$protocolo);            
        
        $row = $this->db->single();  
        
                   
        if($row->statusprotocolo == "Aguardando"){
            return $row->posicao . 'º';
        } else {
            return false;
        }       
        
       
    }





    

        








        public function getEtapa($nasc) {
            //verifica se tem mínimo de 4 meses
            $this->db->query("SELECT TIMESTAMPDIFF(MONTH, :datanasc, NOW()) AS meses");
            $this->db->bind(':datanasc',$nasc); 
            $num_meses = $this->db->single();            
            
            if($num_meses->meses<4){        
                return false;
            }
        
            //pega o id da etapa
            $this->db->query("SELECT * FROM etapa WHERE :nasc>=data_ini AND :nasc<=data_fin");
            $this->db->bind(':nasc',$nasc);                  
            $etapa =$this->db->single();  
            if(!empty($etapa->id)){
                return $etapa->id;
            }
            else{
                return false;
            }
        
        }

        public function getEtapas() {
            $this->db->query("SELECT * FROM etapa ORDER BY descricao");
            $result = $this->db->resultSet();     
            
            foreach ($result as $row)
            {
            $etapas[] = array(
                'id' => $row->id,
                'data_ini' => $row->data_ini,
                'data_fin' => $row->data_fin,
                'descricao' => $row->descricao
            );
            }
        return $etapas;
        }

    
        public function downloadres($id){
            
                $this->db->query("SELECT id,comprovanteres as dados,comprovante_res_nome as nome,comprovanteres_tipo as tipo  FROM fila WHERE id = $_GET[id]");
                $this->db->bind(':id',$id); 
                $row = $this->db->single();
                
           
            if($this->db->rowCount() > 0){
                return $row;
            } else {
                return false;
            }                   

        }


        public function downloadnasc($id){
          
                
                $this->db->query("SELECT id,comprovantenasc as dados,comprovante_nasc_nome as nome,comprovantenasc_tipo as tipo  FROM fila WHERE id = $_GET[id]");
                $this->db->bind(':id',$id); 
                $row = $this->db->single(); 
            
            
            if($this->db->rowCount() > 0){
                return $row;
            } else {
                return false;
            }                   

        }

        //Aqui já executo a sql com o id e status passado pelo método updateStatus
        public function changeStatus($id,$status){
            $this->db->query('UPDATE fila SET fila.status=:status WHERE id=:id');
            $this->db->bind(':id',$id); 
            $this->db->bind(':status',$status); 
            $this->db->execute();
        }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}