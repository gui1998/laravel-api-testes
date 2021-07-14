<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Exception;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Cliente::query();

        if ($request->has('id')) {
            $params = explode(",", $request->id);
            $condition = (!empty($params[1])) ? $params[1] : '>';
            $value = $params[0];

            $query->where('id', $condition, $value);
            //$query->where('id', '>',  $request->id);
        }

        $query->whereMonth('created_at', '=', date('m'));
        if ($request->has('month')) {
            $params = $this->queryParams($request->month);
            $query->whereMonth('created_at', $params['condition'], $params['value']);
        }

        $produtos = $query->paginate();

        return $produtos;
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
            'nome',
            'data_nascimento',
            'cpf_cnpj',
            'email'
        );

        // $messages = [
        //     'same' => 'The :attribute and :other must match.',
        //     'size' => 'The :attribute must be exactly :size.',
        //     'between' => 'The :attribute value :input is not between :min - :max.',
        //     'in' => 'The :attribute must be one of the following types: :values',
        //     'required' => 'The :attribute field is required.',
        // ];

        $validator = Validator::make($data, [
            'nome' => 'required|string',
            'data_nascimento' => 'date',
            'cpf_cnpj' => 'required|string|unique:clientes',
            'email' => 'email'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $created = Cliente::create($data);

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
