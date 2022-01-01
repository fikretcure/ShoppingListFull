<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\in_basket;
use App\Models\product;

class InBasketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, in_basket $in_basket)
    {
        return $this->try($in_basket->where("users_id", $request->user_id)->get());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, in_basket $in_basket, product $product)
    {
        $quantity = 1;
        if ($request->quantity > 1) $quantity = $request->quantity;
        if ($product->find($request->products_id)->quantity < $quantity) return $this->catch("Stoklar yeterli değil :)");
        $product->where("id", $request->products_id)->decrement('quantity', $quantity);
        $products_user = $in_basket->where("products_id", $request->products_id)->where("users_id", $request->user_id);
        if ($products_user->exists()) return $this->try($products_user->increment("quantity", $quantity));
        $in_basket->products_id = $request->products_id;
        $in_basket->quantity = $quantity;
        $in_basket->users_id = $request->user_id;
        $in_basket->save();
        return $this->try("Ekeleme işlemi yapıldı !");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, in_basket $in_basket, Request $request, product $product)
    {
        if ($in_basket->where("users_id", $request->user_id)->where("id", $id)->doesntExist()) {
            return $this->catch("Silme yetkiniz yok !");
        }
        $product->where("id", $in_basket->find($id)->products_id)->increment('quantity', $in_basket->find($id)->quantity);
        $in_basket->find($id)->delete();
        return $this->try();
    }
    public function clear(in_basket $in_basket, Request $request, product $product)
    {
        foreach ($in_basket->where("users_id", $request->user_id)->get() as $key) {
            $product->where("id", $key->products_id)->increment('quantity', $key->quantity);
            $in_basket->find($key->id)->delete();
        }
        return $this->try();
    }

    public function destroy_products($id, in_basket $in_basket, Request $request, product $product)
    {
        if ($in_basket->where("users_id", $request->user_id)->where("products_id", $id)->doesntExist()) {
            return $this->catch("Silme yetkiniz yok !");
        }
        $product->where("id", $id)->increment('quantity', $in_basket->where("users_id", $request->user_id)->where("products_id", $id)->value("quantity"));
        $in_basket->where("users_id", $request->user_id)->where("products_id", $id)->delete();
        return $this->try();
    }
}
