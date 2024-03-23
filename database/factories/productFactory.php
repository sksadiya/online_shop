<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->name();
        $slug = Str::slug($title);
        $subcategories =[42,43,44,45];
        $key = array_rand($subcategories);
        $brands = [39,40,41,42,43];
        $brKey = array_rand($brands);

        return [
           'title' => $title,
           'slug' =>$slug,
           'category_id' => 194,
           'sub_category_id'=>$subcategories[$key],
           'brand_id' =>$brands[$brKey],
           'price' =>rand(10,1000),
           'sku' =>rand(1000,100000),
           'track_qty' => 'Yes',
           'qty' => 10,
           'is_featured' => 'Yes',
           'status'=>1
        ];
    }
}
