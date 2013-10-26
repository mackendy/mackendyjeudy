<?php

use \app\Router;

Router::connect('post/:slug-:id','posts/view/id:([0-9]+)/slug:([a-z0-9\-\_]+)');
Router::connect('page/:slug-:id','pages/view/id:([0-9]+)/slug:([a-z0-9\-\_]+)');
