# PHP Phar example scripts

This project contains examples how to use PHP Phar archives. 
Under "[examples](https://github.com/rimelek/phar-examples/tree/master/examples)", 
you can find more folders with examples. Each folder contains a README.md. 
You can read it on GitHub or you can download this PHP application from GitHub
or as a Docker image from [Docker Hub](https://hub.docker.com/r/rimelek/phar-examples/).

When you run it, you will see a dashboard where you can run the examples, 
rebuild them and read the details of the chosen example.

[![Dashboard](https://raw.githubusercontent.com/rimelek/phar-examples/master/dashboard.jpg)](https://github.com/rimelek/phar-examples/blob/master/dashboard.jpg)

# Run it in Docker container

```bash
docker run -it --rm -p 8080:80 rimelek/phar-examples
```

or in the background:

```bash
docker run -it -d -p 8080:80 --name phar-examples rimelek/phar-examples
```
