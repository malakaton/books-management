# Requirements

To use this docker-compose.yml, you will need:

- Docker engine > 19.03
- docker-compose > 1.26

Both are available in the [Docker official site](https://docs.docker.com/install/)_. All tests were performed with Docker CE.

## Project set up

Install and run the application.
```
docker/up
```

You are done, you can visit application on the following URL: `http://symfony.localhost:80`

If you want close docker compose, run this:

```bash
$ docker-compose down
```

# How it works?

Here are the `docker-compose` built images:

* `mysql`: This is the MySQL database container,
* `mysql1`: This is the MySQL database container for testing environment,
* `php`: This is the PHP-FPM container including the application volume mounted on,
* `nginx`: This is the Nginx webserver container in which php volumes are mounted too,
* `elasticsearch`: This is the Elasticsearch container,
* `kibana`: This is the kibana container,
* `logstash`: This is the logstash container,

This results in the following running containers:

```bash
> $ docker-compose ps
             Name                           Command               State                 Ports
-----------------------------------------------------------------------------------------------------------
books-management_php_1              docker-php-entrypoint php-fpm   Up              9000/tcp            
books-management_mysql_1            docker-entrypoint.sh mysqld     Up              3306/tcp, 33060/tcp
books-management_nginx_1            nginx -g daemon off;            Up              0.0.0.0:80->80/tcp
elasticsearch                      /usr/local/bin/docker-entr ...   Up              0.0.0.0:9200->9200/tcp, 9300/tcp 
kibana                             /usr/local/bin/dumb-init - ...   Up              0.0.0.0:81->5601/tcp             
logstash                           /usr/local/bin/docker-entr ...   Up              5044/tcp, 9600/tcp   
```

# Run the app and see code coverage

Use Postman or other IDE to run the endpoints:
* GET: http://symfony.localhost:80/book/{id}
* POST: http://symfony.localhost:80/book

Both endpoints can accept request and resource in JSON/XML format

Put correct content-type header: application/xml or application/json

> Example request in json format:

```json
{
  "book": {    
    "author_uuid": "70f066f6-1cb7-4c45-97e2-287f0258ba02",
    "title": "Test master",
    "description": "How to be a noob master tester",
    "content": "Best advices to be the best tester in the world"
  }
}
```
> Example request in xml format:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<root>
   <book>
      <author_uuid>70f066f6-1cb7-4c45-97e2-287f0258ba02</author_uuid>
      <content>Best advices to be the best tester in the world</content>
      <description>Test for noob</description>
      <title>Test master</title>
   </book>
</root>
```

Also, you can see a link to show a report of the code coverage done by php unit.

To run test and reports for see code coverage.

Run tests
```
docker/test
```

You can see reports on, http://symfony.localhost:80


![Alt Text](https://64.media.tumblr.com/723987e60ebfffeb744f84fa92e52245/tumblr_neglojBBbo1sx56xso1_400.gif)
<br>
"We are amidst strange beings, in a strange land."
<br><br>
Solaire De Astora
