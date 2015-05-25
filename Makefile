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

install: check_docker_install pull_selenium pull_test_from_git run_node_chrome


check_docker_install:
ifeq "$(shell uname -s)" "Linux"

ifeq "$(shell which docker)" ""
	@echo can not find docker
	@echo installing docker
	@sudo apt-get update
	@sudo apt-get install -y docker.io
else
	@echo docker has installed
endif
endif

run_hub:
ifeq "$(shell sudo docker ps -a | grep $(HUB_NAME))" ""
	@sudo docker run -d -p $(PORT):$(PORT) --name $(HUB_NAME) $(NAME_SELENIUM)/hub:$(VERSION)
endif
ifneq "$(shell sudo docker ps -a | grep $(HUB_NAME) | grep 'Exited')" ""
	@sudo docker restart $(HUB_NAME)
endif

run_node_chrome: run_hub
ifeq "$(shell sudo docker ps -a | grep '$(NODE_CHROME)')" ""
	@sudo docker run -d --link $(HUB_NAME):hub --name $(NODE_CHROME) $(NAME_SELENIUM)/node-chrome:$(VERSION)
endif
ifneq "$(shell sudo docker ps -a | grep '$(NODE_CHROME)' | grep 'Exited')" ""
	@sudo docker restart $(NODE_CHROME)
endif

build:
ifeq "$(shell sudo docker images | grep '$(test)')" ""
	@cd $(GIT_NAME) && sudo docker build -t $(test) .
endif

pull_test_from_git:
	@echo pull test from $(GIT_URL)
	@-git clone $(GIT_URL)

test: run_test

run_test:
ifeq "$(shell sudo docker ps -a | grep '$(test)')" ""
	@sudo docker run -d -v $(REPOSITORY_PATH):$(TEST_IN_DOCKER_PATH) -e host=$(HOST) -e port=$(PORT) --name $(test) $(test)
endif
ifneq "$(shell sudo docker ps -a | grep '$(test)' | grep 'Exited')" ""
	@sudo docker restart $(test)
endif

run_node_chrome_debug:
	@-sudo docker run -d -P --link $(HUB_NAME):hub --name $(NODE_CHROME_DEBUG) $(NAME_SELENIUM)/node-chrome-debug:$(VERSION)

pull_selenium: selenium

selenium: hub node_chrome node_chrome_debug

hub:
	@sudo docker pull $(NAME_SELENIUM)/hub:$(VERSION)

node_chrome:
	@sudo docker pull $(NAME_SELENIUM)/node-chrome:$(VERSION)

node_chrome_debug:
	@sudo docker pull $(NAME_SELENIUM)/node-chrome-debug:$(VERSION)

docker_uninstall:
	@sudo apt-get autoremove -y docker.io