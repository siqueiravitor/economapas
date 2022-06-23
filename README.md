# economapas

#1
Para rodas o sistema é necessário ter o Xampp instalado na máquina e o MySQL Workbench

#2
Com o xampp instalado, iniciar os modulos: Apache (Para rodar o projeto localmente) e MySQL (Para iniciar o Bando de Dados)

#3
Iniciar MySQL Workbench e, para a criação do banco de dados, o arquivo (bancoDeDados.txt) encontra-se na pasta "BD"

#4
Adicionar conexão local ao MySQL:

1.Dados padrão ao criar nova conexão;
2.Senha padrão é vazia;

ConnectionName: localhost
Hostname: 127.0.0.1
Port: 3306
username: root
password: 

#5
Aberto o arquivo, deverá ser copiado os códigos e inserido no MySQL workbench, e então sê-los executados
A tabelas serão geradas e serão inseridos dois usuários no banco

1.
login: joao
senha: 1234

2.
login: maria
senha: 5678

#6
A pasta com os arquivos deverá ser colocada dentro da pasta htdocs, localizado na pasta do Xampp
Por padrão se encontra no caminho: "C:\xampp\htdocs";
Ficaria, por exemplo: "C:\xampp\htdocs\economapas";

#7
Feito todos os procedimentos anteriores, deverá ser acessado, em um navegador, a url: "localhost/economapas"

#
