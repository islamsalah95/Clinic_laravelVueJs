<?php
namespace App\Http\Controllers\Blog;


use App\Models\Blog\Blog;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use App\Traits\CustomHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{




    public function store(StoreBlogRequest $request)
    {
        $fileName=CustomHelpers::saveFile($request->file,"Blogs");

        $result=Blog::create([
            "title"=>$request->title,
            "desc"=>$request->desc,
            "file"=>$fileName,
        ]);
        return ApiTraits::myData('store Blog success',$result); 
    }


    public function destroy($id)
    {
        $validator = Validator::make(['id'=>$id], [
            'id' => 'required|exists:blogs,id',
        ]);

        if ($validator->fails()) {
            return ApiTraits::error('this Blog id not exist');
        }else{
            $myFile=Blog::find($id);
            $myFile->delete();
            CustomHelpers::deleteFile($myFile->file,"Blogs");
            return ApiTraits::myData('delete Blog success'); 
        }

    }


    public function show()
    {
        $results=Blog::all();

        return ApiTraits::myData('display Blogs success',$results); 
    }

    public function showBlogId($id)
    {
        $results=Blog::where('id',$id)->first();

        return ApiTraits::myData('display Blogs success',$results); 
    }


    public function update(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'desc' => 'required|string',
            'file' => 'nullable',
        ]);
    
        if ($validator->fails()) {
            return ApiTraits::error($validator->errors()->first());
        }
    
        $blog = Blog::findOrFail($id);
    
        // Update the title and description
        $blog->title = $request->input('title');
        $blog->desc = $request->input('desc');
    
        // Handle file upload
        if ($request->hasFile('file')) {
            CustomHelpers::deleteFile($blog->file,"Blogs");
            $fileName=CustomHelpers::saveFile($request->file,"Blogs");
            $blog->file= $fileName;
        }
    
        $blog->save();
    
        return ApiTraits::myData('Update Blog success', $blog);

    }
}
