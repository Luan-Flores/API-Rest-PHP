Projeto: API RESTful com PHP Puro e JWT
Esta API foi desenvolvida do zero utilizando PHP puro para um sistema de gerenciamento de reservas. A arquitetura foi projetada para ser simples e eficiente, focando na lógica de roteamento e na manipulação de dados. Para garantir a portabilidade e facilitar o deploy, a aplicação foi conteinerizada com Docker.

Tecnologias e Ferramentas Utilizadas
PHP Puro: A base da API, sem o uso de frameworks, o que permitiu um controle total sobre o fluxo de requisições e a lógica de negócio.

PostgreSQL: Banco de dados relacional robusto, usado para armazenar informações sobre clientes, serviços e reservas.

PDO (PHP Data Objects): Uma extensão do PHP que fornece uma interface leve e consistente para acesso a bancos de dados, garantindo consultas seguras contra SQL Injection.

JWT (JSON Web Tokens): Implementado para a criação de um sistema de autenticação seguro. Os tokens JWT são gerados no login e validados em cada requisição para acesso a rotas protegidas.

Docker: Ferramenta de conteinerização utilizada para empacotar a aplicação e suas dependências (como o servidor web e o banco de dados), garantindo um ambiente de desenvolvimento e deploy consistente.

Insomnia e .http: O Insomnia foi utilizado durante o desenvolvimento para testar os endpoints da API de forma interativa. Um arquivo .http foi criado para documentar e facilitar a execução de todas as requisições da API.

Endpoints da API
A API expõe os seguintes endpoints, permitindo operações CRUD completas:

Autenticação:

POST /api/login: Autentica um usuário e retorna um JWT.

Clientes:

GET /api/clientes: Lista todos os clientes.

POST /api/clientes: Adiciona um novo cliente.

GET /api/clientes/{id}: Busca um cliente específico.

PUT /api/clientes/{id}: Atualiza um cliente existente.

DELETE /api/clientes/{id}: Deleta um cliente.

Serviços:

GET /api/servicos: Lista todos os serviços.

POST /api/servicos: Adiciona um novo serviço.

GET /api/servicos/{id}: Busca um serviço específico.

PUT /api/servicos/{id}: Atualiza um serviço existente.

DELETE /api/servicos/{id}: Deleta um serviço.

Reservas:

GET /api/reservas: Lista todas as reservas.

POST /api/reservas: Cria uma nova reserva.

GET /api/reservas/{id}: Busca uma reserva específica.

PUT /api/reservas/{id}: Atualiza uma reserva existente.

DELETE /api/reservas/{id}: Deleta uma reserva.

