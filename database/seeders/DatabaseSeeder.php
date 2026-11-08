<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Addon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $localEnvironment = app()->environment(['local', 'testing']);
        $adminEmail = env('ADMIN_EMAIL', $localEnvironment ? 'admin@silkyandsip.com' : null);
        $adminPassword = env('ADMIN_PASSWORD', $localEnvironment ? 'admin123' : null);

        if ($adminEmail && $adminPassword) {
            User::updateOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => 'Admin Silky & SIP',
                    'password' => Hash::make($adminPassword),
                    'is_admin' => true,
                ]
            );
        }

        if ($localEnvironment) {
            User::firstOrCreate(
                ['email' => 'buyer@silkyandsip.com'],
                [
                    'name' => 'Pembeli Demo',
                    'password' => Hash::make('buyer123'),
                    'is_admin' => false,
                ]
            );
        }

        $puddings = Category::firstOrCreate(
            ['slug' => 'puddings'],
            [
                'name' => 'Silky Puddings',
                'description' => 'Melt-in-your-mouth velvety custard desserts crafted with pure natural ingredients.',
            ]
        );

        $drinks = Category::firstOrCreate(
            ['slug' => 'drinks'],
            [
                'name' => 'Dalgona & Brews',
                'description' => 'Rich, hand-whipped espresso foam and refreshing artisanal milk beverages.',
            ]
        );

        $bundles = Category::firstOrCreate(
            ['slug' => 'bundles'],
            [
                'name' => 'Bundles',
                'description' => 'Curated pairings of silky puddings and signature dalgona coffee at special value.',
            ]
        );

        Addon::firstOrCreate(
            ['name' => 'Wild Honey Drizzle'],
            [
                'price' => 2000,
                'description' => 'Pure organic wildflower honey for a smooth floral note.',
                'is_active' => true,
            ]
        );

        Addon::firstOrCreate(
            ['name' => 'Extra Caramel Sauce'],
            [
                'price' => 2000,
                'description' => 'Rich, golden caramel sauce with a delicate savory touch.',
                'is_active' => true,
            ]
        );

        $pudding = Product::firstOrCreate(
            ['slug' => 'silky-pudding-caramel'],
            [
                'category_id' => $puddings->id,
                'name' => 'Silky Pudding Caramel',
                'price' => 12000,
                'original_price' => null,
                'description' => 'Melt-in-your-mouth vanilla bean pudding layered with our signature house-made artisanal salted caramel.',
                'short_description' => 'Vanilla bean pudding with artisanal salted caramel.',
                'rating' => 4.9,
                'reviews_count' => 128,
                'image' => '/images/silky_pudding_caramel.jpg',
                'is_featured' => true,
                'sweetness_level' => 'Regular',
                'coffee_intensity' => 'None',
                'ingredients' => 'Fresh Cream, Madagascar Vanilla Bean, Caramelized Sugar, Organic Milk.',
                'allergens' => 'Contains Milk and Dairy. Gluten-free.',
            ]
        );

        $dalgona = Product::firstOrCreate(
            ['slug' => 'coffee-dalgona'],
            [
                'category_id' => $drinks->id,
                'name' => 'Coffee Dalgona',
                'price' => 15000,
                'original_price' => null,
                'description' => 'Rich, whipped coffee foam sitting atop chilled fresh milk with an optional touch of vanilla syrup.',
                'short_description' => 'Rich whipped coffee foam atop chilled fresh milk.',
                'rating' => 4.8,
                'reviews_count' => 96,
                'image' => '/images/coffee_dalgona.jpg',
                'is_featured' => true,
                'sweetness_level' => 'Regular',
                'coffee_intensity' => 'Balanced',
                'ingredients' => 'Hand-whipped Arabica Espresso Foam, Full Cream Milk, Vanilla Extract, Cane Sugar.',
                'allergens' => 'Contains Milk and Caffeine.',
            ]
        );

        $bundle = Product::firstOrCreate(
            ['slug' => 'bundling-package'],
            [
                'category_id' => $bundles->id,
                'name' => 'Bundling Package',
                'price' => 25000,
                'original_price' => 27000,
                'description' => 'The ultimate pairing: One Silky Pudding Caramel and one refreshing Coffee Dalgona for the perfect afternoon break.',
                'short_description' => 'One Silky Pudding Caramel + One Coffee Dalgona (Hemat Rp 2.000).',
                'rating' => 5.0,
                'reviews_count' => 210,
                'image' => '/images/cand_bundle2.jpg',
                'is_featured' => true,
                'sweetness_level' => 'Regular',
                'coffee_intensity' => 'Balanced',
                'ingredients' => 'Set of One Silky Pudding Caramel + One Coffee Dalgona with wooden spoon.',
                'allergens' => 'Contains Milk, Dairy, and Caffeine.',
            ]
        );

        if ($localEnvironment) {
            $order = Order::firstOrCreate(
                ['order_number' => 'SLK-79401'],
                [
                    'customer_name' => 'Alexandra Valerie',
                    'whatsapp_number' => '+62 812-3456-7890',
                    'delivery_address' => 'Jl. Palembang-Prabumulih KM. 32, Indralaya, Ogan Ilir, Sumatera Selatan',
                    'delivery_notes' => 'Tolong sediakan sendok kayu ekstra.',
                    'payment_method' => 'qris',
                    'subtotal' => 39000,
                    'delivery_fee' => 0,
                    'tax_amount' => 3900,
                    'total_amount' => 42900,
                    'status' => 'preparing',
                ]
            );

            $orderItemExists = OrderItem::where('order_id', $order->id)->where('product_id', $bundle->id)->exists();
            if (! $orderItemExists) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $bundle->id,
                    'product_name' => $bundle->name,
                    'price' => $bundle->price,
                    'quantity' => 1,
                    'sweetness' => 'Regular',
                    'selected_addons' => [
                        ['name' => 'Extra Caramel Sauce', 'price' => 2000],
                    ],
                    'subtotal' => 27000,
                ]);
            }

            $puddingItemExists = OrderItem::where('order_id', $order->id)->where('product_id', $pudding->id)->exists();
            if (! $puddingItemExists) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $pudding->id,
                    'product_name' => $pudding->name,
                    'price' => $pudding->price,
                    'quantity' => 1,
                    'sweetness' => 'Less Sweet',
                    'selected_addons' => [],
                    'subtotal' => 12000,
                ]);
            }
        }
    }
}
