<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Addon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Categories
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

        // 2. Addons
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

        Addon::create([
            'name' => 'Whipped Dalgona Foam',
            'price' => 2500,
            'description' => 'Extra layer of dense, velvety hand-whipped coffee cloud.',
            'is_active' => true,
        ]);

        // 3. Products
        $pudding = Product::create([
            'category_id' => $puddings->id,
            'name' => 'Silky Pudding Caramel',
            'slug' => 'silky-pudding-caramel',
            'price' => 12000,
            'original_price' => null,
            'description' => 'Melt-in-your-mouth velvety caramel pudding made with pure Madagascar vanilla and topped with slow-roasted golden caramel sauce.',
            'short_description' => 'Velvety vanilla custard pudding with rich golden caramel sauce.',
            'rating' => 4.9,
            'reviews_count' => 128,
            'image' => '/images/silky_pudding_caramel.jpg',
            'is_featured' => true,
            'sweetness_level' => 'Regular',
            'coffee_intensity' => 'None',
            'ingredients' => 'Fresh Cream, Madagascar Vanilla Bean, Caramelized Sugar, Organic Milk.',
            'allergens' => 'Contains Milk and Dairy. Gluten-free.',
        ]);

        Product::create([
            'category_id' => $drinks->id,
            'name' => 'Coffee Dalgona',
            'slug' => 'coffee-dalgona',
            'price' => 15000,
            'original_price' => null,
            'description' => 'Rich, whipped coffee foam layered over iced fresh milk, finished with a whisper of artisanal vanilla bean syrup.',
            'short_description' => 'Whipped Arabica espresso foam cloud over chilled fresh milk.',
            'rating' => 4.8,
            'reviews_count' => 95,
            'image' => '/images/coffee_dalgona.jpg',
            'is_featured' => true,
            'sweetness_level' => 'Regular',
            'coffee_intensity' => 'Balanced',
            'ingredients' => 'Hand-whipped Arabica Espresso Foam, Full Cream Milk, Vanilla Extract, Raw Cane Sugar.',
            'allergens' => 'Contains Milk and Caffeine.',
        ]);

        $bundle = Product::create([
            'category_id' => $bundles->id,
            'name' => 'Morning Indulgence Bundle',
            'slug' => 'morning-indulgence-bundle',
            'price' => 23000,
            'original_price' => 27000,
            'description' => 'The ultimate signature pairing: One Silky Pudding Caramel + One Coffee Dalgona for the perfect afternoon artisanal comfort treat.',
            'short_description' => '1x Silky Pudding Caramel + 1x Coffee Dalgona (Save Rp 4.000).',
            'rating' => 4.9,
            'reviews_count' => 210,
            'image' => '/images/bundle_duo.jpg',
            'is_featured' => true,
            'sweetness_level' => 'Regular',
            'coffee_intensity' => 'Balanced',
            'ingredients' => 'Set of One Silky Pudding Caramel + One Coffee Dalgona with wooden spoon.',
            'allergens' => 'Contains Milk, Dairy, and Caffeine.',
        ]);

        Product::create([
            'category_id' => $puddings->id,
            'name' => 'Belgian Chocolate Silky Pudding',
            'slug' => 'belgian-chocolate-silky-pudding',
            'price' => 14000,
            'original_price' => null,
            'description' => 'Decadent silky pudding crafted with 70% Belgian dark cocoa, topped with a velvety espresso-infused chocolate glaze.',
            'short_description' => 'Rich Belgian dark chocolate pudding with chocolate curls.',
            'rating' => 4.9,
            'reviews_count' => 86,
            'image' => '/images/chocolate_pudding.jpg',
            'is_featured' => false,
            'sweetness_level' => 'Regular',
            'coffee_intensity' => 'None',
            'ingredients' => 'Belgian Dark Chocolate (70%), Fresh Cream, Organic Milk, Roasted Cocoa Nibs.',
            'allergens' => 'Contains Milk. May contain traces of soy.',
        ]);

        $honeyDalgona = Product::create([
            'category_id' => $drinks->id,
            'name' => 'Honey Dalgona Cloud Brew',
            'slug' => 'honey-dalgona-cloud-brew',
            'price' => 17000,
            'original_price' => null,
            'description' => 'Iced milk topped with whipped espresso cloud foam, pure organic wildflower honey drizzle, and crunchy honeycomb shards.',
            'short_description' => 'Whipped espresso foam with wildflower honey drizzle & honeycomb.',
            'rating' => 4.8,
            'reviews_count' => 72,
            'image' => '/images/honey_dalgona.jpg',
            'is_featured' => false,
            'sweetness_level' => 'Regular',
            'coffee_intensity' => 'Bold',
            'ingredients' => 'Whipped Espresso Cream, Wildflower Forest Honey, Chilled Fresh Milk, Honeycomb Toffee.',
            'allergens' => 'Contains Milk and Caffeine.',
        ]);

        // 4. Sample Order from Prototype (#SLK-79401)
        $order = \App\Models\Order::create([
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

        \App\Models\OrderItem::create([
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

        \App\Models\OrderItem::create([
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
