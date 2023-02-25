<?php

declare(strict_types=1);

namespace App\Model\Menu;

use App\Model\ChildInterface;

/**
 * This is the standard MenuNode implementation.
 *
 * Menu bundle specific additions:
 *
 * - Link type: Ability to explicitly specify the type of link
 */
class MenuNode extends MenuNodeBase implements MenuOptionsInterface, ChildInterface
{
    /**
     * Parent menu node.
     *
     * @var mixed
     */
    protected ?object $parent = null;

    protected string $locale;

    /**
     * Enum, values determined by ContentAwareFactory.
     */
    protected string $linkType;

    /**
     * The content this menu item points to.
     */
    protected object $content;

    public function setParentObject(object $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getParentObject(): ?object
    {
        return $this->parent;
    }

    /**
     * @return string the loaded locale of this menu node
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set the locale this menu node should be. When doing a flush,
     * this will have the translated fields be stored as that locale.
     *
     * @param string $locale the locale to use for this menu node
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Return the content document associated with this menu node.
     *
     * @return object the content of this menu node
     */
    public function getContent(): object
    {
        return $this->content;
    }

    /**
     * Set the content document associated with this menu node.
     *
     * NOTE: When using doctrine, the content must be mapped for doctrine and
     * be persisted or cascading be configured on the content field.
     *
     * @return MenuNode - this instance
     */
    public function setContent(object $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getOptions(): array
    {
        $options = parent::getOptions();

        return array_merge($options, [
            'linkType' => $this->linkType,
            'content' => $this->getContent(),
        ]);
    }

    /**
     * Get the link type.
     *
     * The link type is used to explicitly determine which of the uri, route
     * and content fields are used to determine the link which will bre
     * rendered for the menu item. If it is empty this will be determined
     * automatically.
     */
    public function getLinkType(): string
    {
        return $this->linkType;
    }

    /**
     * @param string $linkType - one of uri, route or content
     *@see ContentAwareFactory::$validLinkTypes
     *
     * Valid link types are defined in ContenentAwareFactory
     *
     * @see getLinkType
     */
    public function setLinkType(string $linkType)
    {
        $this->linkType = $linkType;
    }
}
