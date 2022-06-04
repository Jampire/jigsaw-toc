<?php

namespace Jampire\Jigsaw\Toc;

use TightenCo\Jigsaw\Parsers\JigsawMarkdownParser;

/**
 * Class TocMarkdown
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 * @package Jampire\Jigsaw\Toc
 */
class TocMarkdown extends JigsawMarkdownParser
{
    public function __construct()
    {
        parent::__construct();

        $this->header_id_func = [$this, 'generateHeaderId'];
    }

    /**
     * This method is called to generate an id="" attribute for a header.
     *
     * TOC capability is ported from @link https://sculpin.io/ Sculpin project.
     *
     * @param string $headerText raw markdown input for the header name
     *
     * @return string
     * @author Dragonfly Development Inc. <info@dflydev.com>
     * @author Beau Simensen <beau@dflydev.com>
     */
    public function generateHeaderId(string $headerText): string
    {

        // $headerText is completely raw markdown input. We need to strip it
        // from all markup, because we are only interested in the actual 'text'
        // part of it.

        // Step 1: Remove html tags.
        $result = strip_tags($headerText);

        // Step 2: Remove all markdown links. To do this, we simply remove
        // everything between ( and ) if the ( occurs right after a ].
        $result = preg_replace('%
            (?<= \\]) # Look behind to find ]
            (
                \\(     # match (
                [^\\)]* # match everything except )
                \\)     # match )
            )

            %x', '', $result);

        // Step 3: Convert spaces to dashes, and remove unwanted special
        // characters.
        $map = array(
            ' ' => '-',
            '(' => '',
            ')' => '',
            '[' => '',
            ']' => '',
        );

        return rawurlencode(strtolower(
            strtr($result, $map)
        ));
    }
}
