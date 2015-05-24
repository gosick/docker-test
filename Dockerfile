FROM ubuntu:14.04

MAINTAINER Author:gosick Email:f56112000@gmail.com

RUN \
	apt-get update && \
	apt-get install -y git wget php5 php5-xsl php5-curl zip vim && \
	git clone https://github.com/gosick/selenium-phpunit-test.git && \
	apt-get autoremove -y && \
	apt-get clean all

ADD run.sh run.sh
RUN chmod +x run.sh
CMD ./run.sh
