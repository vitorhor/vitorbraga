<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function setNewData($originalName, $fileName){
        $this->user_id = Auth::id();
        $this->original_name = $originalName;
        $this->file_name = $fileName;
        $this->code = Str::random(7);
        $this->download_count = 0;
    }

    public function scopeFindByCode($query, $code)
    {
        return $query->where('code', $code);
    }
}
