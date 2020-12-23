<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/discounts'/*,'middleware' => ['auth:api']*/], function (Router $router) {
    $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();

    $router->get('/available-entities', [
        'as' => $locale . 'api.discountable.discount.availableEntities',
        'uses' => 'DiscountApiController@availableEntities',
    ]);

    $router->post('/', [
        'as' => $locale . 'api.discountable.discount.create',
        'uses' => 'DiscountApiController@create',
    ]);
    $router->get('/', [
        'as' => $locale . 'api.discountable.discount.index',
        'uses' => 'DiscountApiController@index',
    ]);
    $router->put('/{criteria}', [
        'as' => $locale . 'api.discountable.discount.update',
        'uses' => 'DiscountApiController@update',
    ]);
    $router->delete('/{criteria}', [
        'as' => $locale . 'api.discountable.discount.delete',
        'uses' => 'DiscountApiController@delete',
    ]);
    $router->get('/{criteria}', [
        'as' => $locale . 'api.discountable.discount.show',
        'uses' => 'DiscountApiController@show',
    ]);

    /*$router->post('/order', [
      'as' => $locale . 'api.discountable.discount.order',
      'uses' => 'ProductDiscountApiController@updateOrder',
    ]);*/

});
