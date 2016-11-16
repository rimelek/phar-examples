# PHP Phar example scripts

This project contains examples how to use PHP Phar archives. Under "[examples](examples)", 
you can find more folders with examples. Each folder contains a README.md. 
You can read it on github or you can download this PHP application from github
or as a Docker image from [Docker Hub](https://hub.docker.com/r/rimelek/phar-examples/). The image Based on alpine linux to keep it 
very small.

When you run it, you will see a dashboard where you can run the examples, 
rebuild them and read the details of the chosen example.

[![Dashboard](https://raw.githubusercontent.com/rimelek/phar-examples/master/dashboard.jpg)](https://github.com/rimelek/phar-examples/blob/master/dashboard.jpg)

# Run it in Docker container

```
docker run -it --rm -p 8080:80 rimelek/phar-examples
```

or in the background:

```
docker run -it -d -p 8080:80 --name phar-examples rimelek/phar-examples
```
