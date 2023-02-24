<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetExistsExtension extends AbstractExtension
{
    public function __construct(
        private readonly ?string $projectDir
    )
    {
    }

    /**
     * Return the functions registered as twig extensions
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            //new TwigFunction('file_exists', [$this, 'assetExists']),
            new TwigFunction('file_exists', [$this, 'fileExists']),
        ];
    }

    public function fileExists($path)
    {
        $webRoot = realpath($this->projectDir);
        $toCheck = realpath($webRoot . $path);

        // check if the file exists
        if (!is_file($toCheck)) {
            return false;
        }

        // check if file is well contained in web/ directory (prevents ../ in paths)
        if (strncmp($webRoot, $toCheck, strlen($webRoot)) !== 0) {
            return false;
        }

        return true;
    }

    public function assetExists($path)
    {
        $webRoot = realpath($this->projectDir . '/public/');
        $toCheck = realpath($webRoot . $path);

        // check if the file exists
        if (!is_file($toCheck)) {
            return false;
        }

        // check if file is well contained in web/ directory (prevents ../ in paths)
        if (strncmp($webRoot, $toCheck, strlen($webRoot)) !== 0) {
            return false;
        }

        return true;
    }
}
