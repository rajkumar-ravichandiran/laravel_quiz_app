<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;


class Category extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $table = 'categories';


    protected $fillable = [
        'name',
        // Add other fillable columns
    ];
    
    public $sortable = [
        'id', 'name', 'created_at'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
