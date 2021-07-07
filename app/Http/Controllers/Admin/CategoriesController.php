<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Rules\WordFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

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
           /* ->leftjoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])*/
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

    public function store(CategoryRequest $request)
    {
        // // $this->validate($request,[]);
        // $request->validate([
        //     'name' => 'required|alpha|max:255|min:3|unique:categories,name',
        //     'discription' => 'max:255',
        //     'parent_id' => [
        //         'nullable',
        //         'exists:categories,id',

        //     ],
        //     'image' => [
        //         //'nulable',
        //         'image',
        //         //'max:1048576',
        //         //'dimensions:min_width=300,min_height=300'
        //     ],
        //     'status' => 'required|in:active,inactive',
        // ]);
        // //dd($request->all());
        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'name' => 'required|alpha|max:255|min:3|unique:categories,name',
        //         'discription' => 'max:255',
        //         'parent_id' => [
        //             'nullable',
        //             'exists:categories,id',

        //         ],
        //         'image' => [
        //             // 'nulable',
        //             'image',
        //             // 'max:1048576',
        //             //'dimensions:min_width=300,min_height=300'
        //         ],
        //         'status' => 'required|in:active,inactive',
        //     ]
        // );
        // $result = $validator->fails();
        // $failed = $validator->failed();
        // $errors = $validator->errors();

        // $clean = $validator->validated();
        // // dd($clean);

        $clean = $this->validateRequest($request);
        $category = new Category();
        $category->name = $request['name'];
        $category->slug = Str::slug($request['name']);
        $category->description = $request['description'];
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
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            abort(404);
        }
        // $this->validateRequest($request, $id);
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
    protected function validateRequest(Request $request, $id = 0)
    {
        return $request->validate([
            'name' => [
                'required',
                'alpha',
                'max:255',
                'min:3',
                //'unique:categories,name,$id'],
                // (new Unique('categories','name'))->ignore($id),
                Rule::unique('categories', 'name')->ignore($id),
            ],
            'description' => [
                'nullable',
                'max:255',
                'required',
                /*function ($attribute, $value, $fail) {
                if (stripos($value, 'laravel') !== false) {
                    $fail('you can not use the word "laravel"!');
                }
            }*/
                //new WordFilter(['laravel', 'php']),
                'filter:laravel,php',
            ],
            'parent_id' => [
                'nullable',
                'exists:categories,id',

            ],
            'image' => [
                //'nulable',
                'image',
                //'max:1048576',
                //'dimensions:min_width=300,min_height=300'
            ],
            'status' => 'required|in:active,inactive',
        ], [
            'name.required' => ':attribute هذا الحقل مطلوب!',
            'required' => ':attribute مطلوب!'
        ]);
        /* $validator = validator::make([],[]);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }*/
    }
    public function messages()
    {
        return [
            'required' => 'Requird!'
        ];
    }
}
