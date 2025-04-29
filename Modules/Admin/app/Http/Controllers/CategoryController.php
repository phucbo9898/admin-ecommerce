<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Admin\Http\Requests\Category\StoreRequest;
use Modules\Admin\Http\Requests\Category\UpdateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('user')->paginate(10);

        return view('admin::categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $dataRequest = array_merge($request->validated(), [
                'slug' => Str::slug($request->get('name')),
                'created_by' => Auth::id(),
            ]);

            Category::create($dataRequest);

            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return redirect()->route('admin.categories.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $detailCategory = Category::where('uuid', $uuid)->first();
        if (empty($detailCategory)) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found');
        }

        return view('admin::categories.edit', compact('detailCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $uuid)
    {
        try {
            $detailCategory = Category::where('uuid', $uuid)->first();
            if (empty($detailCategory)) {
                return redirect()->route('admin.categories.index')->with('error', 'Category not found');
            }

            $dataRequest = array_merge($request->validated(), [
                'slug' => Str::slug($request->get('name')),
            ]);

            $detailCategory->update($dataRequest);

            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return redirect()->route('admin.categories.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        try {
            $detailCategory = Category::where('uuid', $uuid)->first();
            if (empty($detailCategory)) {
                return redirect()->route('admin.categories.index')->with('error', 'Category not found');
            }

            $detailCategory->delete();

            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return redirect()->route('admin.categories.index')->with('error', 'Something went wrong');
        }
    }
}
