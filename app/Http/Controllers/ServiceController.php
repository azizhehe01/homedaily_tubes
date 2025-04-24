<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.service.index', compact('services'));
    }

    public function create()
    {
    $categories = Category::all();
    return view('admin.service.create', compact('categories')); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);
    
        $service = Service::create($validated);
        $type = $service->category->type;
        $message = $type === 'produk' ? 'Produk berhasil ditambahkan' : 'Jasa berhasil ditambahkan';
    
        return redirect()->route('service.index')->with('success', $message);
    }
    
    public function update(Request $request, Service $service){
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id'
    ]);

    $service->update($validated);
    $type = $service->category->type;
    $message = $type === 'produk' ? 'Produk berhasil diperbarui' : 'Jasa berhasil diperbarui';

    return redirect()->route('service.index')->with('success', $message);
    }

    

    public function destroy(Service $service){
    $type = $service->category->type;
    $service->delete();
    $message = $type === 'produk' ? 'Produk berhasil dihapus' : 'Jasa berhasil dihapus';

    return redirect()->route('service.index')->with('success', $message);
    }
}





