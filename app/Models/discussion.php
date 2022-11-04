<?php

namespace App\Models;

use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNotFoundException;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class discussion extends Model
{
    use HasFactory, Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $guarded = [];
    protected $perPage = 10;


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function votes(){
        return $this->belongsToMany(User::class, 'votes');
    }

    public function isVotedByUser(?User $user)
    {
        if(!$user){
            return false;
        }
        return (Vote::where('user_id',$user->id)->where('discussion_id',$this->id)->exists());
    }

    public function vote(User $user)
    {
        if($this->isVotedByUser($user)){
            throw new DuplicateVoteException;
        }
        Vote::create([
            'discussion_id' => $this->id,
            'user_id' => $user->id,
        ]);
    }

    public function removeVote(User $user)
    {
        $voteToDelete = Vote::where('discussion_id',$this->id)->where('user_id',$user->id)->first();
        if ($voteToDelete){
            $voteToDelete->delete();
        }else{
            throw new VoteNotFoundException;
        }
    }

    /*public function getStatusClasses(){
        $allStatuses = [
            'Open' => 'bg-gray-200',
            'Considering' => 'bg-purple text-white',
            'In Progress' => 'bg-yellow text-white',
            'Implemented' => 'bg-green text-white',
            'Closed' => 'bg-red text-white'
        ];
        return $allStatuses[$this->status->name];
    }*/
}
