<?php 

declare(strict_types = 1);

namespace App\Http\Middleware\University;
use App\Rules\ExistsInTableClasses;

trait Rules
{
   
    public function getRulesForStudentName( $array_of_added_rules = [] ) : array {

        $regex_name = '/^[_a-zA-ZабвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ \-\']+$/';
        $rules = [ 'string', 'max:100', 'regex:'.$regex_name ];

        return array_merge( $array_of_added_rules, $rules );

    }
    
    public function getRulesForStudentEmail( $array_of_added_rules = [] ) : array {

        $rules = [ 'email', 'unique:students' ];

        return array_merge( $array_of_added_rules, $rules );

    }

    public function getRulesForClassName( $array_of_added_rules = [] ) : array {

        $rules = [ 'string', 'max:100', new ExistsInTableClasses ];

        return array_merge( $array_of_added_rules, $rules );

    }





}




?>