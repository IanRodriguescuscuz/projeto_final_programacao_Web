## 👥 Autores

Trabalho desenvolvido para a disciplina de **Programação Web**.

* **Ian** - RGM: 42942471
* **Ismael** - RGM: 42330254
* **Nobre** - RGM: 42976154
# 🎣 Pesca e Prosa - Sistema Web

Sistema de gerenciamento de pescas e inventário de peixes desenvolvido em PHP. O projeto conta com um Painel Administrativo para cadastro de espécies e uma Área do Usuário para simular a pesca e gerenciar o cesto pessoal.

## 🔑 Acessos de Teste

O sistema utiliza login simplificado (apenas email, sem senha). Utilize as credenciais abaixo para testar os diferentes níveis de acesso:

**1. Acesso Admin (Painel de Controle)**
* **Email:** `daniel@brandao.com`
* **Função:** Acesso total para gerenciar peixes, visualizar usuários e excluir registros.

**2. Acesso Cliente (Área de Pesca)**
* **Email:** `perdi80k@dasilva.com`
* **Função:** Acesso à vitrine de peixes, adicionar itens ao cesto pessoal e devolver peixes.

## 🚀 Tecnologias Utilizadas

* **Frontend:** HTML, CSS, PHP.
* **Backend:** PHP (Estrutural).
* **Banco de Dados:** MySQL / MariaDB.
* **Servidor:** Apache (via XAMPP/LAMPP).

## 📂 Estrutura do Projeto

* `/backend`: Contém a lógica administrativa e conexão com banco.
* `/frontend`: Contém a interface pública e área do usuário.
* `/database`: Contém o script SQL para importação do banco.

## 🛠️ Como rodar o projeto localmente

### Pré-requisitos
* Ter o **XAMPP** (Windows/Linux) ou ambiente similar instalado.

### Passo 1: Clonar e Mover
1.  Clone este repositório ou baixe o ZIP.
2.  Mova a pasta do projeto para dentro do diretório do servidor:
    * **Linux:** `/opt/lampp/htdocs/`
    * **Windows:** `C:\xampp\htdocs\`

### Passo 2: Configurar o Banco de Dados
1.  Abra o **phpMyAdmin** (geralmente em `http://localhost/phpmyadmin`).
2.  Crie um novo banco de dados com o nome exato: `banco_de_dados_peixes`.
3.  Vá na aba **Importar**, selecione o arquivo que está na pasta `/database/banco.sql` deste projeto e execute.

### Passo 3: Configurar Conexão (Opcional)
O arquivo de conexão está em `backend/config/conexao.php`.
Por padrão, ele está configurado para XAMPP:
* Usuário: `root`
* Senha: (vazia)
* Host: `localhost`

Se seu MySQL tiver senha, edite este arquivo.

### Passo 4: Permissões de Pasta (Apenas Linux)
Para que o upload de imagens dos peixes funcione corretamente no Linux, você precisa dar permissão de escrita na pasta de assets. Abra o terminal e rode:

```bash
sudo chmod -R 777 /opt/lampp/htdocs/SEU_PROJETO/frontend/assets/
