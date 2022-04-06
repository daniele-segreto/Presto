<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Jobs\ResizeImage;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\AnnouncementImage;
use App\Jobs\GoogleVisionLabelImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Jobs\GoogleVisionSafeSearchImage;
use App\Http\Requests\AnnouncementRequest;
use App\Jobs\GoogleVisionRemoveFaces;

class AnnouncementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Announcement $announcement)
    {
        return view('announcements.detail', compact('announcement'));
    }

    public function newAnnouncement(Request $request)
    {
        $uniqueSecret = $request->old(
            'uniqueSecret',
            base_convert(sha1(uniqid(mt_rand())), 16, 36)
        );
        
        return view('announcements.new', compact('uniqueSecret'));
    }

    public function createAnnouncement(AnnouncementRequest $request)
    {
        $a = new Announcement();
        $a->title = $request->input('title');
        $a->body = $request->input('body');
        $a->price = $request->input('price');
        $a->category_id = $request->input('category');
        $a->user_id = Auth::id();

        $a->save();

        $uniqueSecret = $request->input('uniqueSecret');

        // dd($uniqueSecret);

        $images = session()->get("images.{$uniqueSecret}", []);
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);

        $images = array_diff($images, $removedImages);

        foreach ($images as $image) {
            $i = new AnnouncementImage();

            $fileName = basename($image);
            $newFileName = "public/announcements/{$a->id}/{$fileName}";
            Storage::move($image, $newFileName);

            $i->file = $newFileName;
            $i->announcement_id = $a->id;

            $i->save();
            
            GoogleVisionSafeSearchImage::withChain([
                new GoogleVisionLabelImage($i->id),
                new GoogleVisionRemoveFaces($i->id),
                new ResizeImage($i->file, 300, 150),
                new ResizeImage($i->file, 400, 300),
                new ResizeImage($i->file, 800, 250),
            ])->dispatch($i->id);  

        }

        File::deleteDirectory(storage_path("/app/public/temp/{$uniqueSecret}"));

        return redirect('/')->with('announcement.created.success', 'Il tuo annunncio è in fase di revisione');
    }

    public function announcementUpdate(Announcement $announcement)
    {
        return view("announcements.update", compact("announcement"));
    }

    public function announcementEdit(Announcement $announcement, AnnouncementRequest $request)
    {

        if ($request->file('img')) {
            $announcement->update([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'img' => $request->file('img')->store('public/img'), //da inserire
                'price' => $request->input('price'),
            ]);
        } else {
            $announcement->update([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'price' => $request->input('price'),
            ]);
        }

        return redirect(route('home'));
    }

    // public function announcementDelete(Announcement $announcement)
    // {
    //     $announcement->delete();

    //     return redirect(route('home'));
    // }


    //da mettere su un altro controller
    public function search(Request $request)
    {
        $q = $request->input('q');

        $announcements = Announcement::search($q)->where('is_accepted', true)->get();

        $categories = Category::all();

        return view('announcements.search', compact('q', 'announcements', 'categories'));
    }


    // Dropzone Upload
    public function uploadImage(Request $request)
    {
        // dd($request->input());
        $uniqueSecret = $request->input('uniqueSecret');

        $fileName = $request->file('file')->store("public/temp/{$uniqueSecret}");

        dispatch(new ResizeImage(
            $fileName,
            300,
            150
        ));

        session()->push("images.{$uniqueSecret}", $fileName);

        // dd(session()->get("images.{$uniqueSecret}"));

        return response()->json(
            [
                'id' => $fileName
            ]
        );
    }

    // Dropzone Remove
    public function removeImage(Request $request)
    {
        $uniqueSecret = $request->input('uniqueSecret');

        $fileName = $request->input('id');

        session()->push("removedimages.{$uniqueSecret}", $fileName);

        Storage::delete($fileName);

        return response()->json('ok');
    }

    public function getImages(Request $request)
    {
        $uniqueSecret = $request->input('uniqueSecret');

        $images = session()->get("images.{$uniqueSecret}", []);
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);

        $images = array_diff($images, $removedImages);

        $data = [];

        foreach ($images as $image) {
            $data[] = [
                'id' => $image,
                'src' => AnnouncementImage::getUrlByFilePath($image, 120, 120)
            ];
        }
        return response()->json($data);
    }
}
