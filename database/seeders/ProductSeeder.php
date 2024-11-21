<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        // for ($i = 1; $i <= 6; $i++) {
        //     Product::create([
        //         "product_name" => "Product $i",
        //         "orientation" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Adipisci porro debitis eius deserunt odio, repudiandae ad repellendus laboriosam nobis sed?",
        //         "description" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem temporibus, pariatur, tempore quia officiis at repudiandae dolore assumenda sunt fugiat alias illo nam minus autem dolor voluptate. Dignissimos eum natus ipsum optio neque numquam, voluptatem autem! Officiis, voluptas. Dolorum atque minima, aliquam facilis minus exercitationem aliquid doloremque vero, error qui consequatur quas tempore aspernatur asperiores cupiditate similique? Eius esse excepturi repellat deleniti, asperiores quas magni! Labore facere dicta expedita natus quisquam eaque, aspernatur minima quas nobis mollitia soluta sed id incidunt consequatur recusandae. Asperiores distinctio cum recusandae, odit earum quod vero similique assumenda? Autem perferendis ipsa accusamus id eaque. Sapiente!",
        //         "price" => rand(5000, 30000),
        //         "stock" => rand(10, 100),
        //         "discount" => 0.05,
        //         "image" => env("IMAGE_PRODUCT"),
        //     ]);
        // }
        // gaamRDJEO5xNbQMfgSXx91ZNIVYxid2S110yVkKg.jpg

        Product::create([
            "product_name" => "Kaapi Coffee",
            "orientation" => "Kaapi, a South Indian coffee, blends coffee and chicory for a strong, creamy flavor, traditionally served in frothy perfection.",
            "description" => "At Café Arcade, we serve our Kaapi with a special touch. We blend the finest coffee beans with chicory to create a rich and aromatic brew. Prepared fresh in a traditional South Indian filter, our Kaapi is then combined with creamy, frothy milk and a touch of sweetness to offer a smooth, comforting experience. Served in a classic tumbler, it’s the perfect way to enjoy a warm, authentic South Indian coffee at Café Arcade.",
            "price" => 270,
            "stock" => 69,
            "discount" => 5,
            "image" => "product/gaamRDJEO5xNbQMfgSXx91ZNIVYxid2S110yVkKg.jpg",
        ]);

        Product::create([
            "product_name" => "Arabica Coffee",
            "orientation" => "Arabica coffee is known for its smooth, mild flavor, with subtle acidity and aromatic notes, offering a refined coffee experience.",
            "description" => " Arabica coffee, known for its smooth and mild flavor, offers a refined coffee experience with balanced acidity and aromatic notes. Grown at higher altitudes, Arabica beans are prized for their rich, complex flavor profile, often featuring hints of fruit, floral, and nutty undertones. At Café Arcade, we serve only the finest Arabica coffee, delivering a sophisticated and smooth taste with every cup.",
            "price" => 290,
            "stock" => 60,
            "discount" => 0,
            "image" => "product/r8e0iS6hEBocNNBRkmTy5uL7BUf9IjNSQmZrgKJy.jpg",
        ]);

        Product::create([
            "product_name" => "Filter Coffee ",
            "orientation" => "Filter Coffee is a strong, aromatic South Indian brew made with ground coffee, served with milk and sugar for richness.",
            "description" => "At Café Arcade, our Filter Coffee is made using the finest coffee beans, carefully brewed in a traditional metal filter. This process extracts a bold, aromatic essence that’s both rich and smooth. Served with steamed milk and a touch of sugar, it offers a comforting, full-bodied experience that’s perfect for coffee lovers seeking an authentic taste of South India. Whether you’re starting your day or taking a break, our Filter Coffee is a true delight.",
            "price" => 310,
            "stock" => 70,
            "discount" => 10,
            "image" => "product/fried.webp",
        ]);
        Product::create([
            "product_name" => "Mysore Coffee",
            "orientation" => "Mysore Coffee offers rich, aromatic flavors with smooth, robust beans, delivering a traditional South Indian coffee experience in every cup.",
            "description" => "Mysore Coffee is crafted from premium, handpicked Arabica beans grown in the lush, scenic plantations of Karnataka. Known for its rich, bold flavor and smooth texture, this coffee delivers a perfect balance of strength and aroma. The beans are roasted to perfection, bringing out a deep, robust taste with subtle hints of chocolate and spices. Whether enjoyed black or with milk, Mysore Coffee provides a truly authentic South Indian coffee experience that’s perfect for any coffee enthusiast seeking a rich and satisfying brew. Ideal for both home brewing and café-style preparation.",
            "price" => 310,
            "stock" => 70,
            "discount" => 10,
            "image" => "product/images.jpeg",
        ]);
    }
}
