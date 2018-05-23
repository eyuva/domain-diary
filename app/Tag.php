<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function domains(){
        return $this->belongsToMany(Domain::class,'domain_tags', 'tag_id', 'domain_id');
    }
}
