<?php
namespace App\Http\Controllers;
use App\Models\product;
use Illuminate\Http\Request;
class ProductController extends Controller{
    public function index()
    {
        $products = product::latest()->paginate(5);
        return view('products.index', compact('products'))->with('i',(request()->input('page', 1)-1)*5);
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $_request)
    {
        $_request->validate([
            'product_name'=>'required',
            'product_decs
            
            
            
            '=>'required',
            'product_qty'=>'required'
        ]);
        product::create($request->all());
        return redirect()->route('products.index')->with('success','Created Successfully.');
    }
    public function show(product $product)
    {
        return view('products.show',compact('product'));
    }
    public function edit(product $product)
    {
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, product $product)
    {
        $request->validate([
            'product_name'=>'required',
            'product_decs'=>'required',
            'product_qty'=>'required'
        ]);
        $product->update($request->all());
        return redirect()->route('product.index')->with('success','Update Successfully.');
    }
    public function destroy(product $product){
        $product->delete();
        return redirect()->route('products.index')->with('success','Student deleted successfully.');
    }

}