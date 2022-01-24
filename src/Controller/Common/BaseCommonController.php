<?php

namespace MvcSkillet\Controller\Common;

use MvcSkillet\Component\Template\BaseTemplateExtension;
use MvcSkillet\Component\Validation\Rules;
use MvcSkillet\Config;
use MvcSkillet\Http\Request;
use MvcSkillet\Http\Response;
use Twig;

class BaseCommonController extends \MvcSkillet\Controller\AbstractController {

    protected \Twig\Environment $_template;

    public function __construct(Request $request, Response $response, string $baseTemplatePath) {
        parent::__construct($request, $response);
        $this->_initialize();

        $templateOptions          = ['cache' => new Twig\Cache\FilesystemCache(PROJECT_SOURCE . 'cache/twig')];
        $templateOptions['debug'] = Config::isDevMode();
        $this->_template          = new Twig\Environment(
            new Twig\Loader\FilesystemLoader($baseTemplatePath),
            $templateOptions
        );
        $this->_template->addExtension(new BaseTemplateExtension());
    }

    public function default(): Response {
        return $this->_response->setData('Not found')
            ->setStatus(404);
    }

    protected function _initialize() {
        parent::_initialize();
    }

    protected function _authorizeRequest() {

    }

    public function index() {
        return $this->generateHtmlResponse('page/main/index.twig');
    }


    public function end(): void {
        // TODO: Implement end() method.
    }

    protected function generateHtmlResponse(string $name, array $templateData = [], int $status = 200): Response {
        return $this->_response->setStatus($status)
            ->setData($this->_template->render($name, $templateData));
    }
}