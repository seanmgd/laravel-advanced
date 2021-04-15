<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function format()
    {
        return [
            'customer_id' => $this->id,
            'name' => $this->name,
            'last_updated' => $this->updated_at->diffForHumans(),
        ];
    }
}
