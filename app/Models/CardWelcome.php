<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardWelcome extends Model
{
    use HasFactory;
   protected $table = 'card_welcomes';

    protected $fillable = ['title', 'text', 'image', 'layout', 'text_align', 'fit_mode', 'position'];
}
