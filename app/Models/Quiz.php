<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;


class Quiz extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $table = 'quiz';


    protected $fillable = [
        'category_id', 'user_id' ,'total','score'
        // Add other fillable columns
    ];
    
    public $sortable = [
        'id', 'total', 'score','created_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
