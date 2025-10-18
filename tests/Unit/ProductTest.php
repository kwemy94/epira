<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Le trait RefreshDatabase prend en charge la migration et
 * la réinitialisation de la base de données après chaque
 * test afin que les données d'un test précédent n'interfèrent
 * pas avec les tests suivants.
 */
uses(Tests\TestCase::class
);

test('product', function () {
    expect(true)->toBeTrue();
});

it('can list products', function(){
    $this->getJson('/api/products')->assertStatus(200);
});

it('can create product', function(){
    $data = [
        'name' => 'Chaussure sébago',
        'price' => 15000
    ];

    $this->postJson('api/product/create', $data)->assertStatus(201);
});

it('has attribute name', function() {
    $product = new Product([
        'name' => 'product 1',
        'price'=> 3000,
    ]);

    expect($product->name)->toBe('product 1');
    expect($product->price)->toBe(3000);
});
it('test :pit de racoursi', function () {
    //expect()->
});

