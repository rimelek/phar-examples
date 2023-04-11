# PHP Phar example scripts

This project contains examples how to use PHP Phar archives. 
Under "[examples](https://github.com/itsziget/phar-examples/tree/master/examples)", 
you can find more folders with examples. Each folder contains a README.md. 
You can read it on GitHub or you can download this PHP application from GitHub
or as a Docker image from [Docker Hub](https://hub.docker.com/r/itsziget/phar-examples/). The image Based on alpine linux to keep it 
very small.

When you run it, you will see a dashboard where you can run the examples, 
rebuild them and read the details of the chosen example.

[![Dashboard](https://raw.githubusercontent.com/itsziget/phar-examples/master/dashboard.jpg)](https://github.com/itsziget/phar-examples/blob/master/dashboard.jpg)

# Run it in Docker container

```bash
docker run -it --rm -p 8080:80 itsziget/phar-examples
```

or in the background:

```bash
docker run -it -d -p 8080:80 --name phar-examples itsziget/phar-examples
```
