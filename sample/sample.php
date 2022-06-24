<?php

require_once('../vendor/autoload.php');

use AndreiMosman\Debugitto\Debugitto as D;

D::enable('127.0.0.1', 9900);

$myVariable = ['a' => 1, 'b' => 2, 'c' => 3];

D::d('My super dupper variable');
D::d($myVariable);

