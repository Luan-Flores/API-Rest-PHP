# Usa uma imagem oficial do PHP com Apache
FROM php:8.2-apache

# Define o diretório de trabalho dentro do contêiner
WORKDIR /var/www/html

# Copia todos os arquivos da sua aplicação para o contêiner
COPY . /var/www/html/

# Ativa o módulo de rewrite do Apache
RUN a2enmod rewrite

# Instala dependências do PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev

# Instala as extensões PHP que sua aplicação precisa
RUN docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql

# O Apache está configurado para expor a porta 80 por padrão
EXPOSE 80

# O comando para iniciar o Apache já vem na imagem base
