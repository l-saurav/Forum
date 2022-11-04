<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Status;
use PhpParser\Node\Expr\FuncCall;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $perPage = 10;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function discussion()
    {
        return $this->belongsTo(discussion::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
