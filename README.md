# QuadroSocietarioSymfony

Este projeto foi desenvolvido com **Symfony** e é responsável pelo back-end do sistema de gerenciamento de empresas e sócios. Ele fornece uma API RESTful para realizar operações de CRUD (Criar, Ler, Atualizar, Deletar) sobre as entidades de **Empresa** e **Sócio**, que são consumidas pelo front-end desenvolvido em Angular.

### Principais Funcionalidades

- API para listar, criar, editar e excluir empresas.
- API para listar, adicionar, editar e excluir sócios associados às empresas.
- Integração com um banco de dados PostgreSQL para persistência de dados.

## Requisitos

- **PHP** (versão 8.0 ou superior)
- **Composer** (para gerenciar dependências do PHP)
- **PostgreSQL** (ou outro banco de dados compatível)
- **Symfony CLI** (opcional, para facilitar o desenvolvimento)

## Instalação

Siga as etapas abaixo para clonar e rodar o projeto localmente.

### 1. Clone o repositório:
```bash
git clone https://gitlab.com/simonlucena8/quadro-societario-symfony
```

### 2. Acesse o diretório do projeto:
```bash
cd quadro-societario-symfony
```

### 3. Instale as dependências:
```bash
composer install
```
### 4. Crie um Database local no POSTGRESQL:
Crie um Database PostgreSQL local na porta 5432.

### 5. Configure o banco de dados:
Atualize o arquivo .env com as configurações do banco de dados, como o exemplo abaixo:
```bash
DATABASE_URL="postgresql://usuario:senha@127.0.0.1:5432/quadro_societario"
```

### 6. Execute as migrações para criar as tabelas no banco de dados:
```bash
php bin/console doctrine:migrations:migrate
```
### 7. Inicie o servidor de desenvolvimento:
``` bash
   symfony server:start
```
### 7. Acesse a API no navegador ou Postman:
```bash
   http://localhost:8000
```

## Servidor de Desenvolvimento

Para iniciar o servidor de desenvolvimento, execute o comando `ng serve`. A aplicação estará disponível em `http://localhost:4200/` e será recarregada automaticamente se você fizer alterações nos arquivos do projeto.

## Configuração da API

A aplicação faz requisições para o back-end Symfony. Certifique-se de que a API está rodando corretamente e que a URL da API está configurada no arquivo `src/environments/environment.ts`:
```typescript
export const environment = {
  production: false,
  apiUrl: 'https://localhost:8000'  // URL da API do back-end
};
```

## Estrutura do Código
```
src/
├── Controller/      # Controladores que definem as rotas e manipulam as requisições
├── Entity/          # Entidades que representam as tabelas no banco de dados
├── Repository/      # Repositórios que acessam e manipulam os dados das entidades
```
