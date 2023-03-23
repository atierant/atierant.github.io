<?php

declare(strict_types=1);

namespace App\Model\Menu;

use Knp\Menu\NodeInterface;

/**
 * Provide access to read and write the menu options.
 */
interface MenuOptionsInterface extends NodeInterface
{
    /**
     * Return the attributes associated with this menu node.
     */
    public function getAttributes(): array;

    /**
     * Set the attributes associated with this menu node.
     *
     * @return MenuOptionsInterface The item to provide a fluent interface
     */
    public function setAttributes(array $attributes): NodeInterface;

    /**
     * Return the given attribute, optionally specifying a default value.
     *
     * @param string $name    The name of the attribute to return
     * @param string|null $default The value to return if the attribute doesn't exist
     *
     * @return string
     */
    public function getAttribute(string $name, string $default = null): ?string;

    /**
     * Set the named attribute.
     *
     * @param string $name  attribute name
     * @param string $value attribute value
     *
     * @return MenuOptionsInterface The item to provide a fluent interface
     */
    public function setAttribute(string $name, string $value): NodeInterface;

    /**
     * Get the link HTML attributes.
     */
    public function getLinkAttributes(): array;

    /**
     * Set the link HTML attributes as associative array.
     *
     * @return MenuOptionsInterface The item to provide a fluent interface
     */
    public function setLinkAttributes(array $linkAttributes): NodeInterface;

    /**
     * Return the children attributes.
     */
    public function getChildrenAttributes(): array;

    /**
     * Set the children attributes.
     *
     * @return MenuOptionsInterface The item to provide a fluent interface
     */
    public function setChildrenAttributes(array $childrenAttributes): NodeInterface;

    /**
     * Get the label HTML attributes.
     */
    public function getLabelAttributes(): array;

    /**
     * Set the label HTML attributes as associative array.
     *
     * @return MenuOptionsInterface The item to provide a fluent interface
     */
    public function setLabelAttributes(array $labelAttributes): NodeInterface;
}
