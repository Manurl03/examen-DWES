<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CE extends Model
{
    /** @use HasFactory<\Database\Factories\CEFactory> */
    use HasFactory;

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    protected $table = 'ccee';

}
