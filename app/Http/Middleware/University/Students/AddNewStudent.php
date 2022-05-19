<?php

declare(strict_types = 1);

namespace App\Http\Middleware\University\Students;

use Closure;
use Validator;
use App\Http\Middleware\University\Rules;

class AddNewStudent
{
    use Rules;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $array_to_check =   $this->createArrayForCheck( $request );
        $rules =            $this->getArrayOfRules();

        $validator = Validator::make( $array_to_check, $rules );

        if( $validator->fails() ){

            $arrResponseErrors = [
                'error' => true,
                'message' => $validator->getMessageBag()->all(),
            ];

            return response()->json( $arrResponseErrors, 400 );

        };

        return $next($request);

    }

    protected function createArrayForCheck( $request ) : array {

        $checkArray = [];

        if( isset( $request->name ) ){
            $checkArray['name'] = $request->name;
        };

        if( isset( $request->email ) ){
            $checkArray['email'] = $request->email ;
        };

        if( isset( $request->class_name ) ){
            $checkArray['class_name'] = $request->class_name;
        };

        return (array) $checkArray;

    }

    protected function getArrayOfRules() : array {

        $rules = [
            'name' =>       $this->getRulesForStudentName( ['required']) ,
            'email' =>      $this->getRulesForStudentEmail( ['required'] ),
            'class_name' => $this->getRulesForClassName( ['required'] ), 
        ];

        return (array) $rules;
    }










}
