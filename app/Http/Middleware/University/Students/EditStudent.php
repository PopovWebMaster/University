<?php

namespace App\Http\Middleware\University\Students;

use Closure;
use Validator;
use App\Http\Middleware\University\Rules;
use App\Rules\EmailIsUniqueForEditStudent;

class EditStudent
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

        $array_to_check =   $request->all();
        $id =               $request->id;
        $rules =            $this->getArrayOfRules( $id );

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

    protected function getArrayOfRules( string $id ) : array {

        $rules = [
            'name' =>       $this->getRulesForStudentName() ,
            'email' =>      $this->getRulesForStudentEmail( [new EmailIsUniqueForEditStudent( $id )] ),
            'class_name' => $this->getRulesForClassName(), 
        ];

        return (array) $rules;
    }
}
