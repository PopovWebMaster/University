<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassesModel extends Model
{
    protected $table = 'classes';
    protected $fillable = [
        'name', 
        'lecture_order',
    ];

    public $timestamps = false;

    public function checkNameExistence( $checkedName ){
        $result = false;

        $classes = $this->get();

        foreach( $classes as $class ){
            if($class->name === $checkedName ){
                $result = true;
                break;
            };
        };
        
        return $result;

    }


}
