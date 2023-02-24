<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class Page
{
    use MetaTrait;


    public function __construct(
        public string $slug,
        public string $title,
        public ?string $subtitle,
        public ?string $description,
        public string $content,
        public ?string $image,
        public ?array $images,
        public ?array $tags,
        public ?array $keywords,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
        public \DateTimeInterface $publishedAt,
        public ?\DateTimeInterface $lastModified = null,
    )
    {
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
    public function setSlug(string $slug): Page
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
    public function setTitle(string $title): Page
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
    public function setSubtitle(string $subtitle): Page
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
    public function setContent(string $content): Page
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Page
     */
    public function setDescription(?string $description): Page
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return Page
     */
    public function setImage(?string $image): Page
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @param array|null $tags
     * @return Page
     */
    public function setTags(?array $tags): Page
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getKeywords(): ?array
    {
        return $this->keywords;
    }

    /**
     * @param array|null $keywords
     * @return Page
     */
    public function setKeywords(?array $keywords): Page
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getPublishedAt(): \DateTimeInterface
    {
        return $this->publishedAt;
    }

    /**
     * @param \DateTimeInterface $publishedAt
     * @return Page
     */
    public function setPublishedAt(\DateTimeInterface $publishedAt): Page
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastModified(): ?\DateTimeInterface
    {
        return $this->lastModified;
    }

    /**
     * @param \DateTimeInterface|null $lastModified
     * @return Page
     */
    public function setLastModified(?\DateTimeInterface $lastModified): Page
    {
        $this->lastModified = $lastModified;
        return $this;
    }
}
