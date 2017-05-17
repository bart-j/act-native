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
    return $this->view->render($response, "index.html", [
        "rules" => file_get_contents("../backend/data/ProfielSpraak.txt")
    ]);
});

$app->post("/decide", function (Request $request, Response $response) {
    $input = $request->getParsedBody();
    
    $input["description"] = ucwords($input["description"]);
    $input["description"] = str_replace("\"", "", $input["description"]);
    $input["description"] = str_replace("'", "", $input["description"]);

    if (!in_array($input["country"], ["Taiwan", "China", "India", "Nederland"])) {
        throw new Exception("Invalid input.");
    }

    $description = escapeshellarg($input["description"]);
    $country = escapeshellarg($input["country"]);

    exec("/app/backend/execute.sh $description $country", $result);

    return $response->withJson([
        "result" => implode("<br />", array_slice($result, -3))
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