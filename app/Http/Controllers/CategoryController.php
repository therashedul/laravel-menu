<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;
use App\Http\Controllers\HitlogController;

class CategoryController extends Controller
{
      function __construct()
    {
        $Hitlog  = new HitlogController;   
        $Hitlog->sitehit();
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $categories = Category::where('parent_id', 0)->get();
     
        $categories = Category::where('parent_id', '==', 'id')->paginate(5);
        return view('newcategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $categories = Category::where('parent_id', 0)->get();
        return view('newcategory.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->method()=='POST')
        // echo "<pre>";
        // print_r($request->all());
        // die();
        {       
            Category::create([
                'name' => $request->name,
                'title' => $request->title,
                'slug' => $request->slug,
                'parent_id' =>$request->parent_id,
                'link' =>$request->link
            ]);
            return redirect('/category')
            ->with('success','Category created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::findOrFail($id);
        $categories = Category::all();
        return view('newcategory.edit',compact('cat','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $category->title = $request->title;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->link = $request->link;
      
        if($request->parent_id == 0) {
            $category->parent_id = $request->parent_id;
            $category->save();
        }else{
            $category->parent_id = $request->parent_id;
            $category->save();
        }
        return redirect('/category')
            ->with('success','Category created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if(count($category->subcategory))
        {
            $subcategories = $category->subcategory;
            foreach($subcategories as $cat)
            {
                $cat = Category::findOrFail($cat->id);
                $cat->parent_id = '';
                $cat->save();
            }
        }
        $category->delete();

         return redirect('/category')
            ->with('success','Category created successfully.');
    }
       public function categoryName($category){   
           $categories=DB::table('categories')
           ->where('slug', $category)
           ->get();  
           $cat=$categories[0];
               $postmetas=DB::table('postmetas')
               ->where('cat_id',$cat->id)
               ->get();
            $posts=DB::table('posts')
           ->get();
           return view('newcategory.single-cat', compact(['postmetas', 'posts','categories']));


    }

    
}
