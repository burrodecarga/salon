<?php

namespace App\Filters;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;
class ExamenFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'type' => ['eq'],
        'level' => ['eq'],
        'asignatura' => ['eq'],
        'modulo' => ['eq'],
        'lesson' => ['eq'],
        'aula_id' => ['eq'],
        'asignatura_id' => ['eq'],
        'modulo_id' => ['eq'],
        'lesson_id' => ['eq'],
        'teacher_id' => ['eq'],
        'activo' => ['eq', 'neq'],
    ];
    protected $columnMap = [
        //comoEjempo='como_ejemplo
    ];
    protected $operatorMap = [

        'eq' => '=',
        'neq' => '<>'
    ];


}
