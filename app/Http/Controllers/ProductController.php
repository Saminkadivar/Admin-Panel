<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Admin;
use App\Notifications\ProductChangedNotification;

class ProductController extends Controller
{
     
    /**
     * Display a listing of the resource.
     */
    //  public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $student = Product::latest()->get();
    //         return DataTables::of($student)

    //             ->addIndexColumn()
    //             ->addColumn('action', function ($product) {
    //                 return '<a href="' . route('product.edit', $product->id) . '" class="btn btn-sm btn-primary">Edit</a>
    //                 <button class="btn btn-sm btn-danger deleteBtn" data-id="' . $product->id . '">Delete</button>';
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }

    //     return view('product.list');
    // }

public function index(Request $request)
{
    if ($request->ajax()) {
        $products = Product::latest()->get();

        return DataTables::of($products)
            ->addIndexColumn()

            ->addColumn('product_picture', function ($product) {
                $imageUrl = asset('storage/product_picture/' . $product->product_picture);
                return '<img src="' . $imageUrl . '" width="60" height="60">';
            })

            ->addColumn('action', function ($product) {
                return '<a href="' . route('product.edit', $product->id) . '" class="btn btn-sm btn-primary">Edit</a>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="' . $product->id . '">Delete</button>';
            })

            ->rawColumns(['product_picture', 'action']) 
            ->make(true);
    }

    return view('product.list');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.insert');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request -> validate([
    //         'p_name'=>'required',
    //         'category'=> 'required',
    //         'price'=> 'required',
    //         'stock'=> 'required',
    //     ]);
    //     Product::create($request->all());
    //     return redirect()->route('product.index')->with('success','product add succesfully');
    // }
// public function store(Request $request)
// {
//     $request->validate([
//         'p_name' => 'required',
//         'category' => 'required',
//         'price' => 'required|numeric',
//         'stock' => 'required|integer',
//         'product_picture' => 'required',
//     ]);

//     $data = $request->only(['p_name', 'category', 'price', 'stock']);

//     // Handle image upload
//     if ($request->hasFile('product_picture')) {
//         $file = $request->file('product_picture');
//         $filename = time() . '_' . $file->getClientOriginalName();
//         $file->storeAs('product_picture', $filename, 'public');
//         $data['product_picture'] = $filename;
//     }

//     Product::create($data);

//     return redirect()->route('product.index')->with('success', 'Product added successfully!');
// }

public function store(Request $request)
{
    $request->validate([
        'p_name' => 'required',
        'category' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'product_picture' => 'required',
    ]);

    $data = $request->only(['p_name', 'category', 'price', 'stock']);

    if ($request->hasFile('product_picture')) {
        $file = $request->file('product_picture');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('product_picture', $filename, 'public');
        $data['product_picture'] = $filename;
    }

    $product = Product::create($data);

    // Notify all admins
    $admins = Admin::all();
    foreach ($admins as $admin) {
        $admin->notify(new ProductChangedNotification($product, 'created'));
    }

    return redirect()->route('product.index')->with('success', 'Product added successfully!');
}
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = product::findOrFail($id);
        return view('product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
//     public function update(Request $request, $id)
// {
//     $request->validate([
//         'p_name' => 'required',
//         'category' => 'required',
//         'price' => 'required|numeric',
//         'stock' => 'required|integer',
//         'product_picture' => 'required',
//     ]);

//     $product = Product::findOrFail($id);

//     $data = $request->only(['p_name', 'category', 'price', 'stock', 'product_picture']);

//     // Check if new image uploaded
//     if ($request->hasFile('product_picture')) {
//         $file = $request->file('product_picture');
//         $filename = time() . '_' . $file->getClientOriginalName();
//         $file->storeAs('product_picture', $filename, 'public');

//         // Optional: delete old image if exists
//         if ($product->product_picture && \Storage::disk('public')->exists('product_picture/' . $product->product_picture)) {
//             \Storage::disk('public')->delete('product_picture/' . $product->product_picture);
//         }

//         $data['product_picture'] = $filename;
//     }


//     $product->update($data);

//     return redirect()->route('product.index')->with('success', 'Product updated successfully!');
// }
public function update(Request $request, $id)
{
    $request->validate([
        'p_name' => 'required',
        'category' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'product_picture' => 'required',
    ]);

    $product = Product::findOrFail($id);

    $data = $request->only(['p_name', 'category', 'price', 'stock']);

    if ($request->hasFile('product_picture')) {
        $file = $request->file('product_picture');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('product_picture', $filename, 'public');

        if ($product->product_picture && \Storage::disk('public')->exists('product_picture/' . $product->product_picture)) {
            \Storage::disk('public')->delete('product_picture/' . $product->product_picture);
        }

        $data['product_picture'] = $filename;
    }

    $product->update($data);

    // Notify all admins
    $admins = Admin::all();
    foreach ($admins as $admin) {
        $admin->notify(new ProductChangedNotification($product, 'updated'));
    }

    return redirect()->route('product.index')->with('success', 'Product updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = product::findOrFail($id);
        $product ->delete($id);
            return response()->json(['success' => true]);
    }

}
