<?php
require_once(__DIR__.'/vendor/autoload.php');

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Pug\Pug;

class PugRenderer 
{
    private $pug;
    private $templatePath;

    public function __construct($templatePath, array $configs = []) {
        $this->pug = new \Pug\Pug($configs);
        $this->templatePath = $templatePath;
    }

    public function render ($response, $file, $args = []) {
        $html = $this->pug->render($this->templatePath.'/'.$file, $args);

        return $response->getBody()->write($html);
    }
}

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ],
]);

$container = $app->getContainer();
$container['renderer'] = new PugRenderer(__DIR__.'/templates/', [
    'prettyprint' => true,
    'extension' => '.pug',
    'expressionLanguage' => 'js',
    'cache' => __DIR__.'/caches'
]);

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
    return $this->renderer->render($response, "test.pug", ['pageTitle' => '412 Shop', 'items' => [
        [
            'name' => 'test',
            'image' => 'test',
            'left' => 4
        ]
    ]]);
});

$app->run();
