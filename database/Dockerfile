#Dockerfile

FROM mariadb

RUN echo "==========================="; \
    echo "                           "; \
    echo "       Mariadb             "; \
    echo "                           "; \
    echo "==========================="

CMD ["mysqld"]

ENV PACKAGES openssh-server openssh-client
# Install Packages
RUN apt-get update && apt-get install -y $PACKAGES; \
# Allow SSH Root Login
	sed -i 's|^#PermitRootLogin.*|PermitRootLogin yes|g' /etc/ssh/sshd_config; \
# Configure root password
	echo "root:root123" | chpasswd

EXPOSE 3306