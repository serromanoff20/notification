FROM ubuntu:20.04
ENV TZ=Europe/Samara
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update
RUN apt-get -y install cron
RUN apt-get -y install sudo
RUN sudo apt-get -y install \
        ca-certificates \
        curl \
        gnupg \
        lsb-release
RUN curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

RUN echo \
      "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu \
      $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

RUN apt-get update
RUN apt-get -y install docker-ce docker-ce-cli containerd.io

COPY docker-entrypoint.sh /

RUN chmod 0644 /docker-entrypoint.sh

# Copy crontab file to the cron.d directory
COPY crontab /etc/cron.d/crontab

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/crontab

# Apply cron job
RUN crontab /etc/cron.d/crontab

#CMD ["cron", "-f", "-l", "2"] пока без него прекрасно всё работает
CMD ["cron", "-f"]
