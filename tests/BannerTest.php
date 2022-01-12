<?php

namespace App\Tests;

use App\Entity\Banner;
use App\Entity\Character;
use DateTime;
use PHPUnit\Framework\TestCase;

class BannerTest extends TestCase
{
    public function testIsTrue(): void
    {
        $banner = new Banner();
        $date = new DateTime('today');
        $character = new Character();

        $banner->setDate($date)
               ->addCharacter($character);
        
        $this->assertTrue($banner->getDate() === $date);
        $this->assertContains($character, $banner->getCharacters());
    }

    public function testIsFalse(): void
    {
        $banner = new Banner();
        $date = new DateTime('today');
        $character = new Character();

        $banner->setDate($date)
               ->addCharacter($character);
        
        $this->assertFalse($banner->getDate() === new DateTime());
        $this->assertNotContains(new Character(), $banner->getCharacters());
    }

    public function testIsEmpty(): void
    {
        $banner = new Banner();
        
        $this->assertEmpty($banner->getDate());
        $this->assertEmpty($banner->getCharacters());
    }
}
