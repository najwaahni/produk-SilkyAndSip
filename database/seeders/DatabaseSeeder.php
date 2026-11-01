<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Addon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Categories (Matching Stitch Prototype)
        $puddings = Category::create([
            'name' => 'Silky Puddings',
            'slug' => 'puddings',
            'description' => 'Melt-in-your-mouth velvety custard desserts crafted with pure natural ingredients.',
        ]);

        $drinks = Category::create([
            'name' => 'Dalgona & Brews',
            'slug' => 'drinks',
            'description' => 'Rich, hand-whipped espresso foam and refreshing artisanal milk beverages.',
        ]);

        $bundles = Category::create([
            'name' => 'Bundles',
            'slug' => 'bundles',
            'description' => 'Curated pairings of silky puddings and signature dalgona coffee at special value.',
        ]);

        // 2. Addons (Matching Stitch Prototype Gambar 4.3)
        Addon::create([
            'name' => 'Wild Honey Drizzle',
            'price' => 3000,
            'description' => 'Pure organic wildflower honey for a smooth floral note.',
            'is_active' => true,
        ]);

        Addon::create([
            'name' => 'Extra Caramel Sauce',
            'price' => 2000,
            'description' => 'Rich, golden caramel sauce with a delicate savory touch.',
            'is_active' => true,
        ]);

        // 3. Products - ONLY 3 ITEMS (Silky Pudding Caramel, Coffee Dalgona, Bundling Package)
        $pudding = Product::create([
            'category_id' => $puddings->id,
            'name' => 'Silky Pudding Caramel',
            'slug' => 'silky-pudding-caramel',
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
        ]);

        $dalgona = Product::create([
            'category_id' => $drinks->id,
            'name' => 'Coffee Dalgona',
            'slug' => 'coffee-dalgona',
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
        ]);

        $bundle = Product::create([
            'category_id' => $bundles->id,
            'name' => 'Bundling Package',
            'slug' => 'bundling-package',
            'price' => 23000,
            'original_price' => 27000,
            'description' => 'The ultimate pairing: One Silky Pudding Caramel and one refreshing Coffee Dalgona for the perfect afternoon break.',
            'short_description' => 'One Silky Pudding Caramel + One Coffee Dalgona (Save 15%).',
            'rating' => 5.0,
            'reviews_count' => 210,
            'image' => '/images/bundle_duo.jpg',
            'is_featured' => true,
            'sweetness_level' => 'Regular',
            'coffee_intensity' => 'Balanced',
            'ingredients' => 'Set of One Silky Pudding Caramel + One Coffee Dalgona with wooden spoon.',
            'allergens' => 'Contains Milk, Dairy, and Caffeine.',
        ]);

        // 4. Sample Order from Prototype (#SLK-79401)
        $order = Order::create([
            'order_number' => 'SLK-79401',
            'customer_name' => 'Alexandra Valerie',
            'whatsapp_number' => '+62 812-3456-7890',
            'delivery_address' => 'Jl. Palembang-Prabumulih KM. 32, Indralaya, Ogan Ilir, Sumatera Selatan',
            'delivery_notes' => 'Tolong sediakan sendok kayu ekstra.',
            'payment_method' => 'qris',
            'subtotal' => 38000,
            'delivery_fee' => 0,
            'tax_amount' => 3800,
            'total_amount' => 41800,
            'status' => 'preparing',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $bundle->id,
            'product_name' => $bundle->name,
            'price' => $bundle->price,
            'quantity' => 1,
            'sweetness' => 'Regular',
            'selected_addons' => [
                ['name' => 'Extra Caramel Sauce', 'price' => 2000]
            ],
            'subtotal' => 25000,
        ]);

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
