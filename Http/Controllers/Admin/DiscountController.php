<?php

namespace Modules\Discountable\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Discountable\Entities\Discount;
use Modules\Discountable\Http\Requests\CreateDiscountRequest;
use Modules\Discountable\Http\Requests\UpdateDiscountRequest;
use Modules\Discountable\Repositories\DiscountRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class DiscountController extends AdminBaseController
{
    /**
     * @var DiscountRepository
     */
    private $discount;

    public function __construct(DiscountRepository $discount)
    {
        parent::__construct();

        $this->discount = $discount;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$discounts = $this->discount->all();

        return view('discountable::admin.discounts.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('discountable::admin.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateDiscountRequest $request
     * @return Response
     */
    public function store(CreateDiscountRequest $request)
    {
        $this->discount->create($request->all());

        return redirect()->route('admin.discountable.discount.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('discountable::discounts.title.discounts')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Discount $discount
     * @return Response
     */
    public function edit(Discount $discount)
    {
        return view('discountable::admin.discounts.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Discount $discount
     * @param  UpdateDiscountRequest $request
     * @return Response
     */
    public function update(Discount $discount, UpdateDiscountRequest $request)
    {
        $this->discount->update($discount, $request->all());

        return redirect()->route('admin.discountable.discount.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('discountable::discounts.title.discounts')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Discount $discount
     * @return Response
     */
    public function destroy(Discount $discount)
    {
        $this->discount->destroy($discount);

        return redirect()->route('admin.discountable.discount.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('discountable::discounts.title.discounts')]));
    }
}
