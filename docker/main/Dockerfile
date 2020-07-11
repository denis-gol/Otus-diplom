FROM nginx:latest

RUN apt-get update && apt-get install -y \
    git \
    htop \
    mc

WORKDIR /var/www/site.local
CMD ["nginx", "-g", "daemon off;"]
