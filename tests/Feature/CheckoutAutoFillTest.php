<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;

class CheckoutAutoFillTest extends TestCase
{
  use RefreshDatabase;

  public function test_checkout_autofills_user_data_when_logged_in()
  {
    // Create a user
    $user = User::factory()->create([
      'name' => 'John Doe',
      'email' => 'john@example.com',
      'phone' => '081234567890',
      'address' => 'Jl. Test No. 123, Jakarta'
    ]);

    // Create a product and add to cart
    $product = Product::create([
      'name' => 'Test Product',
      'description' => 'Test Description',
      'price' => 50000,
      'category_id' => 1,
      'image' => 'test.jpg',
      'is_available' => true
    ]);

    // Add item to cart
    Cart::create([
      'user_id' => $user->id,
      'product_id' => $product->id,
      'quantity' => 1,
      'price' => $product->price,
      'subtotal' => $product->price
    ]);

    // Login and access checkout page
    $response = $this->actingAs($user)->get('/checkout');

    $response->assertStatus(200);
    $response->assertViewHas('user', $user);
    $response->assertSee('Informasi di bawah ini telah diisi otomatis');
    $response->assertSee('value="' . $user->name . '"', false);
    $response->assertSee('value="' . $user->email . '"', false);
    $response->assertSee('value="' . $user->phone . '"', false);
    $response->assertSee($user->address);
  }

  public function test_checkout_does_not_autofill_when_not_logged_in()
  {
    // Create a product and add to cart using session
    $product = Product::create([
      'name' => 'Test Product',
      'description' => 'Test Description',
      'price' => 50000,
      'category_id' => 1,
      'image' => 'test.jpg',
      'is_available' => true
    ]);

    // Add item to cart with session
    Cart::create([
      'session_id' => session()->getId(),
      'product_id' => $product->id,
      'quantity' => 1,
      'price' => $product->price,
      'subtotal' => $product->price
    ]);

    // Access checkout page without login
    $response = $this->get('/checkout');

    $response->assertStatus(200);
    $response->assertViewHas('user', null);
    $response->assertDontSee('Informasi di bawah ini telah diisi otomatis');
  }
}
