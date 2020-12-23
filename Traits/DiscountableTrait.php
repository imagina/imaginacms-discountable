<?php
namespace Modules\Discountable\Traits;

use Illuminate\Support\Arr;
use Modules\Discountable\Entities\Discount;

trait DiscountableTrait
{
  /**
   * {@inheritdoc}
   */
  protected static $discountsModel = Discount::class;

  /**
   * {@inheritdoc}
   */
  public static function getDiscountsModel()
  {
    return static::$discountsModel;
  }

  /**
   * {@inheritdoc}
   */
  public static function setDiscountsModel($model)
  {
    static::$discountsModel = $model;
  }

  /**
   * {@inheritdoc}
   */
  public function discounts()
  {
    return $this->morphToMany(static::$discountsModel, 'discountable', 'discountable__discountable', 'discountable_id', 'discount_id');
  }

  /**
   * {@inheritdoc}
   */
  public static function createDiscountsModel()
  {
    return new static::$discountsModel;
  }

  /**
   * {@inheritdoc}
   */
  public static function allDiscounts()
  {
    $instance = new static;

    return $instance->createDiscountsModel()->whereNamespace($instance->getEntityClassName());
  }

  /**
   * {@inheritdoc}
   */
  public function discount($discounts)
  {
    foreach ($discounts as $discount) {
      $this->addDiscount($discount);
    }
    return true;
  }

  /**
   * {@inheritdoc}
   */
  public function addDiscount($discountId)
  {
    $discount = Discount::find($discountId);
    if ($this->discounts->contains($discount->id) === false) {
      $this->discounts()->attach($discount);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function undiscount($discounts = null)
  {
    $discounts = $discounts ?: $this->discounts->pluck('id')->all();

    foreach ($discounts as $discount) {
      $this->removeDiscount($discount->id);
    }

    return true;
  }

  /**
   * {@inheritdoc}
   */
  public function removeDiscount($discountD)
  {
    $discount = $this->createDiscountsModel()
      ->where('id', $discountD->id)
      ->first();

    if ($discount) {
      $this->discounts()->detach($discount);
    }
  }

  public function getPriceWithDiscountsAttribute(){
      $price = $this->price;
      $setting = json_decode(request()->get('setting'));
      if(!isset($setting->fromAdmin)){
          $discounts = $this->discounts;
          foreach($discounts as $discount){
              if($discount->criteria == 'percentage'){
                  $price = $price - ($price * ($discount->value / 100));
              }else{
                  $price -= $discount->value;
              }
          }
          if($this->category){
              if($this->category->discounts){
                  $discounts = $this->category->discounts;
                  foreach($discounts as $discount){
                      if($discount->criteria == 'percentage'){
                          $price = $price - ($price * ($discount->value / 100));
                      }else{
                          $price -= $discount->value;
                      }
                  }
              }
          }
      }
      return $price;
  }

}
