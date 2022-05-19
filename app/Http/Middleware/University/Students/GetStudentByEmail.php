<?php

namespace App\Http\Middleware\University\Students;

use Closure;
use Validator;
use App\Http\Middleware\University\Rules;
use App\Rules\EmailExistingInStudentsTable;

class GetStudentByEmail
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

        $array_to_check = $request->all();
        $rules = $this->getArrayOfRules();

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

    protected function getArrayOfRules() : array {

        $rules = [
            'email' =>      $this->getRulesForStudentEmail( [ 'required', new EmailExistingInStudentsTable ] ),
        ];

        return (array) $rules;
    }




}
