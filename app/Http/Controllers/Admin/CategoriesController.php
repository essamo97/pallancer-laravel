<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::when($request->name, function ($query, $value) {
            $query->where(function ($query) use ($value) {
                $query->where('categories.name', 'LIKE', "%$value%")
                    ->orwhere('categories.description', 'LIKE', "%$value%");
            });
        })
            ->when($request->parent_id, function ($query, $value) {
                $query->where('categories.parent_id', "=", $value);
            })
            ->leftjoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])
            ->get();

        $parents = Category::orderBy('name', 'asc')->get();
        return view('admin.categories.index', [
            'categories' => $categories,
            'parents'    => $parents,
        ]);
    }
    public function create()
    {
        $parents = Category::orderBy('name', 'asc')->get();
        //dd(compact('parents', 'title'));
        return view('admin.categories.create', [
            'parents' => $parents,
            'title'  => 'Add Category',
            'category' => new Category(),
        ]);
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->input('description');
        $category->parent_id = $request->post('parent_id');
        $category->status = $request->post('status');
        $category->save();
        session()->put('stuats', 'category add(from session!)');

        session()->flash('success', 'category added');
        return redirect(route('admin.categories.index'));
    }
    public function show($id)
    {
        return view('admin.categories.show', [
            'category' => Category::findOrFail($id),
        ]);
    }
    public function edit($id)
    {
        //$category = Category::where('id', '=', $id)->first();
        $category = Category::findOrFail($id);
        /* if ($category == null) {
            abort(404);
        }*/
        $parents = Category::where('id', '<>', $id)
            ->orderBy('name', 'asc')->get();
        return view('admin.categories.edit', [
            'id' => $id,
            'category' => $category,
            'parents' => $parents,
        ]);
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            abort(404);
        }
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->input('description');
        $category->parent_id = $request->post('parent_id');
        $category->status = $request->post('status');
        $category->save();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category Updated');
    }
    public function destroy($id)
    {
        //method1
        //$category = Category::find($id);
        //$category->delete();
        //method2
        // Category::where('id','=',$id)->delete();
        //method3
        Category::destroy($id);
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted');
    }
}
