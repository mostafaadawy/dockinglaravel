<?php
namespace App\Filters\V1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;
class InvoiceFilter extends ApiFilter{
    protected $safeParms=[
        'customerId'=>['eq'],
        'amount'=>['eq','gt','lt','gte','lte','ne'],
        'status'=>['eq','ne'],
        'billedDate'=>['eq','gt','lt','gte','lte','ne'],
        'paidDate'=>['eq','gt','lt','gte','lte','ne'],
    ];
    protected $columnMap=[
        'customerId'=>'customer_id',
        'billedDate'=>'billed_date',
        'paidDate'=>'paid_date',
    ];
    protected $operatorMap=[
        'eq'=>'=',
        'gt'=>'>',
        'gte'=>'>=',
        'lt'=>'<',
        'lt'=>'<=',
        'ne'=>'<>',
    ];
}
