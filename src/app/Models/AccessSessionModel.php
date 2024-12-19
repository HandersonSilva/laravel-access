<?php

namespace SecurityTools\LaravelAccess\Models;

use Illuminate\Database\Eloquent\Model;

class AccessSessionModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'access_sessions';

    /**
     * Timestamps
     */
    public $timestamps = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     *  auto-incrementing ID.
     *
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nonce',
        'ip_address',
        'user_agent',
        'last_activity',
        'access_cookie',
        'expires_at',
    ];
}
