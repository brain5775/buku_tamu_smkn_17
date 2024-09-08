<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $fillable = ['name','email'];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function get_data(){
        
    }
}
