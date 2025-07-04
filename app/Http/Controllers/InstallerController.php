<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
                    $updateLink = '<a href="' . route('installer.edit', base64_encode($row->id)) . '" title="Update" class="text-white  cursor-pointer p-1 mx-2 rounded-sm" style="background-color: #f97316; margin:0 5px; padding:2px 4px"><i class="far fa-edit"></i></a>';
                    $deleteLink = '<a data-value="' . route('installer.destroy', base64_encode($row->id)) . '" title="Delete" class="delete_row bg-red-500 p-1 mx-1 text-white cursor-pointer  rounded-sm" style="background-color:red;padding:2px 4px"><i class="far fa-trash-alt"></i></a>';
                    return "<div class='flex justify-center'> $updateLink  $deleteLink </div>";
                })
                ->editColumn('name', function ($row) {
                    return '<a href="' . route('installer.show', base64_encode($row->id)) . '" title="show" style="color:#16a34a;">' . $row->name . '</a>';
                })
                ->editColumn('profile', function ($row) {
                    return '<img src="' . asset($row->profile ?: 'images/default.png') . '" alt="profile" class="rounded-full w-8 h-8 mx-auto">';
                })
                ->rawColumns(['action', 'name', 'profile'])
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
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $fileName = str_replace(' ', '_', $image->getClientOriginalName());
            $image->storeAs('installer', $fileName);
            $validated['profile'] = 'storage/installer/' . $fileName;
        }
        User::create($validated);
        return redirect()->route('installer.index')->with('success', 'Installer Created SuccessFully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail(base64_decode($id));
        return view('installer.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail(base64_decode($id));
        return view('installer.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail(base64_decode($id));
        $validated = $request->validated();
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $fileName = str_replace(' ', '_', $image->getClientOriginalName());

            if ($user->profile && Storage::disk('public')->exists(str_replace('storage/', '', $user->profile))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $user->profile));
            }

            $image->storeAs('installer', $fileName);
            $validated['profile'] = 'storage/installer/' . $fileName;
        }
        $user->update($validated);
        return redirect()->route('installer.index')->with('success', 'Installer Updated SuccessFully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail(base64_decode($id));
        $user->delete();
        echo 1;
    }
}
