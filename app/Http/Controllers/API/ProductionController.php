<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Response;
use function App\Helpers\Helper;

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

            return response()->json($response);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi
            return response()->json(['error' => 'Đã xảy ra lỗi trong quá trình xử lý.'], 500);
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
                throw new \Exception('Bản ghi không tồn tại');
            }

            return $product;
        } catch (\Exception $e) {
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
                throw new \Exception('Bản ghi không tồn tại');
            }

            $product->update($request->all());

            return response()->json(['message' => 'Cập nhật bản ghi thành công']);
        } catch (\Exception $e) {
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
                throw new \Exception('Bản ghi không tồn tại');
            }

            $product->delete();

            return response()->json(['message' => 'Xóa bản ghi thành công']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
