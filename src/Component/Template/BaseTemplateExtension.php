<?php

namespace MvcSkillet\Component\Template;

use MvcSkillet\Core;
use MvcSkillet\ServiceLocator;
use Twig;

class BaseTemplateExtension extends Twig\Extension\AbstractExtension {

    private Core\Service\UrlService $_urlService;

    public function __construct() {
        $this->_urlService = ServiceLocator::urlService();
    }

    public function getFunctions(): array {
        return [
            new Twig\TwigFunction('generate_url', [$this, 'generateUrl']),
        ];
    }

    public function generateUrl(string $urlName, array $params = []): string {
        return $this->_urlService->generateUrlByName($urlName, $params);
    }
}