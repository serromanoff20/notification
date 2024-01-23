#Install image php
FROM bitnami/php-fpm:8.3.1

# Updates packages list for the image
RUN apt-get update

# gnupg
RUN apt-get install -y gnupg2 gnupg gnupg1

# g++
RUN apt-get install -y g++

# build-essential
RUN apt-get install -y build-essential

# Installs transport HTTPS
RUN apt-get install -y curl apt-transport-https

# Retrieves packages from Microsoft
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
#RUN curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list
RUN curl https://packages.microsoft.com/config/ubuntu/22.04/prod.list > /etc/apt/sources.list.d/mssql-release.list

# Updates packages for the image
RUN apt-get update

# Installs SQL drivers and tools
RUN ACCEPT_EULA=Y apt-get install -y msodbcsql17 unixodbc-dev

#PDO
RUN pecl install sqlsrv pdo_sqlsrv

#set rule for artisan
#RUN chmod -x /app/service/artisan
#RUN chmod 777 /app/service/artisan

RUN echo extension=pdo_sqlsrv >> /opt/bitnami/php/etc/php.ini
RUN echo extension=sqlsrv >> /opt/bitnami/php/etc/php.ini