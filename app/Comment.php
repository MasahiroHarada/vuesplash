<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** JSONに含める属性 */
    protected $visible = [
        'author', 'content',
    ];

    /**
     * リレーションシップ - usersテーブル
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }
}
