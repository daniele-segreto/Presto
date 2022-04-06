<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    
    public function home()
    {
        $announcements = Announcement::where('is_accepted', true)
        ->orderBy('created_at', 'desc')
        ->take(8)
        ->get();
        return view('home', compact('announcements'));
    }

    public function announcementByCategory($name, $category_id){

        $category = Category::find($category_id);
        $announcements = $category->announcements()
        ->where('is_accepted', true)
        ->orderBy('created_at', 'desc')
        ->paginate(8);
        return view('announcements.category', compact('category', 'announcements'));
    }

    public function locale($locale)
    {
        session()->put('locale', $locale);
        return redirect()->back();
    }
}