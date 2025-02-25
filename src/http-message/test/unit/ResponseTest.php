<?php declare(strict_types=1);

namespace SwoftTest\Http\Message\Unit;

use PHPUnit\Framework\TestCase;
use Swoft\Http\Message\Response;

/**
 * Class ResponseTest
 *
 * @package SwoftTest\Http\Message\Unit
 */
class ResponseTest extends TestCase
{
    public function testCookies(): void
    {
        $w = new Response();

        $this->assertEmpty($w->getCookies());

        $cookies = [
            'key1' => 'value1',
            'key2' => [
                'value' => 'value2',
            ],
            'key3' => [
                'value'    => 'value3',
                'httpOnly' => true
            ],
        ];

        $w->setCookies($cookies);

        $this->assertNotEmpty($cks = $w->getCookies());
        $this->assertCount(3, $cks);

        $this->assertArrayHasKey('key1', $cks);
        $this->assertArrayHasKey('key2', $cks);
        $this->assertIsArray($cks['key1']);
        $this->assertSame('value1', $cks['key1']['value']);
        $this->assertSame('value2', $cks['key2']['value']);

        $w->delCookie('key1');
        $this->assertCount(2, $w->getCookies());

        $w->setCookies([]);
        $this->assertEmpty($w->getCookies());
    }
}
