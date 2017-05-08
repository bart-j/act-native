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

$app->post("/decide", function (Request $request, Response $response) {
    $input = $request->getParsedBody();
    
    if (!in_array($input["rule_country"], ["FRANKRIJK", "DUITSLAND", "NEDERLAND"])) {
        throw new Exception("Invalid input.");
    }

    if (!in_array($input["rule_comparator"], ["bevat", "bevat niet", "is gelijk aan", "is niet gelijk aan"])) {
        throw new Exception("Invalid input.");
    }

    $input["rule_description"] = str_replace("\"", "", $input["rule_description"]);
    $input["rule_description"] = str_replace("'", "", $input["rule_description"]);

    if (!in_array($input["instance_country"], ["FRANKRIJK", "NEDERLAND", "DUITSLAND"])) {
        throw new Exception("Invalid input.");
    }

    $input["instance_description"] = str_replace("\"", "", $input["instance_description"]);
    $input["instance_description"] = str_replace("'", "", $input["instance_description"]);

    $rule = "Maak een score met de volgende parameters:
    - score is HOOG
    indien aan de volgende voorwaarden wordt voldaan:
    - de aangifte heeft rubriek bestemming is gelijk aan \"" . $input["rule_country"] . "\"
    - de aangifte heeft rubriek omschrijving " . $input["rule_comparator"] . " \"" . $input["rule_description"] . "\".";

    $rule = escapeshellarg($rule);
    $instance_country = escapeshellarg($input["instance_country"]);
    $instance_description = escapeshellarg($input["instance_description"]);

    return $response->withJson([
        "result" => exec("/app/backend/execute.sh $rule $instance_country $instance_description")
    ]);
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