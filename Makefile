HUB_NAME := selenium-hub
NAME_SELENIUM := selenium
VERSION := 2.45.0
GIT_NAME := docker-selenium-phpunit-test
GIT_URL := https://github.com/gosick/$(GIT_NAME).git
HOST := $(shell ifconfig | grep -A 1 'eth0' | tail -1 | cut -d ':' -f 2 | cut -d ' ' -f 1)
PORT := 4444

install: check_docker_install pull_selenium pull_test_from_git

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

check_hub_run:
ifeq "$(shell sudo docker ps | grep $(HUB_NAME))" ""
	@echo null
else
	@echo run
endif

check_hub_container_exist:
ifeq "$(shell sudo docker ps -a | grep $(HUB_NAME))" ""
	@echo null
else
	@echo exist
endif

pull_test_from_git:
	@echo pull test from $(GIT_URL)
	@git clone $(GIT_URL)

build_test_image:
	#first to the source exists
	#else echo test doesn't exist
	@cd $(GIT_NAME)/testfile && sudo docker build -t $(test) .

test: build_test_image run_hub run_node_chrome run_test

run_test:
	@sudo docker run -d -v /home/testing/docker-test/selenium-phpunit-test:/selenium-phpunit-test -e host=$(HOST) -e port=$(PORT) $(test)

stop_test:
	@sudo docker stop $(test)
run_hub:
	@sudo docker run -d -p $(PORT):$(PORT) --name $(HUB_NAME) $(NAME_SELENIUM)/hub:$(VERSION)
run_node_chrome:
	@sudo docker run -d --link $(HUB_NAME):hub $(NAME_SELENIUM)/node-chrome:$(VERSION)
run_node_chrome_debug:
	@sudo docker run -d -P --link $(HUB_NAME):hub $(NAME_SELENIUM)/node-chrome-debug:$(VERSION)

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
