<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Project
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Task[] $tasks
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereName( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUpdatedAt( $value )
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $participants
 * @property string $title
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereTitle($value)
 */
class Project extends Model
{
    protected $fillable = [
        'name',
    ];

    public function tasks()
    {
        return $this->hasMany( Task::class );
    }

    public function participants()
    {
        return $this->belongsToMany( User::class, 'project_participants' );
    }
}
