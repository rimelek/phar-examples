PHP Phar example scripts
========================

About the project
-----------------

This project contains examples how to use PHP Phar archives. 
Under "[examples](https://github.com/rimelek/phar-examples/tree/master/examples)", 
you can find more folders with examples. Each folder contains a README.md. 
You can read it on GitHub or you can download this PHP application from GitHub
or as a Docker image from [Docker Hub](https://hub.docker.com/r/rimelek/phar-examples/).

When you run it, you will see a dashboard where you can run the examples, 
rebuild them and read the details of the chosen example.

![Dashboard](https://ams03pap005files.storage.live.com/y4mfw4MCLD0ohxT_oJ5XslpmjTgJQlR_3j1TE6rPyxcZ6Z0aaIoZS86y5qBmXci3nx7EnzyAy4reiX19UQHFObH1XCxoUGGUUWzuO8-GLnLRp_bUHOCxZOhGesazmx85RwbvaF9wmYIYUoSOeTuoxUnXGle5uCwfHmoU60f16iaZo7LjSshDGKu7NUvQBUHUSb5?width=1024&height=655&cropmode=none)

Run it in Docker container
--------------------------

```bash
docker run -it --rm -p 8080:80 rimelek/phar-examples
```

or in the background:

```bash
docker run -d -p 8080:80 --name phar-examples rimelek/phar-examples
```

Use a volume if you want to keep the already built examples

```bash
docker run -d -p 8080:80 --name phar-examples -v phar-examples_output:/var/www/html/output rimelek/phar-examples
```

If you clone the repository, you can also use the `run.sh` to make the container available on port 8080

```bash
./run.sh
```

If port 8080 is not available, you can pass another port:

```bash
./run.sh 9090
```

or save a `.env` file with an exported port

```bash
export PORT=9090
```

Note: Export is necessary for `run.sh` to show the URL which can also become clickable in some IDE-s like PHPStorm.

Supported tags
--------------

**Note:** The below table can also contain planned tags that are waiting for to be built and pushed to Docker Hub.
For more accurate information visit the [description on Docker Hub](https://hub.docker.com/r/rimelek/phar-examples/)
which is updated the new images were pushed.

|                               Dockerfile                                | Major | Minor | Patch |
|:-----------------------------------------------------------------------:|:-----:|:-----:|:-----:|
| [Link](https://github.com/rimelek/phar-examples/blob/v2.0.1/Dockerfile) |   2   |  2.0  | 2.0.1 |
| [Link](https://github.com/rimelek/phar-examples/blob/v1.0.0/Dockerfile) |   1   |  1.0  | 1.0.0 |
