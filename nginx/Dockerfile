#Dockerfile


#FROM nginx:alpine
FROM nginx

RUN echo "==========================="; \
    echo "                           "; \
    echo "       NGINX               "; \
    echo "                           "; \
    echo "==========================="

CMD ["nginx"]

ENV PACKAGES apt-utils openssh-server openssh-client
# Install Packages
RUN apt-get update && apt-get install -y $PACKAGES; \
	# Allow SSH Root Login
	sed -i 's|^#PermitRootLogin.*|PermitRootLogin yes|g' /etc/ssh/sshd_config; \
	# Configure root password
	echo "root:root123" | chpasswd

EXPOSE 80 443 3306


