<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InstallerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role', 'Installer');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $viewLink = '<a href="' . route('installer.show', $row->id) . '" title="View" class="text-blue-800 cursor-pointer"><i class="far fa-eye"></i></a>';
                    $updateLink = '<a href="' . route('installer.edit', $row->id) . '" title="Update" class="text-green-600 cursor-pointer px-2"><i class="far fa-edit"></i></a>';
                    $deleteLink = '<a data-value="' . route('installer.destroy', $row->id) . '" title="Delete" class="delete_row text-red-600 cursor-pointer"><i class="far fa-trash-alt"></i></a>';
                    return "<div class='flex justify-center'> $viewLink  $updateLink  $deleteLink </div>";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('installer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('installer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        User::create($validated);
        return redirect()->route('installer.index')->with('success', 'Installer Created SuccessFully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('installer.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('installer.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        $user->update($validated);
        return redirect()->route('installer.index')->with('success', 'Installer Updated SuccessFully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        echo 1;
    }


    public function getData(Request $request)
    {
        $galleries = User::where('role', 'User')->orderByDesc('created_at');
        return DataTables::of($galleries)
            ->addColumn('action', function ($data) {
                $viewLink = '<a href="' . route('gallery.show', $data->id) . '" title="View" class="text-blue-800 cursor-pointer"><i class="far fa-eye"></i></a>';
                $updateLink = '<a href="' . route('gallery.edit', $data->id) . '" title="Update" class="text-green-600 cursor-pointer px-2"><i class="far fa-edit"></i></a>';
                $deleteLink = '<a data-value="' . route('gallery.destroy', $data->id) . '" title="Delete" class="delete_row text-red-600 cursor-pointer"><i class="far fa-trash-alt"></i></a>';
                return "<div class='flex justify-center'> $viewLink  $updateLink  $deleteLink </div>";
            })
            ->editColumn('image', function ($data) {
                return '<img src="' . $data->image . '" alt="img" class="w-20 h-20">';
            })
            ->editColumn('swiper', function ($data) {
                return  $data->swiper == 1 ? 'true' : 'false';
            })
            ->editColumn('products', function ($data) {
                return  $data->products == 1 ? 'true' : 'false';
            })
            ->rawColumns(['action', 'swiper', 'image', 'products'])
            ->addIndexColumn()
            ->toJson();
    }
}
