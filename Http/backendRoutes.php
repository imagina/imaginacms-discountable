<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/discountable'], function (Router $router) {
    $router->bind('discount', function ($id) {
        return app('Modules\Discountable\Repositories\DiscountRepository')->find($id);
    });
    $router->get('discounts', [
        'as' => 'admin.discountable.discount.index',
        'uses' => 'DiscountController@index',
        'middleware' => 'can:discountable.discounts.index'
    ]);
    $router->get('discounts/create', [
        'as' => 'admin.discountable.discount.create',
        'uses' => 'DiscountController@create',
        'middleware' => 'can:discountable.discounts.create'
    ]);
    $router->post('discounts', [
        'as' => 'admin.discountable.discount.store',
        'uses' => 'DiscountController@store',
        'middleware' => 'can:discountable.discounts.create'
    ]);
    $router->get('discounts/{discount}/edit', [
        'as' => 'admin.discountable.discount.edit',
        'uses' => 'DiscountController@edit',
        'middleware' => 'can:discountable.discounts.edit'
    ]);
    $router->put('discounts/{discount}', [
        'as' => 'admin.discountable.discount.update',
        'uses' => 'DiscountController@update',
        'middleware' => 'can:discountable.discounts.edit'
    ]);
    $router->delete('discounts/{discount}', [
        'as' => 'admin.discountable.discount.destroy',
        'uses' => 'DiscountController@destroy',
        'middleware' => 'can:discountable.discounts.destroy'
    ]);
// append

});
