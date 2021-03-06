<?php

namespace SecTheater\Marketplace\Tests\Unit\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use SecTheater\Marketplace\Models\EloquentWishlist;
use SecTheater\Marketplace\Tests\TestCase;

class WishlistTest extends TestCase {
    public function setUp()
    {
        parent::setUp();
        $this->cart = new EloquentWishlist;
    }
    /** @test */
    public function it_has_carts_table()
    {
        $this->assertEquals('wishlists',$this->cart->getTable());
    }
    /** @test */
    public function it_has_all_fillable_except_for_id_column()
    {
       $this->assertEquals(['id'], $this->cart->getGuarded());
    }
    /** @test */
    public function it_has_user_with_many_to_many_relationship()
    {
       $this->assertInstanceOf(BelongsToMany::class,$this->cart->users());
       $this->assertEquals('user_wishlist',$this->cart->users()->getTable());
       $this->assertEquals('wishlist_id',$this->cart->users()->getForeignPivotKeyName());
       $this->assertEquals('user_id',$this->cart->users()->getRelatedPivotKeyName());

    }
    /** @test */
    public function it_belongs_to_a_product()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->cart->product());
       $this->assertEquals('product_id' , $this->cart->product()->getForeignKey());

    }
    /** @test */
    public function it_belongs_to_a_product_variation_type()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->cart->type());
       $this->assertEquals('product_variation_type_id' , $this->cart->type()->getForeignKey());

           
    }
}