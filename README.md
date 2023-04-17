# PHP Phar example scripts

This project contains examples how to use PHP Phar archives. 
Under "[examples](https://github.com/itsziget/phar-examples/tree/master/examples)", 
you can find more folders with examples. Each folder contains a README.md. 
You can read it on github or you can download this PHP application from github
or as a Docker image from [Docker Hub](https://hub.docker.com/r/itsziget/phar-examples/). The image Based on alpine linux to keep it 
very small.

When you run it, you will see a dashboard where you can run the examples, 
rebuild them and read the details of the chosen example.

![Dashboard](https://ams03pap005files.storage.live.com/y4m64jYmBFX9HooTb_aXEmg0xs-21Zx2HCB5vxtnssuXHfFbu1nV1c6OafI5h1qgzAkvHy0_ekR9QyDmJz5QzTiVC-DVRePamSie5SwS5EsuXlaThbD34SnPPmMPJh6DGFh-Thv0eFlpz9TG0B8mkvldX_5UtuYJs66b3j5x89AoLqKjGKmT6YyC_My18OM5Pn-?width=607&height=436&cropmode=none)

# Run it in Docker container

```bash
docker run -it --rm -p 8080:80 itsziget/phar-examples
```

or in the background:

```bash
docker run -it -d -p 8080:80 --name phar-examples itsziget/phar-examples
```
