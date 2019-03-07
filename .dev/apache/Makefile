BASEJ=base-m1-php70
PJ=tbd_ecommerce/$(BASEJ)
NAME = $(PJ)
PUSHTAG=471421860041.dkr.ecr.eu-central-1.amazonaws.com/$(NAME):latest
PUSHTAGLOCAL=docker.public.triboo.it/$(BASEJ):latest
VERSION = latest

.PHONY: all build 

all: build

push:
	`aws ecr get-login --no-include-email --region eu-central-1`; \
	aws --region eu-central-1 ecr create-repository  --repository-name $(PJ) || true ; \
	docker push $(PUSHTAG)
	docker push $(PUSHTAGLOCAL)

build:
	docker build -t $(NAME):$(VERSION) --rm .; \
	docker tag $(NAME):latest $(PUSHTAG); 
	docker tag $(NAME):latest $(PUSHTAGLOCAL); 
