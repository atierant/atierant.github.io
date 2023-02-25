<?php

declare(strict_types=1);

namespace App\Model\Traits;

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

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(?string $metaTitle): static
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(?string $metaDescription): static
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function getOgTitle(): ?string
    {
        return $this->ogTitle;
    }

    public function setOgTitle(?string $ogTitle): static
    {
        $this->ogTitle = $ogTitle;

        return $this;
    }

    public function getOgDescription(): ?string
    {
        return $this->ogDescription;
    }

    public function setOgDescription(?string $ogDescription): static
    {
        $this->ogDescription = $ogDescription;

        return $this;
    }

    public function getOgImage(): ?string
    {
        return $this->ogImage;
    }

    public function setOgImage(?string $ogImage): static
    {
        $this->ogImage = $ogImage;

        return $this;
    }

    public function getTwitterCardType(): ?string
    {
        return $this->twitterCardType;
    }

    public function setTwitterCardType(?string $twitterCardType): static
    {
        $this->twitterCardType = $twitterCardType;

        return $this;
    }

    public function getTwitterTitle(): ?string
    {
        return $this->twitterTitle;
    }

    public function setTwitterTitle(?string $twitterTitle): static
    {
        $this->twitterTitle = $twitterTitle;

        return $this;
    }

    public function getTwitterDescription(): ?string
    {
        return $this->twitterDescription;
    }

    public function setTwitterDescription(?string $twitterDescription): static
    {
        $this->twitterDescription = $twitterDescription;

        return $this;
    }

    public function getTwitterImage(): ?string
    {
        return $this->twitterImage;
    }

    public function setTwitterImage(?string $twitterImage): static
    {
        $this->twitterImage = $twitterImage;

        return $this;
    }
}
