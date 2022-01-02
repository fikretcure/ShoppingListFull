<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

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
                        if ($exp_value[0] && $exp_value[1] >= 1) {
                            $filtered->push([$key, $exp_value[0], $exp_value[1]]);
                        }
                        break;
                    case 'color':
                        if ($value) $filtered->push([$key, $value]);
                        break;
                    default:
                        # code...
                        break;
                }
            }
            return $this->try($product::where($filtered->toArray())
                ->with(['get_user' => function ($query) use ($request) {
                    $query->where('users_id', $request->user_id);
                }])
                ->get());
        } catch (\Exception $e) {
            return $this->catch($e);
        }
    }
    public function group_color(product $product)
    {
        return $this->try($product->select("color")->groupBy("color")->get());
    }
    public function with_user(product $product, Request $request)
    {
        return $this->try([
            "products" => $product->with(['get_user' => function ($query) use ($request) {
                $query->where('users_id', $request->user_id);
            }])->simplePaginate(10),
            "pagination_count" => ceil($product->count() / 10),
            "user_type"  => user::find($request->user_id)->type
        ]);
    }
    public function has_user(product $product, Request $request)
    {
        return $this->try($product
            ->with('get_user')
            ->whereHas('get_user', function (Builder $query) use ($request) {
                $query->where('users_id', $request->user_id);
            })->get());
    }
}
