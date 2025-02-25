<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use function Laravel\Prompts\select;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Factory|Application
    {
        // SELECT a.*, b.name as parent_name
        // From categories as a
        // LEFT JOIN categories as b ON b.id = a.parent_id

//        $categories = Category::query()->leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
//            ->select([
//                'categories.*',
//                'parents.name as parent_name'
//            ])
        $categories = Category::with('parent')
//            ->select('categories.*')
//            ->selectRaw('(SELECT COUNT(*) FROM products WHERE category_id = categories.id) as products_count')
                ->withCount([
                    'products as products_number' => function ($query) {
                    $query->where('status', '=', 'active');
                    }
            ])
            ->filter($request->query())
            ->paginate();// Return Collection object = array
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        $parents = Category::query()->get();

        $category = new Category();

        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        //Request merge-> عشان اضيف حقل مش موجود من ضمن ال request
        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);
        $data = $request->except('image');

        $data['image'] = $this->uploadImage($request);

        //Mass assignment
        $category = Category::query()->create($data);

        //PRG -> POST Return Get = بنحول البوست لجيت عشان الريفرش
        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Created Successfully!'); // = redirect()->route
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View|Factory|Application
    {
        return view('dashboard.categories.show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): Factory|View|Application|RedirectResponse
    {
        try {
            $category = Category::query()->findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('dashboard.categories.index')
                ->with('info', 'Record not found!');
        }

        //Select * from categories WHERE id <> '!=' $id
        // AND (parent_id Is NULL OR parent_id <> $id)
        $parents = Category::query()->where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $category = Category::query()->findOrFail($id);

        $old_image = $category->image;

        $data = $request->except('image');

        $new_image = $this->uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }
        $category->update($data);

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }
        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Deleted Successfully!');
    }

    public function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image'); // uploadedFile object
        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);
        return $path;
    }

    public function trash(): View
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore(Request $request ,int $id): RedirectResponse
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category Restored Successfully!');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        if($category->image){
            Storage::disk('public')->delete($category->image);
        }

        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category Deleted Forever!');
    }
}
