<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index()
    {
    //get post
    $posts = Post::latest()->paginate(5);

    // render view with posts
    return view('posts.index', compact('posts'));
    //
}
//langkah berikutnya
public function create() 
{
    return view('posts.create');
}
/**
 * store
 * 
 * @param Request $request
 * @return void
 */
public function store(Request $request): RedirectResponse
{
    //validate form
    $this->validate($request, [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'title'  => 'required|min:5',
        'content' => 'required|min:10'
    ]);
    //upload image
    $image = $request->file('image');
    $image->storeAs('public/posts', $image->hashName());
    //create post
    Post::create([
        'image'   => $image->hashName(),
        'title'   => $request->title,
        'content' => $request->content
    ]);
    return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan']);
    
}
public function edit(Post $post)
{
    return view('posts.edit', compact('post'));
}
public function update(Request $request, Post $post)
{
    // Validasi form
    $this->validate($request, [
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'title'  => 'required|min:5',
        'content' => 'required|min:10'
    ]);

    // Jika ada file gambar yang diunggah
    if ($request->hasFile('image')) {
        // Unggah gambar baru
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());
        // Hapus gambar lama
        Storage::delete('public/posts/' . $post->image);
        $post->image = $image->hashName();
    }

    // Update data post
    $post->title = $request->title;
    $post->content = $request->content;
    $post->save();

    return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diubah']);
}

public function destroy(Post $post): RedirectResponse
{
    Storage::delete('public/posts/'.$post->image);
    $post->delete();
    return redirect()->route('posts.index')->with(['success' => 'Data Berhasil 
    Dihapus']);
}
public function show(string $id):View
{
    $post = Post::findOrFail($id);
    return view('posts.show', compact('post'));
}
}