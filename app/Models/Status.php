<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    public function discussion()
    {
        return $this->hasMany(discussion::class);
    }

    public static function getCount(){
        return discussion::query()
            ->selectRaw("count(*) as all_statuses")
            ->selectRaw("count(case when status_id = 1 then 1 end) as unreviewed")
            ->selectRaw("count(case when status_id = 2 then 1 end) as off_topic")
            ->selectRaw("count(case when status_id = 3 then 1 end) as announcement")
            ->selectRaw("count(case when status_id = 4 then 1 end) as unsolved")
            ->selectRaw("count(case when status_id = 5 then 1 end) as solved")
            ->first()
            ->toArray();
    }
}
