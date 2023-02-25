<?php

namespace App\Tests\Unit\Model;

use App\Model\Menu\MenuNode;
use PHPUnit\Framework\TestCase;

class MenuNodeTest extends TestCase
{
    public function setUp(): void
    {
        $c1 = new MenuNode();
        $c1->setLabel('Child 1');
        $c2 = new MenuNode();
        $c2->setLabel('Child 2');
        $this->content = new \stdClass();
        $this->parentNode = new MenuNode();
        $this->node = new MenuNode();
        $this->node
            ->setId('/foo/bar')
            ->setParentObject($this->parentNode)
            ->setName('test')
            ->setLabel('Test')
            ->setUri('http://www.example.com')
            ->setRoute('test_route')
            ->setContent($this->content)
            ->setAttributes(['foo' => 'bar'])
            ->setChildrenAttributes(['bar' => 'foo'])
            ->setExtras(['far' => 'boo'])
            ->setLinkAttributes(['link' => 'knil'])
            ->setLabelAttributes(['label' => 'lebal'])
            ->setRouteAbsolute(true)
            ->setLinkType('linktype');
    }

    public function testGetters()
    {
        $this->assertSame($this->parentNode, $this->node->getParentObject());
        $this->assertEquals('test', $this->node->getName());
        $this->assertEquals('Test', $this->node->getLabel());
        $this->assertEquals('http://www.example.com', $this->node->getUri());
        $this->assertEquals('test_route', $this->node->getRoute());
        $this->assertSame($this->content, $this->node->getContent());
        $this->assertEquals(['foo' => 'bar'], $this->node->getAttributes());
        $this->assertEquals('bar', $this->node->getAttribute('foo'));
        $this->assertEquals(['bar' => 'foo'], $this->node->getChildrenAttributes());
        $this->assertEquals(['far' => 'boo'], $this->node->getExtras());

        $this->parentNode = new MenuNode();
        $this->assertEquals('test', $this->node->getName());
        $this->assertEquals(['link' => 'knil'], $this->node->getLinkAttributes());
        $this->assertEquals(['label' => 'lebal'], $this->node->getLabelAttributes());
        $this->assertTrue($this->node->getRouteAbsolute());
        $this->assertEquals('linktype', $this->node->getLinkType());
    }

    public function testAddChild()
    {
        $c1 = new MenuNode();
        $c2 = new MenuNode();
        $m = new MenuNode();
        $m->addChild($c1);
        $ret = $m->addChild($c2);

        $children = $m->getChildren();
        $this->assertCount(2, $children);
        $this->assertSame($c2, $ret);
    }

    public function testMultilang()
    {
        $n = new MenuNode();
        $n->setLocale('fr');
        $this->assertEquals('fr', $n->getLocale());
    }

    /**
     * @depends testGetters
     */
    public function testGetOptions()
    {
        $this->assertEquals([
            'uri' => $this->node->getUri(),
            'route' => $this->node->getRoute(),
            'label' => $this->node->getLabel(),
            'attributes' => $this->node->getAttributes(),
            'childrenAttributes' => $this->node->getChildrenAttributes(),
            'content' => $this->node->getContent(),
            'routeParameters' => $this->node->getRouteParameters(),
            'routeAbsolute' => $this->node->getRouteAbsolute(),
            'linkAttributes' => $this->node->getLinkAttributes(),
            'labelAttributes' => $this->node->getLabelAttributes(),
            'linkType' => $this->node->getLinkType(),
        ], $this->node->getOptions());
    }
}
