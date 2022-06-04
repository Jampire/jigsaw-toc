<?php

namespace Jampire\Jigsaw\Toc\Test;

use Jampire\Jigsaw\Toc\TocMarkdown;
use Jampire\Jigsaw\Toc\TocMarkdownParser;
use PHPUnit\Framework\TestCase;
use TightenCo\Jigsaw\Parsers\JigsawMarkdownParser;
use TightenCo\Jigsaw\Parsers\MarkdownParser;

/**
 * Class TocMarkdownParserTest
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 * @package Jampire\Jigsaw\Toc\Test
 */
class TocMarkdownParserTest extends TestCase
{
    /**
     * @return void
     */
    public function testToc(): void
    {
        $source = file_get_contents(__DIR__ . '/fixtures/input.md');
        $expected = file_get_contents(__DIR__ . '/fixtures/output.html');
        $this->assertEquals($expected, (new TocMarkdownParser())->parse($source));
    }

    /**
     * @dataProvider instanceProvider
     * @param string $expected
     * @param object $actual
     * @return void
     */
    public function testInstance(string $expected, object $actual): void
    {
        $this->assertInstanceOf($expected, $actual);
    }

    public function instanceProvider(): array
    {
        return [
            'MarkdownParser instance' => [MarkdownParser::class, new TocMarkdownParser()],
            'JigsawMarkdownParser instance' => [JigsawMarkdownParser::class, new TocMarkdown()]
        ];
    }
}
