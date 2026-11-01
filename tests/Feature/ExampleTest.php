<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_all_pages_return_successful_responses(): void
    {
        $urls = [
            '/',
            '/shop',
            '/shop/silky-pudding-caramel',
            '/custom',
            '/ai-assistant',
            '/cart',
            '/admin',
            '/order-success/1',
            '/invoice/1',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
        }
    }

    public function test_ai_chat_endpoint_works(): void
    {
        $response = $this->postJson('/ai-assistant/chat', [
            'message' => 'Saya mau puding caramel manis',
            'sweetness' => 'Regular',
            'coffee' => 'None',
            'budget' => 20000,
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['reply', 'products']);
    }

    public function test_cart_add_and_checkout_flow(): void
    {
        // 1. Add to cart
        $addResponse = $this->post('/cart/add', [
            'product_id' => 1,
            'quantity' => 2,
            'sweetness' => 'Regular',
        ]);
        $addResponse->assertSessionHas('cart');

        // 2. Checkout
        $checkoutResponse = $this->post('/checkout', [
            'customer_name' => 'Nisa Nofrianti',
            'whatsapp_number' => '08123456789',
            'delivery_address' => 'Kampus Fasilkom UNSRI Indralaya',
            'delivery_notes' => 'Tolong hati-hati di jalan',
            'payment_method' => 'qris',
        ]);

        $checkoutResponse->assertRedirect();
    }
}
