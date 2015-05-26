HUB_NAME := selenium-hub
NODE_CHROME := chrome-node
NODE_CHROME_DEBUG := chrome-node-debug
NAME_SELENIUM := selenium
VERSION := 2.45.0
GIT_NAME := selenium-phpunit-test
GIT_URL := https://github.com/gosick/$(GIT_NAME).git
REPOSITORY_PATH := /home/testing/selenium-phpunit-test
TEST_IN_DOCKER_PATH := /selenium-phpunit-test
HOST := $(shell ifconfig | grep -A 1 'eth0' | tail -1 | cut -d ':' -f 2 | cut -d ' ' -f 1)
PORT := 4444



all:

	@echo -------------------------------------------------------------------------------
	@echo -- usage:
	@echo --
	@echo --
	@echo \* make install
	@echo \*  =====\> checking docker status, pulls selenium images,
	@echo \*  =====\> pulls test from git, runs selenium hub and chrome node
	@echo -------------------------------------------------------------------------------

	@echo \*  make build test=[test name] ex: make build test=air
	@echo \*  =====\> builds test from git folder to docker images
	@echo -------------------------------------------------------------------------------

	@echo \*  make test test=[test name] ex: make test test=air
	@echo \*  =====\> runs test , if does not exist test images, do nothing
	@echo -------------------------------------------------------------------------------

	@echo \*  Label do:
	@echo \*
	@echo \*  check_docker_install:
	@echo \*  =====\> checks operating system is Linux, and checks docker installation
	@echo \*
	@echo \*  run_hub:
	@echo \*  =====\> checks hub container existence, and run or restart hub
	@echo \*
	@echo \*  run_selenium:
	@echo \*  =====\> will use run_hub and then check node to run or restart
	@echo \*
	@echo \*  pull_test_from_git:
	@echo \*  =====\> git clone the test, see GIT_NAME and GIT_URL
	@echo \*
	@echo \*  pull_selenium:
	@echo \*  =====\> pull selenium images
	@echo \*
	@echo \*  docker_uninstall:
	@echo \*  =====\> uninstall docker.io
	@echo -------------------------------------------------------------------------------


install: check_docker_install pull_selenium pull_test_from_git run_selenium



check_docker_install:

ifeq "$(shell uname -s)" "Linux"

ifeq "$(shell which docker)" ""

	@echo can not find docker, now installing docker
	@sudo apt-get update
	@sudo apt-get install -y docker.io

else

	@echo docker has installed

endif

endif


run_hub:

ifneq "$(shell sudo docker inspect '$(HUB_NAME)' | grep 'Image' |  grep '$(NAME_SELENIUM)/hub:$(VERSION)')" ""

	@echo selenium hub container exists, check container status

ifneq "$(shell sudo docker inspect '$(HUB_NAME)' | grep 'Running' | grep 'false')" ""

	@echo selenium hub container exited, restarting hub
	@sudo docker restart $(HUB_NAME)

else

	@echo selenium hub container is running

endif

else

	@echo selenium hub container does not exist, starts selenium hub
	@sudo docker run -d -p $(PORT):$(PORT) --name $(HUB_NAME) $(NAME_SELENIUM)/hub:$(VERSION)

endif


run_selenium: run_hub

ifneq "$(shell sudo docker inspect '$(NODE_CHROME)' | grep 'Image' | grep '$(NAME_SELENIUM)/node-chrome:$(VERSION)')" ""

	@echo chrome node container exists, check container status

ifneq "$(shell sudo docker inspect '$(NODE_CHROME)' | grep 'Running' | grep 'false')" ""

	@echo chrome node container exited, restarted chrome node
	@sudo docker restart $(NODE_CHROME)

else

	@echo chrome node container is running

endif

else

	@echo chrome node container does not exist, starts chrome node
	@sudo docker run -d --link $(HUB_NAME):hub --name $(NODE_CHROME) $(NAME_SELENIUM)/node-chrome:$(VERSION)

endif


build:

ifeq "$(shell sudo docker inspect '$(test)' | grep 'Image')" ""

	@cd $(GIT_NAME) && sudo docker build -t $(test) .

endif



pull_test_from_git:

	@echo pull test from $(GIT_URL)
	@-git clone $(GIT_URL)


test:

ifneq "$(shell sudo docker inspect '$(test)' | grep 'Image' | grep '$(test)')" ""

	@echo $(test) container exist, check container status

ifneq "$(shell sudo docker inspect '$(test)' | grep 'Running' | grep 'false')" ""

	@echo $(test) container exited, restart $(test)
	@sudo docker restart $(test)

else

	@echo $(test) container is running

endif

else

	@echo $(test) container does not exist, starts $(test)
	@sudo docker run -d -v $(REPOSITORY_PATH):$(TEST_IN_DOCKER_PATH) -e host=$(HOST) -e port=$(PORT) --name $(test) $(test)

endif


run_node_chrome_debug:

	@-sudo docker run -d -P --link $(HUB_NAME):hub --name $(NODE_CHROME_DEBUG) $(NAME_SELENIUM)/node-chrome-debug:$(VERSION)


pull_selenium: hub node_chrome node_chrome_debug



hub:

	@sudo docker pull $(NAME_SELENIUM)/hub:$(VERSION)


node_chrome:

	@sudo docker pull $(NAME_SELENIUM)/node-chrome:$(VERSION)


node_chrome_debug:

	@sudo docker pull $(NAME_SELENIUM)/node-chrome-debug:$(VERSION)


docker_uninstall:

	@sudo apt-get autoremove -y docker.io


