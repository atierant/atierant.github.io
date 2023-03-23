<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2017 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Model\Menu;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Knp\Menu\NodeInterface;

/**
 * This is a persistable implementation of the KnpMenu NodeInterface.
 */
class MenuNodeBase implements NodeInterface
{
    /**
     * Id of this menu node.
     */
    protected string $id;

    /**
     * Node name.
     *
     * @var string
     */
    protected mixed $name;

    /**
     * Child menu nodes.
     */
    protected Collection $children;

    /**
     * Menu label.
     */
    protected string $label = '';

    protected string $uri;

    /**
     * The name of the route to generate.
     */
    protected string $route;

    /**
     * HTML attributes to add to the individual menu element.
     *
     * e.g. array('class' => 'foobar', 'style' => 'bar: foo')
     */
    protected array $attributes = [];

    /**
     * HTML attributes to add to the children list element.
     *
     * e.g. array('class' => 'foobar', 'style' => 'bar: foo')
     */
    protected array $childrenAttributes = [];

    /**
     * HTML attributes to add to items link.
     *
     * e.g. array('class' => 'foobar', 'style' => 'bar: foo')
     */
    protected array $linkAttributes = [];

    /**
     * HTML attributes to add to the items label.
     *
     * e.g. array('class' => 'foobar', 'style' => 'bar: foo')
     */
    protected array $labelAttributes = [];

    /**
     * Hashmap for extra stuff associated to the node.
     */
    protected array $extras = [];

    /**
     * Parameters to use when generating the route.
     *
     * Used with the "route" option.
     */
    protected array $routeParameters = [];

    /**
     * Set to false to not render.
     */
    protected bool $display = true;

    /**
     * Set to false to not render the children.
     */
    protected bool $displayChildren = true;

    /**
     * Generate an absolute route.
     *
     * To be used with the "content" or "route" option.
     */
    protected bool $routeAbsolute = false;

    public function __construct($name = null)
    {
        $this->name = $name;
        $this->children = new ArrayCollection();
    }

    /**
     * Return ID of this menu node.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets ID of this menu node.
     *
     * @return MenuNodeBase - this instance
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name of this node (used in ID).
     *
     * @return MenuNodeBase - this instance
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Return the label assigned to this menu node.
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Set label for this menu node.
     *
     * @return MenuNodeBase - this instance
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Return the URI this menu node points to.
     *
     * @return string URI
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Set the URI.
     *
     * @return MenuNodeBase - this instance
     */
    public function setUri(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Return the route name.
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * Set the route name.
     *
     * @param string $route - name of route
     *
     * @return MenuNodeBase - this instance
     */
    public function setRoute(string $route): self
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Return the attributes associated with this menu node.
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Set the attributes associated with this menu node.
     *
     * @return MenuNodeBase - this instance
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Return the given attribute, optionally specifying a default value.
     *
     * @param string $name The name of the attribute to return
     * @param string|null $default The value to return if the attribute doesn't exist
     */
    public function getAttribute(string $name, string $default = null): ?string
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }

        return $default;
    }

    /**
     * Set the named attribute.
     *
     * @param string $name attribute name
     * @param string $value attribute value
     *
     * @return MenuNodeBase - this instance
     */
    public function setAttribute(string $name, string $value): self
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * Return the children attributes.
     */
    public function getChildrenAttributes(): array
    {
        return $this->childrenAttributes;
    }

    /**
     * Set the children attributes.
     *
     * @return MenuNodeBase - this instance
     */
    public function setChildrenAttributes(array $attributes): self
    {
        $this->childrenAttributes = $attributes;

        return $this;
    }

    /**
     * Get the child nodes implementing NodeInterface
     *
     * @return \Traversable<int, self>
     */
    public function getChildren(): \Traversable
    {
        $children = new ArrayCollection();
        foreach ($this->children as $child) {
            if (! $child instanceof NodeInterface) {
                continue;
            }
            $children->add($child);
        }

        return $children;
    }

    /**
     * Add a child menu node under this node.
     *
     * @return NodeInterface The newly added child node
     */
    public function addChild(NodeInterface $child): NodeInterface
    {
        $this->children[] = $child;

        return $child;
    }

    /**
     * Remove a child menu node.
     *
     * @return MenuNodeBase $this
     */
    public function removeChild(NodeInterface $child): self
    {
        $this->children->removeElement($child);

        return $this;
    }

    /**
     * Gets the route parameters.
     */
    public function getRouteParameters(): array
    {
        return $this->routeParameters;
    }

    /**
     * Sets the route parameters.
     *
     * @return MenuNodeBase - this instance
     */
    public function setRouteParameters(array $routeParameters): self
    {
        $this->routeParameters = $routeParameters;

        return $this;
    }

    /**
     * Get extra information associated with this node.
     */
    public function getExtras(): array
    {
        return $this->extras;
    }

    /**
     * Set extra information associated with this node.
     *
     * @return MenuNodeBase - this instance
     */
    public function setExtras(array $extras): self
    {
        $this->extras = $extras;

        return $this;
    }

    /**
     * Get the link HTML attributes.
     */
    public function getLinkAttributes(): array
    {
        return $this->linkAttributes;
    }

    /**
     * Set the link HTML attributes as associative array.
     *
     * @return MenuNodeBase - this instance
     */
    public function setLinkAttributes(array $linkAttributes): self
    {
        $this->linkAttributes = $linkAttributes;

        return $this;
    }

    /**
     * Get the label HTML attributes.
     */
    public function getLabelAttributes(): array
    {
        return $this->labelAttributes;
    }

    /**
     * Set the label HTML attributes as associative array.
     *
     * @return MenuNodeBase - this instance
     */
    public function setLabelAttributes(array $labelAttributes): self
    {
        $this->labelAttributes = $labelAttributes;

        return $this;
    }

    /**
     * Whether to generate absolute links for route or content.
     */
    public function getRouteAbsolute(): bool
    {
        return $this->routeAbsolute;
    }

    /**
     * Set whether to generate absolute links when generating from a route
     * or the content.
     *
     * @return MenuNodeBase - this instance
     */
    public function setRouteAbsolute(bool $routeAbsolute): self
    {
        $this->routeAbsolute = $routeAbsolute;

        return $this;
    }

    /**
     * Get the options for the factory to create the item for this node
     *
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return [
            'uri' => $this->getUri(),
            'route' => $this->getRoute(),
            'label' => $this->getLabel(),
            'attributes' => $this->getAttributes(),
            'childrenAttributes' => $this->getChildrenAttributes(),
            'routeParameters' => $this->getRouteParameters(),
            'routeAbsolute' => $this->getRouteAbsolute(),
            'linkAttributes' => $this->getLinkAttributes(),
            'labelAttributes' => $this->getLabelAttributes(),
        ];
    }
}
