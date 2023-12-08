<?php

namespace Intervention\Image\Tests\Colors\Hsv;

use Intervention\Image\Colors\Hsv\Channels\Hue;
use Intervention\Image\Colors\Hsv\Channels\Saturation;
use Intervention\Image\Colors\Hsv\Channels\Value;
use Intervention\Image\Exceptions\ColorException;
use Intervention\Image\Tests\TestCase;

/**
 * @requires extension gd
 * @covers \Intervention\Image\Colors\Hsv\Channels\Hue
 * @covers \Intervention\Image\Colors\Hsv\Channels\Saturation
 * @covers \Intervention\Image\Colors\Hsv\Channels\Value
 */
class ChannelTest extends TestCase
{
    public function testConstructor(): void
    {
        $channel = new Hue(0);
        $this->assertInstanceOf(Hue::class, $channel);

        $channel = new Hue(value: 0);
        $this->assertInstanceOf(Hue::class, $channel);

        $channel = new Hue(normalized: 0);
        $this->assertInstanceOf(Hue::class, $channel);

        $this->expectException(ColorException::class);
        $channel = new Hue();

        $this->expectException(ColorException::class);
        $channel = new Hue(normalized: 2);
    }

    public function testValue(): void
    {
        $channel = new Hue(10);
        $this->assertEquals(10, $channel->value());
    }

    public function testNormalize(): void
    {
        $channel = new Hue(360);
        $this->assertEquals(1, $channel->normalize());
        $channel = new Hue(180);
        $this->assertEquals(0.5, $channel->normalize());
        $channel = new Hue(0);
        $this->assertEquals(0, $channel->normalize());
        $channel = new Hue(90);
        $this->assertEquals(.25, $channel->normalize());
    }

    public function testValidate(): void
    {
        $this->expectException(ColorException::class);
        new Hue(361);

        $this->expectException(ColorException::class);
        new Hue(-1);

        $this->expectException(ColorException::class);
        new Saturation(101);

        $this->expectException(ColorException::class);
        new Saturation(-1);

        $this->expectException(ColorException::class);
        new Value(101);

        $this->expectException(ColorException::class);
        new Value(-1);
    }
}