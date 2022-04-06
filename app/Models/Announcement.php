<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Laravel\Scout\Searchable;
use App\Models\AnnouncementImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use Searchable;
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'price',
        'category_id',
        'user_id',
    ];

    public function toSearchableArray()
    {

        $category = $this->category;
        $array = [
            'id' => $this->id, //php artisan scout:import "App\Models\Announcement"
            'title' => $this->title, //php artisan scout:flush "App\Models\Announcement" (per ribuzzare)
            'body' => $this->body,
            'price' => $this->price,
            'altro' => 'macchina volvo ferrari',
            'category' => $category
        ];

        return $array;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    static public function ToBeRevisionedCount()
    {
        return Announcement::where('is_accepted', null)->count();
    }

    public function images()
    {
        return $this->hasMany(AnnouncementImage::class);
    }
}
