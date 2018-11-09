<?php
/*
* MVC framework
* na url tudo irá acontecer através do nosso arquivo index.php
* iremos usar um arquivo .htaccess para fazer isso
* pois permite reescrever nossas urls 
* queremos também passar parametros pela url
* por exemplo app.com/index.php?url=post
* sendo assim com a url podemos ler o post controller
* teremos uma pasta chamada controller com um arquivo chamado post.php
* e dentro do arquivo post.php teremos a classe Posts{ }
* se a url passar app.com/index.php?url=post/add
* dentro da classe Posts será chamado o método function add(){}
* também passaremos parâmetros como IDs por exemplo
* supondo a url app.com/index.php?url=post/edit/1
* iremos chamar o controlador post, o método edit function edit($id){} passando o id 1
* e por padrão se nada for passado através da url a classe Post tem que
* chamar o método function index{ } que vai carregar o nosso index.php

DESCRIÇÃO DOS DIRETÓRIOS
public 
basicamente parte frontal da aplicação, onde vai ficar o index.php raiz, 
tudo vai ser roteado para este arquivo, teremos aqui css e javascripts

app
tera todo resto da aplicação, mvc estrutura, o arquivo de configuração, todas as libries, the helpers.

app/libries 
basicamente o coração da aplicação.
Todos os arquivos aquid dentro devem começar com a primeira letra em maiúsculo
Todos os arquivos referentes a classes tem que começar com a primeira letra em maiúsculo


app/libries/core.php
olhará nas urls e basicamente pegará o necessário delas 
por exemplo /post/add ele irá tirar esses dados e clocará em um array
e definirá o que é o parte do controller, o que é método e o que é parâmetro
tipo /post/add/1 - cirará um array [post, add, 1] 
post- é o controller
add - método
1 - parâmetro geralmente o ID

app/libries/database.php
será nosso pdo class, inclui alguns método para conectar, selecionar dados, inserir e contar dados do
bando de dados. The Model interage com esse arquivo.

app/libries/controller.php
controlador principal - possibilitará que facilmente carreguemos The Models and the Views dos nossos
controladores.

Estrutura MVC
/app/models
/app/views
/app/controllers

/app/views/inc
Temos o header e o footer padrão
que é adicionado em todas as páginas


/app/helpers
para coisas menores, teremos um redirect helper para não precisar usar o php location
para redirecionar, teremos uma função redirect aqui dentro para fazer isso
session hellper que permitirá ter menságens rápidas que quando logado o sistema vai informar
que você está logado.


/app/config
onde os parâmetros do banco de dados e  approot vão ficar

/app/bootstrap.php
neste arquivo que vamos requerer todos os arquivos necessários para a aplicação
é onde vamos concentrar o require_once e adicionar todos os arquivos necessários
e depois basta adicionar apanas este arquivo require_once bootstrap.php
uma vez no topo da página e todos os arquivos necessários estarão lá.

/app/.htaccess
apenas impede o acesso a pasta /app
o código dentro do arquivo Options -Indexes diz para negar o acesso ao indice
ou seja impede que o conteúdo da pasta seja listado
ATENÇÃO - para funcionar tem que entrar no arquivo apache2.conf e alterar a seguinte linha em /var/www e /var/www/html/
AllowOverride All


IMPORTANTE IMPORTANTE
/public/.htaccess
IMPORTANTE
na linha RewriteBase /mvc/public
colocamos o diretório do nosso projeto
se alterar a pasta mvc tem que mudar nesta linha também para funcionar
esse arquivo vai rotear tudo para o arquivo index.php da pasta public
se vc digitar na url 
localhost/mvc/public/teste.php
ele vai redirecionar para 
localhost/mvc/public/index.php
a não ser que o arquivo exista

/.htaccess
Arquivo responsável para tirar o public da url
nosso sistema para o acesso externo está em
/mvc/public/arquivos.php
este arquivo .htaccess faz com que a url fique apenas
/mvc/arquivos.php

Quando quiser incluir algo que está na pasta app utilize a constante APPROOT e quando quiser 
incluir o que está no public use URLROOT




**********************SEQUÊNCIA DE FUNCIONAMENTO**********************************************************
na requisição

/mvc

1 - É chamado o arquivo /public/index.php

2 - O arquivo /public/inidex.php
		require /app/bootstrap.php
		ao qual require todos os arquivos da pasta libraries que incluem
			Controller.php
			Core.php
			Database.php
		por fim cria uma instância da classe Core

3 - A classe Core tem as seguintes propriedades e valores padrão
	currentControler = Pages //equivalente ao que está na pasta /mvc/controllers
	currentMethod = index
	param = []
	executa o que está na construct
	como nada foi passado pela url vai requerer o arquivo com base nos valores padrões das propriedades
	require /app/controllers/Pages.php
	instancia o controller na propriedade currentController
	currentController = new Pages; continua a execução mas aqui continua no item 4
	através da fução call_user_func_array dentro da pasta app/controller executa a classe Pages,metodo index e parâmetro vazio
	a qual o método index é atribuido a variável $posts o resultado da função postModel->getPosts
	a propriedade postmodel é setada na construct da classe pages colocando como valor Post
	sendo assim a variável $posts é atribuido o valor do método Posts->getPosts();
	o método index chama outro método o getPosts() que está no modelo /models/Posts
	que vai retornar o resultado da consulta sql select * from posts para a variável $data	
	depois chama o método view do arquivo /libraries/Controller.php da classe Controller
	que vai requerer/adicionar através do método view
	$this->view('pages/index' ,$data);
	o arquivo require_once '../app/views/pages/index.php'; e os dados através da variável $data



testar só parte acima


4 - Ao instanciar a class Pages no passo anterior
	na classe Pages vai iniciar o que está no contruct
	vai atribuir a uma nova propriedade postModel o resultado do método model()
	que está na classe Controller a qual a classe Pages extends
	então postModel = $this->model('Post');
	que terá como resultado o retorno do método require_once '../app/models/' . $model . '.php';
	ou seja require_once '../app/models/Post.php';

5 - Ao chamar /app/models/Post.php
	irá iniciar a contruct()
	que inicia o banco de dados atribuindo toda a classe Database a propriedade db
	db = new Database;

***********************************************************************************************************




*/
echo "it works";
