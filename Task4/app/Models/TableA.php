<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property mixed $user_start
 * @property mixed $id
 */
class TableA extends Model
{
    use HasFactory;

    protected $fillable = ['name','user_start'];

    protected $table = 'table_a';


    public function tableB(): HasOne
    {
        return $this->hasOne(TableB::class,'table_a_id');
    }
}
