<?php

namespace App\Tests;

use App\Entity\Character;
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{
    public function testIsTrue(): void
    {
        $character = new Character();
        $character->setName("True")
                  ->setImageUrl("True");
        
        $this->assertTrue($character->getName() === 'True');
        $this->assertTrue($character->getImageUrl() === 'True');
    }

    public function testIsFalse(): void
    {
        $character = new Character();
        $character->setName("True")
                  ->setImageUrl("True");
        
        $this->assertFalse($character->getName() === 'False');
        $this->assertFalse($character->getImageUrl() === 'False');
    }

    public function testIsEmpty(): void
    {
        $character = new Character();
        
        $this->assertEmpty($character->getName());
        $this->assertEmpty($character->getImageUrl());
    }
}
