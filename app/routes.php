<?php

/*
 * This route site
 */

$app->get('/xxx' , function() use ($app) {
	$app->render('index.html');
});