<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = []; // or better $fillable = ['title', 'description', 'url', 'image'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function profileImage(){ // strange to have this method in MODEL no in controller ???

        $imgPath = ($this->image) ? $this->image : 'profile/noimg.jpg'; // !!!!!!!!
        
        return '/storage/' . $imgPath;  // ypu cant just put this here ($this->image) ? $this->image : 'noimg.jpg'

    }
}
