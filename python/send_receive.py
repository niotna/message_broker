import pika

# Se connecter à RabbitMQ
connection = pika.BlockingConnection(pika.ConnectionParameters('172.25.0.2'))
channel = connection.channel()

# Déclarer une queue
channel.queue_declare(queue='my_queue_py')

# Envoyer un message à la queue
channel.basic_publish(exchange='', routing_key='my_queue_py', body='Hello World')

# Recevoir un message de la queue
method_frame, header_frame, body = channel.basic_get(queue='my_queue_py', auto_ack=True)
if method_frame:
    print(body)

# Fermer la connexion RabbitMQ
connection.close()
