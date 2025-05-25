<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardProfile extends Model
{
    use HasFactory;
     protected $table = 'card_profile';

    protected $fillable = ['title', 'text', 'image', 'layout', 'text_align', 'fit_mode', 'position'];
}
