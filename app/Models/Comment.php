<?php
// app/Models/Comment.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name', 'message', 'avatar_url', 'is_approved'];
    protected $casts    = ['is_approved' => 'boolean'];
}
