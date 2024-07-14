<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class ModelProductRelationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        try {
            // Arrange
            $category = Category::factory()->create();
            $product = Product::factory()->create([
                'category_id' => $category->id,
            ]);

            // Act
            $productCategory = $product->category;

            // Assert
            $this->assertInstanceOf(Category::class, $productCategory);
            $this->assertEquals($category->id, $productCategory->id);
        } catch (ModelNotFoundException $e) {
            $this->fail('The product or category model was not found: ' . $e->getMessage());
        } catch (\Exception $e) {
            $this->fail('An unexpected error occurred: ' . $e->getMessage());
        }
    }

    public function test_product_has_many_reviews(): void
    {
        try {
            // Arrange
            $product = Product::factory()->create();
            $reviews = Review::factory()->count(3)->create([
                'product_id' => $product->id,
            ]);

            // Act
            $productReviews = $product->reviews;

            // Assert
            $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $productReviews);
            $this->assertCount(3, $productReviews);
            $this->assertTrue($productReviews->contains($reviews[0]));
            $this->assertTrue($productReviews->contains($reviews[1]));
            $this->assertTrue($productReviews->contains($reviews[2]));
        } catch (ModelNotFoundException $e) {
            $this->fail('The product or review model was not found: ' . $e->getMessage());
        } catch (\Exception $e) {
            $this->fail('An unexpected error occurred: ' . $e->getMessage());
        }
    }
}
