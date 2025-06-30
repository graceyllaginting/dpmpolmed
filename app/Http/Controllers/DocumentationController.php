<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Documentation;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $latestDocs = Documentation::with('kategori')->latest()->take(6)->get();

        return view('documentation', compact('categories', 'latestDocs'));
    }

    public function filterByKategori($id)
    {
        $categories = Category::all();
        $selectedCategory = Category::with('documentation')->findOrFail($id);
        $latestDocs = Documentation::with('kategori')->latest()->take(6)->get();

        return view('documentation', compact('categories', 'selectedCategory', 'latestDocs'));
    }

    public function show($id)
    {
        $doc = Documentation::with('kategori')->findOrFail($id);
        return view('documentation-detail', compact('doc'));
    }  

}