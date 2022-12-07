<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static latest()
 * @method static create(array $array)
 * @method static exists()
 */
class TableB extends Model
{
    use HasFactory;

    protected $fillable = ['start_count','table_a_id'];

    protected $table = 'table_b';

    public function tableA(): BelongsTo
    {
        return $this->belongsTo(TableA::class);
    }
}
