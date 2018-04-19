<?php

namespace App;
use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    public static $PRIORITY_LOW = 1;
    public static $PRIORITY_MEDIUM = 2;
    public static $PRIORITY_HIGH = 3;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'due_at',
        'completed_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $with = ['priority', 'category'];

    protected $appends = ['is_complete'];

    /**
     * Get the user to which the Todo has been assigned.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the category to which the Todo has been assigned.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() 
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get the priorty to which the Todo has been assigned.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priority() 
    {
        return $this->belongsTo('App\Priority');
    }

    public function getIsCompleteAttribute()
    {
        return $this->completed_at ? true : false;
    }

    public function setIsCompleteAttribute(Bool $isComplete)
    {
        $this->completed_at = $isComplete ? now() : null;
    }
}
