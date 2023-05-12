<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use File;
use Image;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Category $category)
    {
        $posts = Post::whereHas('category', function ($query) use ($category){
                $query->where('id', $category->id);
            })
            ->with('category', 'user')
            ->withCount('comments')
            ->published()
            ->paginate(5);
        
        return view('category.index', compact('posts', 'category'));
    }

    public function create()
    {
        $languages = Language::where('active',true)->get();
        return view('user.categories.create',compact('languages'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories,name',
            'cover_photo' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
        
        $cover_path = "";
        if($request->file('cover_photo')){
            $image = $request->file('cover_photo');
            $cover_image = time().'.'.$image->extension();

            $destinationPath = public_path('/categories');
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$cover_image);

            $destinationPath = public_path('/images');
            $image->move($destinationPath, $cover_image);
            $cover_path = $destinationPath.'/'.$cover_image;
        }
        Category::create([
            'name'=>$request->name,
            'meta_description' => $request->meta_description,
            'meta_keywords'=>$request->meta_keywords,
            'cover_photo'=>$cover_path,
            'slug'=>$request->slug_en,
            
            ]);
        
        return redirect()
            ->route('user.categories')
            ->withMessage('Category created successfully');
    }

    public function edit(Category $category)
    {
        if(auth()->user()->isNotAdmin()) {
            return redirect()
                ->route('user.categories')
                ->withMessage("Only admin can edit categories.");
        }

        return view('user.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        if(auth()->user()->isNotAdmin()) {
            return redirect()
                ->route('user.categories')
                ->withMessage("Only admin can update categories.");
        }

        $request->validate(['name' => 'required']);

        $category->update($request->only('name'));

        return redirect()
            ->route('user.categories')
            ->withMessage('Category updated successfully');
    }
    

    public function destroy(Category $category)
    {
        if(auth()->user()->isNotAdmin()) {
            return redirect()
                ->route('user.categories')
                ->withMessage("Only admin can delete categories.");
        }

        $category->delete();

        return redirect()->route('user.categories');
    }

}
