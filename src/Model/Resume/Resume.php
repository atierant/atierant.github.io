<?php

declare(strict_types=1);

namespace App\Model\Resume;

use App\Model\MetaTrait;
use App\Model\Page;

class Resume
{
    use MetaTrait;

    public ?int $id = null;
    public ?string $subtitle = null;

    public function __construct(
        public string $slug,
        public string $title,
        public string $content,
    ) {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Page
     */
    public function setId(?int $id): Resume
    {
        $this->id = $id;
        return $this;
    }



    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Page
     */
    public function setSlug(string $slug): Resume
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Page
     */
    public function setTitle(string $title): Resume
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    /**
     * @param string $subtitle
     * @return Page
     */
    public function setSubtitle(string $subtitle): Resume
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Page
     */
    public function setContent(string $content): Resume
    {
        $this->content = $content;
        return $this;
    }
}
