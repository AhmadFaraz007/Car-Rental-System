<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Add this line

class BlogController extends Controller
{
    public function index() {
        $blogs = Blog::latest()->get();
        return view('admin.blogs', compact('blogs'));
    }

    public function index_2() {
        $blogs = Blog::latest()->get();
        return view('blogPage', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('showBlog', compact('blog'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'written_by' => 'required|string|max:255',
                'content' => 'required|string',
                'main_pic' => 'required|image|max:2048',
            ]);

            if ($request->hasFile('main_pic')) {
                $validated['main_pic'] = $request->file('main_pic')->store('blog_images', 'public');
            }

            $blog = Blog::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Blog created successfully',
                'data' => $blog
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'errors' => $request->errors() ?? null
            ], 422);
        }
    }

public function update(Request $request, $id)
{
    $rules = [
        'title' => 'sometimes|required|string|max:255',
        'content' => 'sometimes|required|string',
        'written_by' => 'sometimes|required|string|max:255',
        'main_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    // Validate with sometimes rules
    $validated = $request->validate($rules);

    $blog = Blog::findOrFail($id);

    // Handle image upload
    if ($request->hasFile('main_pic')) {
        // Delete old image if exists
        if ($blog->main_pic) {
            Storage::disk('public')->delete($blog->main_pic);
        }
        $validated['main_pic'] = $request->file('main_pic')->store('blog_images', 'public');
    }

    
    // Only update fields that were provided
    $blog->fill($validated)->save();

    

    return response()->json([
        'success' => true,
        'message' => 'Blog updated successfully',
        'data' => $blog
    ]);
}

    public function destroy($id)
{
    try {
        $blog = Blog::findOrFail($id);
        // Delete associated image if exists
        if ($blog->main_pic) {
            Storage::disk('public')->delete($blog->main_pic);
        }
        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error deleting blog: ' . $e->getMessage()
        ], 500);
    }
}


}
