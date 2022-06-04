<?php

namespace Jampire\Jigsaw\Toc;

use TightenCo\Jigsaw\Parsers\MarkdownParser;

/**
 * Class MarkdownParser
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 * @package Jampire\Jigsaw\Toc
 */
class TocMarkdownParser extends MarkdownParser
{
    public function __construct()
    {
        parent::__construct(new TocMarkdown());
    }
}
