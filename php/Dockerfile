#Dockerfile

#FROM php
FROM php:fpm-alpine

RUN echo "==========================="; \
    echo "                           "; \
    echo "       P H P               "; \
    echo "                           "; \
    echo "==========================="


ENV PACKAGES apt-utils openssh-server openssh-client
# Install Packages
RUN apt-get update && apt-get install -y $PACKAGES; \
    # Allow SSH Root Login
	sed -i 's|^#PermitRootLogin.*|PermitRootLogin yes|g' /etc/ssh/sshd_config; \
    # Configure root password
	echo "root:root123" | chpasswd

#RUN echo http://repository.fit.cvut.cz/mirrors/alpine/latest-stable/main > /etc/apk/repositories
#RUN echo http://repository.fit.cvut.cz/mirrors/alpine/latest-stable/community >> /etc/apk/repositories
RUN docker-php-ext-install pdo_mysql

#CMD ["php"]
CMD ["php-fpm"]

EXPOSE 9000
