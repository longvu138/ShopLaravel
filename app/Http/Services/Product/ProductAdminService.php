<?php


namespace App\Http\Services\Product;


use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    public function getMenu()
    {
        // lấy ra menu với id  = 1 ;
        return Menu::where('active', 1)->get();
    }

    // kiểm tra giá nhập vào và giảm giá. Giảm giá < giá nhập vào
    protected function isValidPrice($request)
    {
        if (
            $request->input('price') != 0 && $request->input('price_sale') != 0
            && $request->input('price_sale') >= $request->input('price')
        ) {
            Session::flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        // nếu có giá giảm mà k có giá gốc -> error
        if ($request->input('price_sale') != 0 && (int)$request->input('price') == 0) {
            Session::flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }

        return  true;
    }

    public function insert($request)
    {
        //  kiểm tra giá nhập vào và giảm giá
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;
       
        try {
            // except đeẻ bỏ token khỏi mảng
            $request->except('_token');
            Product::create($request->all());

            Session::flash('success', 'Thêm Sản phẩm thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm Sản phẩm lỗi');
            return  false;
        }

        return  true;
    }

    public function get()
    {
        // lấy product với menu đưỢc liên kết trong models
        return Product::with('menu')
            ->orderByDesc('id')->paginate(10);
    }

    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $product->fill($request->input());
            $product->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');

            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $product = Product::where('id', $request->input('id'))->first();
        if ($product) {
            $product->delete();
            return true;
        }

        return false;
    }
}
