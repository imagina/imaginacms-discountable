<?php
use Illuminate\Routing\Router;

/**
 * @var Router $router
 */
$router->group(['prefix' => '/discountable/v1'/*,'middleware' => ['auth:api']*/], function (Router $router) {
//======  CATEGORIES
    require('ApiRoutes/discountRoutes.php');
});
