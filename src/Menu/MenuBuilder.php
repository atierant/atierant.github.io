<?php

declare(strict_types=1);

namespace App\Menu;

use App\Model\Menu\MenuNode;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Knp\Menu\MenuItem;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Translation\LocaleSwitcher;
use Twig\Environment;

final class MenuBuilder
{
    private ItemInterface $menu;

    /**
     * Add any other dependency you need...
     */
    public function __construct(
        private readonly FactoryInterface $factory,
        private readonly Environment $twig,
        private readonly DenormalizerInterface $denormalizer,
        private readonly RequestStack $requestStack,
        private readonly LocaleSwitcher $localeSwitcher
    ) {
    }

    public function mainMenu(array $options): ItemInterface
    {
        // $globals = $this->twig->getGlobals();
        // $menuItems = $globals['site']['menu'] ?? [];

        // Création du root
        $this->menu = $this->factory->createItem('root');

        // Déclaration en tant que nav
        $this->menu
            ->setChildrenAttribute('id', 'navbar')
            ->setChildrenAttribute('class', 'navbar navbar-dark bg-transparent');

        // build pages
        try {
            //$this->buildPageTree($menuItems);
        } catch (\Exception $e) {
            //dd($e->getMessage());
        }

        $route = $this->requestStack->getMainRequest()->attributes->get('_route');
        if (str_contains($route, 'home')) {
            $homeDropdown = $this->menu
                ->addChild('Home', [
                    /*'route' => 'home',*/
                    'linkAttributes' => [
                        'class' => 'show',
                        'aria-expanded' => 'true',
                    ],
                    'attributes' => [
                        'dropdown' => true,
                        'opened' => true,
                    ],
                ])
                ->setAttribute('icon', 'bi bi-house-door');
            $homeDropdown
                //->addChild('Home', ['route' => 'home', '_fragment' => 'hero',])
                ->addChild('Home', [
                    'uri' => '/' . $this->localeSwitcher->getLocale() . '#hero',
                ])
                ->setAttribute('icon', 'bi bi-house-door-fill');
            $homeDropdown
                ->addChild('Card', [
                    'uri' => '/' . $this->localeSwitcher->getLocale() . '#about',
                ])
                ->setAttribute('icon', 'bi bi-person-vcard-fill');
            $homeDropdown
                ->addChild('Bio', [
                    'uri' => '/' . $this->localeSwitcher->getLocale() . '#bio',
                ])
                ->setAttribute('icon', 'bi bi-person-bounding-box');
            $homeDropdown
                ->addChild('Skills', [
                    'uri' => '/' . $this->localeSwitcher->getLocale() . '#skills',
                ])
                ->setAttribute('icon', 'bi bi-capsule');
            $homeDropdown
                ->addChild('Resume', [
                    'uri' => '/' . $this->localeSwitcher->getLocale() . '#resume',
                ])
                ->setAttribute('icon', 'bi bi-file-earmark-person-fill');
            $homeDropdown
                ->addChild('Contact', [
                    'uri' => '/' . $this->localeSwitcher->getLocale() . '#contact',
                ])
                ->setAttribute('icon', 'bi bi-envelope');
            $homeDropdown
                ->addChild('About this website', [
                    'uri' => '/' . $this->localeSwitcher->getLocale() . '#tech',
                ])
                ->setAttribute('icon', 'bi bi-gear-fill');
        } else {
            // create Home menu item
            $this->menu
                ->addChild('Home', [
                    'route' => 'home',
                ])
                ->setAttribute('icon', 'bi bi-house-door');
        }

        // create Article menu item
        $this->menu
            ->addChild('Articles', [
                'route' => 'app_article_list',
            ])
            ->setAttribute('icon', 'bi bi-newspaper');

        // create Article menu item
        $this->menu
            ->addChild('Full Resume', [
                'route' => 'resume',
            ])
            ->setAttribute('icon', 'bi bi-person-badge-fill');

        // create Article menu item
        $this->menu
            ->addChild('Projects', [
                'route' => 'projects',
            ])
            ->setAttribute('icon', 'bi bi-cast');

        // create Article menu item
        $this->menu
            ->addChild('Tools & links', [
                'route' => 'app_tools_list',
            ])
            ->setAttribute('icon', 'bi bi-tools');

        // create Article menu item
        $this->menu
            ->addChild('Find me', [
                'route' => 'contact',
            ])
            ->setAttribute('icon', 'bi bi-hdd-network-fill');

        return $this->menu;
    }

    /**
     * @param MenuItem $menuItem
     *
     * @throws \Exception
     */
    private function buildPageTree(array $nodes, ?MenuNode $parent = null, $menuItem = null): void
    {
        /** @var MenuNode $node */
        foreach ($nodes as $node) {
            $node = $this->denormalizer->denormalize($node, MenuNode::class);

            // If page doesn't have a parent, and no menuItem was passed then this is a top level add.
            if (empty($node->getParentObject()) && empty($menuItem)) {
                $parentMenu = $this->menu->addChild($node->getName(), $node->getOptions());
            }

            // if the current page's parent is === supplied parent, go deeper
            if ($node->getParentObject() === $parent) {
                // if a menuItem was given, then this page is a child so added it to the provided menu.
                if (! empty($menuItem)) {
                    $parentMenu = $menuItem->addChild($node->getName(), $node->getOptions());
                }

                // go deeper
                $this->buildPageTree($nodes, $node, $parentMenu);
            }
        }
    }
}
