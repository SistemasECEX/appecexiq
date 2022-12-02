<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class register_document extends Model
{
    use HasFactory;
    public function responsable()
    {
        return User::find($this->responsable_id);
    }
}
