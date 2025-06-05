<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../jsnao.php';

class JsnaoTest extends TestCase
{
    public function testSimpleUsage(): void
    {
        $cart = [
            'A001' => ['name' => 'apple'],
            1000   => ['name' => 'water'],
        ];
        $cart = new Jsnao($cart);

        // Get
        $this->assertSame('apple', $cart->A001->name);
        $this->assertSame('water', $cart->get(1000)->name);

        // Set
        $cart->A002 = ['name' => 'banana'];
        $cart->A002 = [];
        $cart->A002->name = 'banana';
        $cart->put(2000, ['name' => 'lemon']);

        // Modify
        $cart->A001->name = 'cherry';

        // Delete
        $cart->A003 = ['name' => 'bag'];
        unset($cart->A003);

        $expected = [
            'A001' => ['name' => 'cherry'],
            1000   => ['name' => 'water'],
            'A002' => ['name' => 'banana'],
            2000   => ['name' => 'lemon'],
        ];
        $this->assertSame($expected, $cart->toArray());
    }

    public function testArrayAccess(): void
    {
        $cart = [
            '001' => ['name' => 'apple'],
        ];
        $cart = new Jsnao($cart);

        // Get
        $this->assertSame('apple', $cart['001']['name']);

        // Set
        $cart['002']['name'] = 'banana';

        // Modify
        $cart['001']['name'] = 'cherry';

        // Delete
        $cart['003']['name'] = 'bag';
        unset($cart['003']);

        $expected = [
            '001' => ['name' => 'cherry'],
            '002' => ['name' => 'banana'],
        ];
        $this->assertSame($expected, $cart->toArray());
    }

    public function testArrayObjectMethods(): void
    {
        $cart = [
            '001' => ['name' => 'apple'],
        ];
        $cart = new Jsnao($cart);

        // Get
        $this->assertSame('apple', $cart->offsetGet('001')->name);

        // Set
        $cart->offsetSet('002', ['name' => 'banana']);

        // Modify
        $cart->offsetGet('001')->offsetSet('name', 'cherry');

        // Delete
        $cart->offsetSet('003', ['name' => 'bag']);
        $cart->offsetUnset('003');

        $expected = [
            '001' => ['name' => 'cherry'],
            '002' => ['name' => 'banana'],
        ];
        $this->assertSame($expected, $cart->toArray());
    }
}
