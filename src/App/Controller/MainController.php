<?php

namespace OpenCCK\App\Controller;

use OpenCCK\Domain\Entity\Site;
use OpenCCK\Domain\Factory\SiteFactory;

class MainController extends AbstractIPListController {
    /**
     * @var array<string, array<string, Site>>
     */
    private array $groups = [];

    /**
     * @return string
     */
    public function getBody(): string {
        $this->setHeaders(['content-type' => 'text/html; charset=utf-8']);

        foreach ($this->service->sites as $siteEntity) {
            $this->groups[$siteEntity->group][$siteEntity->name] = $siteEntity;
        }

        return $this->renderTemplate('index');
    }

    /**
     * @param string $template
     * @return string
     */
    private function renderTemplate(string $template): string {
        ob_start();
        include PATH_ROOT . '/src/App/Template/' . ucfirst($template) . 'Template.php';
        return ob_get_clean();
    }
}
