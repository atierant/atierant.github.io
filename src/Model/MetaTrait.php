<?php

declare(strict_types=1);

namespace App\Model;

/**
 * Trait for SEO & social networks metadata.
 */
trait MetaTrait
{
    public ?string $metaTitle = null;
    public ?string $metaDescription = null;

    // https://developers.facebook.com/docs/sharing/webmasters?locale=en
    public ?string $ogTitle = null;
    public ?string $ogDescription = null;
    public ?string $ogImage = null;

    // https://developer.twitter.com/en/docs/twitter-for-websites/cards/guides/getting-started
    public ?string $twitterCardType = null;
    public ?string $twitterTitle = null;
    public ?string $twitterDescription = null;
    public ?string $twitterImage = null;

    /**
     * @return string|null
     */
    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    /**
     * @param string|null $metaTitle
     * @return static
     */
    public function setMetaTitle(?string $metaTitle): static
    {
        $this->metaTitle = $metaTitle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    /**
     * @param string|null $metaDescription
     * @return static
     */
    public function setMetaDescription(?string $metaDescription): static
    {
        $this->metaDescription = $metaDescription;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOgTitle(): ?string
    {
        return $this->ogTitle;
    }

    /**
     * @param string|null $ogTitle
     * @return static
     */
    public function setOgTitle(?string $ogTitle): static
    {
        $this->ogTitle = $ogTitle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOgDescription(): ?string
    {
        return $this->ogDescription;
    }

    /**
     * @param string|null $ogDescription
     * @return static
     */
    public function setOgDescription(?string $ogDescription): static
    {
        $this->ogDescription = $ogDescription;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOgImage(): ?string
    {
        return $this->ogImage;
    }

    /**
     * @param string|null $ogImage
     * @return static
     */
    public function setOgImage(?string $ogImage): static
    {
        $this->ogImage = $ogImage;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTwitterCardType(): ?string
    {
        return $this->twitterCardType;
    }

    /**
     * @param string|null $twitterCardType
     * @return static
     */
    public function setTwitterCardType(?string $twitterCardType): static
    {
        $this->twitterCardType = $twitterCardType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTwitterTitle(): ?string
    {
        return $this->twitterTitle;
    }

    /**
     * @param string|null $twitterTitle
     * @return static
     */
    public function setTwitterTitle(?string $twitterTitle): static
    {
        $this->twitterTitle = $twitterTitle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTwitterDescription(): ?string
    {
        return $this->twitterDescription;
    }

    /**
     * @param string|null $twitterDescription
     * @return static
     */
    public function setTwitterDescription(?string $twitterDescription): static
    {
        $this->twitterDescription = $twitterDescription;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTwitterImage(): ?string
    {
        return $this->twitterImage;
    }

    /**
     * @param string|null $twitterImage
     * @return static
     */
    public function setTwitterImage(?string $twitterImage): static
    {
        $this->twitterImage = $twitterImage;
        return $this;
    }
}
