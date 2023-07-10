<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Response;
use function App\Helpers\Helper;
use Log;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $perPage = intval($request->input('per_page', 10));
            $currentPage = intval($request->input('current_page', 1));

            $products = Product::paginate($perPage, ['*'], 'page', $currentPage);

            $data = $products->items();
            $total = $products->total();

            $response = formatApiResponse($data, $currentPage, $perPage, $total);
            Log::info("Show list product success");
            Log::channel('database')->info('Show list product success');

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred during processing.'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info("Create product success");
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                throw new \Exception('The record does not exist');
            }

            Log::info("Get detail product success");
            return $product;
        } catch (\Exception $e) {
            Log::error("Get detail failed!");
            return response()->json(['message' => $e->getMessage()], 404);
        }
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
        try {
            $product = Product::find($id);

            if (!$product) {
                throw new \Exception('The record does not exist');
            }

            $product->update($request->all());

            Log::info("Update product success");
            return response()->json(['message' => 'Record update successful']);
        } catch (\Exception $e) {
            Log::error("Update product failed!");
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                throw new \Exception('The record does not exist');
            }

            $product->delete();
            Log::info("Delete product success");
            return response()->json(['message' => 'Record delete successful']);
        } catch (\Exception $e) {
            Log::error("Delete product failed!");
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
