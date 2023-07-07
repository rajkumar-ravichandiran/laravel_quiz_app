<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;


class Question extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $table = 'questions';

    protected $fillable = [
        'question','category_id','type','level','summary','image','choices','answer','created_by','active'
        // Add other fillable columns
    ];
    public $sortable = [
        'id', 'question', 'created_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getQuestionTypeAttribute(){
        $type = 'Multiple Choices';
        if($this->type == 1){
            $type = 'True / False';
        }
        return $type;
    }

    public function getQuestionLevelAttribute(){
        $level = 'Easy';
        if($this->level == 1){
            $level = 'Easy';
        }
        if($this->level == 2){
            $level = 'Medium';
        }
        if($this->level == 3){
            $level = 'Hard';
        }
        return $level;
    }

    public function creater()
    {
        return $this->hasOne(User::class, 'id','created_by');
    }

}
