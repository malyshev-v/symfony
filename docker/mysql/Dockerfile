FROM mysql:5.7
COPY ./my.cnf /etc/mysql/my.cnf
ADD  ./dump.tar.gz /docker-entrypoint-initdb.d
