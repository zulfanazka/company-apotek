<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardProduct extends Model
{
    use HasFactory;
     protected $table = 'card_product';

    protected $fillable = ['title', 'text', 'image', 'layout', 'text_align', 'fit_mode', 'position'];
}
