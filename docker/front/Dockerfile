FROM node:14.16.1

RUN apt update

RUN npm install -g @vue/cli

RUN apt-get install -y sudo

# 1000番で作業したいのに既にnodeが1000なので変更
RUN usermod  -u 1001 node
RUN groupmod -g 1001 node

# Windows 専用
ENV USER docker
ARG GID
ARG UID

RUN groupadd -g ${GID} docker
RUN useradd -u ${UID} -g ${GID} -s /bin/bash -m docker
RUN gpasswd -a ${USER} sudo
RUN echo "${USER}:passwd" | chpasswd

WORKDIR /

RUN mkdir /app

# 俺にもファイル作らせろや権限
RUN chmod -R 777 /app

WORKDIR /app
USER ${USER}

CMD ["bash"]