<?php

namespace App\Http\Controllers;

use DB;
use File;
use Image;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Http\Controllers\HitlogController;

class PageController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   
      $userID = Auth::id();
      $userData = User::where('id', $userID)->get();
      $pages = Page::where('id', '>=', 1)->paginate(3);
     
      return view('page.index', compact('pages','userData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();  // display all information in current user
        // $pages = Page::where('id', '>', 5)->get(); // display all page for parent
        $pages = Page::where('parent_id', 0)->get();
        
        return view('page.create',compact('user','pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  
        $pagedata = New Page();
        $pagedata->title = $request->input('title');
        $pagedata->name = $request->input('name');
        $pagedata->link = $request->input('link'); 
        $pagedata->slug = $request->input('slug');
        $pagedata->content = $request->input('content');
        $pagedata->parent_id = $request->input('parent_id');
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
                $pagedata->image = '/image/'.$filename;
            }

        $pagedata->template = $request->input('template');
        $pagedata->status = $request->input('status');
        $pagedata->user_id = $request->input('userId');
        $pagedata->publish_at = $request->input('publish_at');
          
        $pagedata->save();
        return redirect('/page');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    { 
       $user = Auth::user();  
       $pages = Page::where('id','>=', 1)->get();
       $page = Page::find($id);
    return view('page.edit', compact('page','pages','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $pagedata = Page::find($request->id);
        $pagedata->title = $request->input('title');
        $pagedata->status = $request->input('status');
        $pagedata->name = $request->input('name');
        $pagedata->link = $request->input('link'); 
        $pagedata->slug = $request->input('slug');  
        $pagedata->template = $request->input('template');

        
     
        $pagedata->content = $request->input('content');
        $pagedata->parent_id = $request->input('parent_id');
            if($request->hasfile('image')){ 
            $destination = $pagedata->image;
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
                $pagedata->image = '/image/'.$filename;
        }
      
        $pagedata->user_id = $request->input('userId');
        $pagedata->publish_at = $request->input('publish_at');
        $pagedata->save();

    
        return redirect('/page');
    }

    public function publish($id){

        $publish =  Page::find($id);
        $publish->status = 0;
         $publish->save();
        return redirect('/page');
    }
    public function unpublish($id){
        
        $unpublish =  Page::find($id);
        $unpublish->status = 1;
          $unpublish->save();
        return redirect('/page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroyID = Page::findOrFail($id);
        $destroyID->delete();
        return redirect('/page');
    }
    public function multipledelete(Request $request){
        $multiIds = $request->id;
		foreach ($multiIds as $multiId) 
		{         
			Page::where('id', $multiId)->delete();                                
		}        
	    return redirect('/page');
    }

     /**
     * Auto search  data.
     *
     * @param  \App\Models\page
     * @return \Illuminate\Http\Response
     */
     public function search(Request $request) {     
        if($request->ajax()) {
                $output="";
                $pages=DB::table('pages')
                ->where('name','LIKE','%'.$request->search."%")
                 ->orwhere('content','LIKE','%'.$request->search."%")
                ->get(); 

                $output = '<table table table-hover">';   
                 $output.='<thead>'.'<tr>'.                                  
                                    '<th>'."Title".'</th>'.
                                    '<th>'."Action".'</th>'.
                                '</tr>'.'</thead>';           
                if (count($pages)>0) { 
                        foreach ($pages as $key => $page) {
                                $output.='<tr>'.
                                    '<td>'.$page->name.'</td>'.
                                    
                                    '<td> <a href='. url('page/edit', $page->id).' class="btn btn btn-primary"><i
                                                    class="fa fa-pencil-square" aria-hidden="true"></i> </a>'.
                                    '<a href='. url('page/delete', $page->id).'  class="btn btn btn-info  btn-danger"><i class="fa fa-trash-o"
                                                    aria-hidden="true"></i></a></td>'.
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
    public function pagesName($page){

        $page=DB::table('pages')
                ->where('slug',$page)
                ->get();
        $page = $page[0]; 
        return view('page.single-page', compact('page'));


    }
}
