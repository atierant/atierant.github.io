<?php

/*
 * This file is part of the "StenopePHP/Stenope" bundle.
 *
 * @author Thomas Jarrand <thomas.jarrand@gmail.com>
 */

namespace App\Highlighter;

use DomainException;
use Highlight\Highlighter as HighlightHighlighter;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Stenope\Bundle\Behaviour\HighlighterInterface;
use Symfony\Component\Stopwatch\Stopwatch;

/**
 * Prism code highlight
 */
class Highlighter implements HighlighterInterface
{
    private HighlightHighlighter $executable;
    private ?Stopwatch $stopwatch;
    private LoggerInterface $logger;

    public function __construct(?Stopwatch $stopwatch = null, ?LoggerInterface $logger = null)
    {
        $this->executable = new HighlightHighlighter();
        $this->stopwatch = $stopwatch;
        $this->logger = $logger ?? new NullLogger();
    }

    /**
     * Highlight a portion of code with pygmentize
     */
    public function highlight(string $value, string $language): string
    {
        if ($this->stopwatch) {
            $event = $this->stopwatch->start('highlight', 'stenope');
        }

        try {
            // Highlight some code.
            $highlighted = $this->executable->highlight($language, $value);

            $return = "<pre><code class=\"hljs {$highlighted->language}\">";
            $return .= $highlighted->value;
            $return .= "</code></pre>";
        } catch (DomainException $e) {
            // This is thrown if the specified language does not exist

            $return = "<pre><code>";
            $return .= htmlentities($value);
            $return .= "</code></pre>";
        }

        if (isset($event)) {
            $event->stop();
        }

        return $return;
    }
}
