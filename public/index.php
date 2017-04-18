<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require "../vendor/autoload.php";

$config["displayErrorDetails"] = true;

$app = new \Slim\App(["settings" => $config]);

$container = $app->getContainer();

$container["view"] = function ($container) {
    $view = new \Slim\Views\Twig("../templates");
    $basePath = rtrim(str_ireplace("index.php", "", $container["request"]->getUri()->getBasePath()), "/");
    $view->addExtension(new Slim\Views\TwigExtension($container["router"], $basePath));
    return $view;
};

$app->get("/", function (Request $request, Response $response) {
    return $this->view->render($response, "index.html");
});

$app->get("/meer-info", function (Request $request, Response $response) {
    return $this->view->render($response, "meer-info.html");
});

$app->get("/over-ons", function (Request $request, Response $response) {
    return $this->view->render($response, "over-ons.html");
});

$app->get("/contact", function (Request $request, Response $response) {
    return $this->view->render($response, "contact.html");
});

$app->run();