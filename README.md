# TP 1

## run docker:

```bash
dc -f docker-compose-py.yml up -d
```

## Envoi / recevoir de messages:

```bash
docker compose exec rabbitmq rabbitmqadmin declare queue name=my_queue
docker compose exec rabbitmq rabbitmqadmin publish exchange=amq.default routing_key=my_queue payload="test"
```

```bash
docker compose exec rabbitmq rabbitmqadmin get queue=my_queue
```

## Envoyer un message avec un exchange fanout:

```bash
docker compose exec rabbitmq rabbitmqadmin declare exchange name=my_exchange type=fanout
```

```bash
docker compose exec rabbitmq rabbitmqadmin declare queue name=my_new_queue
docker compose exec rabbitmq rabbitmqadmin declare binding source=my_exchange destination=my_new_queue
docker compose exec rabbitmq rabbitmqadmin publish exchange=my_exchange routing_key= payload="Hello World"
```

```bash
docker compose exec rabbitmq rabbitmqadmin get queue=my_new_queue
```


## Envoyer un message avec un echange topic:

```bash
docker compose exec rabbitmq rabbitmqadmin declare exchange name=my_topic_exchange type=topic
```

```bash
docker compose exec rabbitmq rabbitmqadmin declare queue name=my_new_new_queue
docker compose exec rabbitmq rabbitmqadmin declare binding source=my_topic_exchange destination=my_new_new_queue routing_key="my.topic.*"
```

```bash
docker compose exec rabbitmq rabbitmqadmin publish exchange=my_topic_exchange routing_key="my.topic.test" payload="Hello World 2"
docker compose exec rabbitmq rabbitmqadmin get queue=my_new_new_queue
```

## troisième partie:

récupérer l'ip de l'hote:

```bash
docker compose exec rabbitmq hostname -I
```

```bash
python ./python/send_receive.py
```

# TP 2

## run docker:

```bash
cd symfony
dc up --build -d
```

```bash
docker exec -it broker_php php bin/console messenger:consume 
```

```bash
curl -X POST -H "Content-Type: application/json" -d '{"task": "Faire les courses"}' http://localhost:8080/tasks 
```

## web accès:

rabbitmq: http://localhost:15672