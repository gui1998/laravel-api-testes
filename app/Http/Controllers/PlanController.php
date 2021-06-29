<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Plan::query();

        if ($request->has('amount_value')) {            
            $params = $this->queryParams($request->amount_value);
            $query->where('amount_value', $params['condition'], $params['value']);
        }
    
        if ($request->has('discount_value')) {
            $params = $this->queryParams($request->discount_value);
            $query->where('discount_value', $params['condition'], $params['value']);
        }
    
        $query->whereMonth('created_at', '=', date('m'));
        if ($request->has('month')) {        
            $params = $this->queryParams($request->month);
            $query->whereMonth('created_at', $params['condition'], $params['value']);
        }

        $plans = $query->paginate();

        return $plans;
       
    }

    // public function dailyStatistic(){

    //     $plans = DB::table('plans')
    //     ->select(DB::raw('sum(amount_value+discount_value) as total, name'))
    //     ->whereMonth('created_at', '=', date('m'))
    //     ->groupBy('name')
    //     ->get();

    //     return $plans;
    // }


    public function dailyStatistic(){
        $plans = DB::table('plans')
        ->select('id','name',(DB::raw('sum(amount_value+discount_value) as total')))
        ->groupBy('name')
        ->groupBy('id')
        ->get();

        return $plans;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(
            'active',
            'name',
            'identifier',
            'amount_value',
            'discount_value'
        );      

        $created = Plan::create($data);
        
        return response()->json($created, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
