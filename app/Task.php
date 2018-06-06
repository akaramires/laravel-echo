<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Task
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $body
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereUpdatedAt($value)
 * @property int $project_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereProjectId($value)
 */
class Task extends Model
{
    protected $fillable = [
        'project_id',
        'body',
    ];
}
