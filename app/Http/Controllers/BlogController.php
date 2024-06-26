<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogImage;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::all();
        return view('blog.index', compact('blogs'));
    }
    
    public function addBlog(Request $request)
    {

        if ($request->hasFile('images')) {
            $file = $request->file('images');

            foreach ($file as $files) {

                $ext = $files->extension();
                $accept_ext = ['png', 'jpeg', 'jpg', 'gif'];
                if (in_array($ext, $accept_ext)) {
                    $size = $files->getSize();
                    if ($size > 2 * 1024 * 1024) {
                        $error = 'image phai nho hon 2MB';

                        return back()->with('error', $error);
                    }
                } else {
                    $error = 'image phai co duoi jpg,png,jpeg,gif';

                    return back()->with('error', $error);
                }
            }
            $blog = new Blog();
            $blog->Content = $request->content;
            $blog->user_id = $request->user_id;
            $blog->hagtag = $request->hagtag;
            $blog->save();


            foreach ($file as $x) {
                $fileName = time() . rand(0, 10000) . '.' . $x->extension();
                $x->move(public_path('productImages'), $fileName);
                $image = new BlogImage();
                $image->url = 'localhost:8000/productImages/' . $fileName;
                $image->blog_id = $blog->blog_id;

                $image->save();
            }
        } else {
            $blog = new Blog();
            $blog->Content = $request->content;
            $blog->user_id = $request->user_id;
            $blog->hagtag = $request->hagtag;
            $blog->save();
        }

        return 'ok';
    }

    public function updateBlog(Request $request, $id)
    {
        if ($request->hasFile('images')) {
            $file = $request->file('images');

            foreach ($file as $files) {

                $ext = $files->extension();
                $accept_ext = ['png', 'jpeg', 'jpg', 'gif'];
                if (in_array($ext, $accept_ext)) {
                    $size = $files->getSize();
                    if ($size > 2 * 1024 * 1024) {
                        $error = 'image phai nho hon 2MB';

                        return back()->with('error', $error);
                    }
                } else {
                    $error = 'image phai co duoi jpg,png,jpeg,gif';

                    return back()->with('error', $error);
                }
            }

            $oldImage = BlogImage::where('blogImage_id', $id)->get();
            foreach ($oldImage as $o) {
                $o->delete();
            }

            foreach ($file as $x) {
                $fileName = time() . rand(0, 10000) . '.' . $x->extension();
                $x->move(public_path('productImages'), $fileName);
                $image = new BlogImage();
                $image->url = 'localhost:8000/productImages/' . $fileName;
                $image->blog_id = $id;

                $image->save();
            }

            $blog = Blog::find($id);
            $blog->Content = $request->content;
            $blog->user_id = $request->user_id;
            $blog->hagtag = $request->hagtag;
            $blog->save();
        } else {
            $blog = Blog::find($id);
            $blog->Content = $request->content;
            $blog->user_id = $request->user_id;
            $blog->hagtag = $request->hagtag;
            $blog->save();
        }

        return 'ok';
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Blog deleted successfully.');
    }
}
