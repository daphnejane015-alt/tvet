<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if news limit reached (max 10)
        if (News::count() >= 10) {
            return redirect()->route('admin.news.index')
                ->with('error', 'Had maksimum berita (10) telah dicapai. Sila padam berita sedia ada sebelum menambah yang baru.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'source' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url|max:500',
            'news_date' => 'nullable|date',
            'is_active' => 'nullable',
            'order' => 'integer|min:0',
        ]);

        // Handle checkbox - if not checked, set to false
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
            $validated['image'] = $imagePath;
        }

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berjaya ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'source' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url|max:500',
            'news_date' => 'nullable|date',
            'is_active' => 'nullable',
            'order' => 'integer|min:0',
        ]);

        // Handle checkbox - if not checked, set to false
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $imagePath = $request->file('image')->store('news', 'public');
            $validated['image'] = $imagePath;
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berjaya dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berjaya dipadam.');
    }

    /**
     * Toggle news active status
     */
    public function toggleStatus(News $news)
    {
        $news->is_active = !$news->is_active;
        $news->save();

        $status = $news->is_active ? 'diaktifkan' : 'dinyahaktifkan';
        return redirect()->route('admin.news.index')
            ->with('success', "Berita berjaya {$status}.");
    }
}
