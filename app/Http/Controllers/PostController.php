<?php

namespace App\Http\Controllers;

use DB;
use File;
use Image;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Postmeta;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\HitlogController;

class PostController extends Controller
{

  
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index()
    {
      $postID='';
      $metaID='';
      $catID='';
      $cat='';
      $metaData ='';
      $catNames='';
      $userID = Auth::id();
      $userData = User::where('id', $userID)->get();
      $posts = Post::orderBy('id', 'desc')->paginate(3);
    //   $posts = Post::orderBy('id', 'desc')->paginate(3);
        $categories = DB::table('posts')
                ->select('*')
                ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                 ->join('categories', 'postmetas.cat_id', '=', 'categories.id')
                ->get();
          
        //         echo "<pre>";
        //         print_r($categories);
        // die();
      return view('post.index', compact('posts','userData','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $userID = Auth::id();
        // echo $userID;
        
        
        $user = Auth::user();  // display all information in current user
        $catID = DB::table('categories')->latest('id')->first();
        $postID = DB::table('posts')->latest('id')->first();
        $metaID = DB::table('postmetas')->latest('id')->first();
 
            if($postID == ''){
                // $pid = ++$postID;
                $post = New Post();
                $post->title = "Post";  
                $post->name = "post"; 
                $post->slug = "post";  
                $post->status = "1";  
                $post->save();
            }  
            if($catID == ''){
                $cat = New Category();
                $cat->title =  "unknown";  
                $cat->name =  "unknown";  
                $cat->slug =  "unknown";  
                $post->status = "1";  
                $cat->parent_id = "0";  
                $cat->save();
            }
             if(($metaID == '')){
                $cat = New postmeta();
                $cat->post_id =  "1";  
                $cat->cat_id =  "1";  
                $cat->save();
            }
       $categories = Category::where('parent_id', '')->get();
       return view('post.create', compact('categories','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     

        // $request->validate([
            //         'title' => 'required',
            //         'body' => 'required',
            //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //     ]);
        $postdate = New Post();
        $postID = DB::table('posts')->latest('id')->first();
        $id = ++$postID->id;
        $subcatID = $request->input('subcat_id');  
        foreach ($subcatID as $value) {
               $postmeta = New Postmeta();
               $postmeta->post_id =  $id;  
               $postmeta->cat_id =  $value;  
               $postmeta->save();
           }
        
        $postdate->title = $request->input('title');
        $postdate->link = $request->input('link'); 
         $postdate->slug = $request->input('slug');        
        $postdate->content = $request->input('content');
        $postdate->status = $request->input('status');
        $postdate->excerpt = $request->input('excerpt');
        $postdate->tag = $request->input('tag');
        $postdate->user_id = $request->input('userId');
        $postdate->publish_at = $request->input('publish_at');

         if($request->hasfile('image')){ 
                $image = $request->file('image');
                $filename = time().'.'.$image->extension();
                $destinationPath = public_path('/thumbnail');
                $img = Image::make($image->path());   
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$filename);   
                $destinationPath = public_path('/image');
                $image->move($destinationPath, $filename);
                $postdate->image = '/image/'.$filename;
            }


          
        $postdate->save();
        return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = post::find($id);
        // $cat = Category::findOrFail($id);
         $categories = Category::where('parent_id', '')->get();
        $postmeta = Postmeta::where('post_id', $id)->get();

      
        return view('post.edit', compact('post','categories','postmeta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $postdate = post::find($request->id);
        $subcatID = $request->input('subcat_id');  
        $unsubcatID = $request->input('uncat_id');  

        if(isset($subcatID) && isset($unsubcatID)){
            $results=array_diff($unsubcatID,$subcatID);
            $dbcatID = '';  
        foreach($unsubcatID as $uncheck) {
                foreach ($subcatID as $value) {      
                        $dbcatID = $value;            
                        //    print_r($dbcatID);
                        $metaID =  DB::table('postmetas')->where('post_id', $postdate->id)->where('cat_id', $dbcatID)->updateOrInsert([
                                'post_id'=> $postdate->id,
                                'cat_id' => $dbcatID,
                            ],
                            [
                                'post_id'=> $postdate->id,
                                'cat_id' => $dbcatID,
                                'updated_at'=>date('Y-m-d H:i:s')       
                            ]);
                        }
                foreach($results as $result){
                    if(($dbcatID != $uncheck) && ($postdate->id)){       
                        // echo $postdate->id;
                        Postmeta::where('post_id',  $postdate->id)->delete();                         
                    }  
                }  
            }
            // die();
        }
        if(isset($postdate->id)){
                foreach ($subcatID as $value) {  
                    DB::table('postmetas')->updateOrInsert([
                        'post_id'=> $postdate->id,
                        'cat_id' => $value,
                        'updated_at'=>date('Y-m-d H:i:s')   
                    ]);
                }
        }          
        $postdate->title = $request->input('title');
        $postdate->link = $request->input('link'); 
        $postdate->slug = $request->input('slug');        
        $postdate->content = $request->input('content');
        $postdate->status = $request->input('status');
        $postdate->excerpt = $request->input('excerpt');
        $postdate->tag = $request->input('tag');
        $postdate->user_id = $request->input('user_id');
        $postdate->publish_at = $request->input('publish_at');
   
            if($request->hasfile('image')){ 
            $destination = $postdate->image;
            if(File::exists($destination)){
                file::delete($destination);
            }
                $image = $request->file('image');
                $filename = time().'.'.$image->extension();
                $destinationPath = public_path('/thumbnail');
                $img = Image::make($image->path());   
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$filename);   
                $destinationPath = public_path('/image');
                $image->move($destinationPath, $filename);
                $postdate->image = '/image/'.$filename;
        }
        $postdate->save();

    
        return redirect('/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $destroyID = Post::findOrFail($id);
        if($destroyID->id){       
            Postmeta::where('post_id',  $destroyID->id)->delete();                         
        }  
        $destroyID->delete();
        return redirect('/post');
    }

     public function publish($id){

        $publish =  Post::find($id);
        $publish->status = 0;
         $publish->save();
        return redirect('/post');
    }
    public function unpublish($id){
        
        $unpublish =  Post::find($id);
        $unpublish->status = 1;
          $unpublish->save();
        return redirect('/post');
    }
     /**
     * Remove selected data.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function multipledelete(Request $request){
        $multiIds = $request->id;
		foreach ($multiIds as $multiId) 
		{         
			Post::where('id', $multiId)->delete();
            Postmeta::where('post_id',  $multiId)->delete();                                     
		}        
	    return redirect('/post');
    }
    /**
     * Auto search  data.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
     public function search(Request $request) {     
        if($request->ajax()) {
                $output="";
                $posts=DB::table('posts')
                ->where('title','LIKE','%'.$request->search."%")
                ->orwhere('content','LIKE','%'.$request->search."%")
                ->get(); 

                $output = '<table table table-hover">';   
                 $output.='<thead>'.'<tr>'.                                  
                                    '<th>'."Title".'</th>'.
                                    '<th>'."Action".'</th>'.
                                '</tr>'.'</thead>';           
                if (count($posts)>0) { 
                        foreach ($posts as $key => $post) {
                                $output.='<tr>'.
                                    '<td>'.$post->title.'</td>'.
                                    '<td> 
                                    <a href='. url('post/edit', $post->id).' class=" btn btn-primary"><i
                                                    class="fa fa-pencil-square" aria-hidden="true"></i> </a>'.
                                    '<a href='. url('post/delete', $post->id).' class="btn btn btn-info  btn-danger"><i class="fa fa-trash-o"
                                                    aria-hidden="true"></i> </a></td>'.
                                '</tr>';
                        }
                
                    }else{
                          $output.='<tr>'.
                                    '<td colspan="2">'."No Data Found".'</td>'.
                                '</tr>';
                    }
                    $output .= '</table>'; 
               return Response($output);
        }

    }
       public function postName($post){
           $post=DB::table('posts')
           ->where('slug',$post)
           ->get();
           $post = $post[0]; 
        return view('post.single-post', compact('post'));


    }

}
