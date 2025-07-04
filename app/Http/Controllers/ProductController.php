<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Models\ProductWarranty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Products::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $updateLink = '<a href="' . route('product.edit', base64_encode($row->id)) . '" title="Update" class="text-white  cursor-pointer p-1 mx-2 rounded-sm" style="background-color: #f97316; margin:0 5px; padding:2px 4px"><i class="far fa-edit"></i></a>';
                    $deleteLink = '<a data-value="' . route('product.destroy', base64_encode($row->id)) . '" title="Delete" class="delete_row bg-red-500 p-1 mx-1 text-white cursor-pointer  rounded-sm" style="background-color:red;padding:2px 4px"><i class="far fa-trash-alt"></i></a>';
                    return "<div class='flex justify-center'> $updateLink  $deleteLink </div>";
                })
                ->editColumn('name', function ($row) {
                    return '<a href="' . route('product.show', base64_encode($row->id)) . '" title="show" style="color:#16a34a;">' . $row->name . '</a>';
                })
                ->editColumn('is_active', function ($row) {
                    return $row->is_active == 1 ? 'true' : 'false';
                })
                ->editColumn('image_urls', function ($row) {
                    $images = '';
                    if (!empty($row->image_urls)) {
                        $imagesArray = array_slice($row->image_urls, 0, 3); // limit to 5
                        foreach ($imagesArray as $img) {
                            $images .= '<img src="' . asset($img) . '" alt="img" class="w-8 h-8 rounded object-cover inline-block mr-2 mb-1">';
                        }
                    }
                    return $images;
                })
                ->rawColumns(['action', 'name', 'is_active', 'image_urls'])
                ->make(true);
        }
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductsRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $fileName = str_replace(' ', '_', $image->getClientOriginalName());
                    $image->storeAs('product', $fileName);
                    $imagePaths[] = 'storage/product/' . $fileName;
                }
            }
            $validated['image_urls'] = $imagePaths;
            $product = Products::create($validated);

            // Prepare warranties bulk insert data
            if ($request->filled('warranty_size')) {
                $warranties = [];
                foreach ($request->warranty_size as $index => $size) {
                    $warranties[] = [
                        'warranty_size' => $size,
                        'warranty_coverage' => $request->warranty_coverage[$index],
                        'price' => $request->price[$index],
                    ];
                }
                $product->warranties()->createMany($warranties);
            }
            DB::commit();
            return redirect()->route('product.index')->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating product: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Products::with('warranties')->findOrFail(base64_decode($id));
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Products::with('warranties')->findOrFail(base64_decode($id));
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, string $id)
    {
        $product = Products::with('warranties')->findOrFail(base64_decode($id));
        $validated = $request->validated();
        DB::beginTransaction();
        try {
            $imageUrls = $product->image_urls ?? [];
            if ($request->filled('removed_images')) {
                $toRemove = json_decode($request->removed_images, true);
                $imageUrls = array_values(array_diff($imageUrls, $toRemove));

                // Optional: also physically delete from storage
                foreach ($toRemove as $removePath) {
                    if (Storage::disk('public')->exists(str_replace('storage/', '', $removePath))) {
                        Storage::disk('public')->delete(str_replace('storage/', '', $removePath));
                    }
                }
            }
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $fileName = str_replace(' ', '_', $image->getClientOriginalName());
                    $image->storeAs('product', $fileName);
                    $imageUrls[] = 'storage/product/' . $fileName;
                }
            }
            $validated['image_urls'] = $imageUrls;
            $product->update($validated);

            // Update existing warranties
            $submittedWarrantyIds = $request->existing_warranty_id ?? [];
            if ($submittedWarrantyIds) {
                foreach ($submittedWarrantyIds as $index => $wid) {
                    $warranty = $product->warranties()->where('id', $wid)->first();
                    if ($warranty) {
                        $warranty->update([
                            'warranty_size'     => $request->existing_warranty_size[$index],
                            'warranty_coverage' => $request->existing_warranty_coverage[$index],
                            'price'             => $request->existing_price[$index],
                        ]);
                    }
                }
            }

            // Remove warranties not submitted in form
            $product->warranties()->whereNotIn('id', $submittedWarrantyIds)->delete();

            // Add new warranties
            if ($request->filled('warranty_size') && is_array($request->warranty_size)) {
                $newWarranties = [];
                foreach ($request->warranty_size as $index => $size) {
                    if (isset($request->warranty_coverage[$index]) && isset($request->price[$index])) {
                        $newWarranties[] = [
                            'warranty_size'     => $size,
                            'warranty_coverage' => $request->warranty_coverage[$index],
                            'price'             => $request->price[$index],
                        ];
                    }
                }
                if (count($newWarranties)) {
                    $product->warranties()->createMany($newWarranties);
                }
            }
            DB::commit();
            return redirect()->route('product.index')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::with('warranties')->findOrFail(base64_decode($id));
        $product->delete();
        echo 1;
    }
}
