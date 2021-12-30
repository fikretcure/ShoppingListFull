<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(product $product, Request $request)
    {
        return $this->try([
            "products" => $product->simplePaginate(10),
            "pagination_count" => ceil($product->count() / 10)
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }
    public function filtered(product $product, Request $request)
    {
        try {
            $filtered = collect();
            foreach ($request->all() as $key => $value) {
                switch ($key) {
                    case 'km':
                    case 'price':
                    case 'quantity':
                        $exp_value = explode(",", $value);
                        $filtered->push([$key, $exp_value[0], $exp_value[1]]);
                        break;
                    case 'color':
                        $filtered->push([$key, $value]);
                        break;
                    default:
                        # code...
                        break;
                }
            }
            return $this->try($product::where($filtered->toArray())->get());
        } catch (\Exception $e) {
            return $this->catch($e);
        }
    }
}
