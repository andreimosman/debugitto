# debugitto

This is a very simple way to debug PHP applications without generating output directly to the browser.

## Installation

### Via composer:

```
composer require andreimosman/debugitto
```

### Download

You can download at `https://github.com/andreimosman/debugitto` and just include `src/Debug.php`

## Usage

### On your environment

Once you included or required the main file via `vendor/autoload.php` or direct on your application, you can use it by:

```
// ...

use AndreiMosman\Debugitto\Debugitto;

Debugitto::enable('localhost', 9900);
Debugitto::d('This is my beautiful output');

// ...
```

Of course, you should listen on `localhost` port `9900` to make it work.

You can do it on your machine using netcat:

```
nc -kl 9900
```

### Inside a docker container

By default, the host is set to `host.docker.internal` (which refers, from the perspective of the container, to your docker server, outside the container) and the port to `9900`.

So, once you included manually or via composer autoload, you can add to your code:

```

use AndreiMosman\Debugitto\Debugitto;

Debugitto::enable();
Debugitto::d('Message sent from the container');


```

## print_r by default

The code below:

```
<?php

require_once('vendor/autoload.php'); // Check your path, please.

use AndreiMosman\Debugitto\Debugitto as D;

D::enable('127.0.0.1', 9900);

$myVariable = ['a' => 1, 'b' => 2, 'c' => 3];

D::d('My super dupper variable');
D::d($myVariable);


```

Will output:

```
My super duper variable
Array
(
    [a] => 1
    [b] => 2
    [c] => 3
)

```

