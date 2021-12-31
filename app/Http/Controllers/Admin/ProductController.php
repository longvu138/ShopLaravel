<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductAdminService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductAdminService $productService)
    {
        $this->productService = $productService;
    }

    
    public function index()
    {
        //
        $title = 'Danh Sách Sản Phẩm';
        $products = $this->productService->get();
        // dd($products->toArray());
        return view('admin.product.list')->with(compact('title','products'));
    }

   
    public function create()
    {
        return view('admin.product.add', [
            'title' => 'Thêm Sản Phẩm Mới',
            'menus' => $this->productService->getMenu()
        ]);
    }

   
    public function store(ProductRequest $request)
    {
        //
        $this->productService->insert($request);
        return redirect()->back();
    }

    
    // model tự lấy product theo id
    public function show(Product $product)
    {
        //
        return view('admin.product.edit', [
            'title' => 'Cập Nhật Sản Phẩm',
            'product' => $product,
            'menus' => $this->productService->getMenu()
        ]);

    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, Product $product)
    {
        $result = $this->productService->update($request, $product);
        if ($result) {
            return redirect('/admin/products/list');
        }

        return redirect()->back();
    }

   
    public function destroy(Request $request)
    {
        $result = $this->productService->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công sản phẩm'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
