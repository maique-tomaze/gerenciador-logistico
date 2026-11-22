# Gerenciador Logístico

Sistema web desenvolvido como Atividade Prática Orientada da disciplina de Fundamentos de Programação para Internet. O sistema organiza produtos, endereços, transportadores e fretes.

## Objetivo

Permitir o cadastro e a consulta de dados logísticos e a criação de fretes relacionando um transportador, uma origem, um destino e vários produtos.

## Funcionalidades

- Cadastrar, listar e editar produtos.
- Cadastrar, listar e editar endereços.
- Cadastrar, listar e editar transportadores.
- Cadastrar fretes com transportador, origem, destino e produtos.
- Informar a quantidade de cada produto transportado.
- Consultar os fretes cadastrados.
- Gerar um relatório diário e exportá-lo em formato CSV.

## Tecnologias utilizadas

- PHP
- MySQL
- HTML
- CSS
- Bootstrap
- JavaScript
- XAMPP

## Estrutura principal

- `index.php`: menu principal do sistema.
- `cadastro_produtos.php` e arquivos de listagem: gestão de produtos.
- `cadastro_enderecos.php` e arquivos de listagem: gestão de endereços.
- `cadastro_transportadores.php` e arquivos de listagem: gestão de transportadores.
- `cadastro_fretes.php`: criação de fretes com vários produtos.
- `listar_fretes.php`: consulta dos fretes cadastrados.
- `relatorio_fretes.php`: consulta diária e exportação CSV.
- `conexao.php`: configuração da conexão com o MySQL.

## Como executar

1. Instale o XAMPP.
2. Inicie os serviços Apache e MySQL.
3. No phpMyAdmin, acesse a aba **SQL**.
4. Importe o arquivo `database.sql` ou cole seu conteúdo no campo de SQL.
5. Confirme que o banco `gerenciador_logistico` e suas cinco tabelas foram criados.
6. Copie a pasta do projeto para `htdocs`.
7. Ajuste o usuário, a senha e o banco em `conexao.php`, se necessário.
8. Acesse `http://localhost/gerenciador-logistico/index.php`.

## Repositório

Este projeto está publicado em: <https://github.com/maique-tomaze/gerenciador-logistico>

## Observação

Projeto desenvolvido para fins acadêmicos.