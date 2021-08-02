<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Imoveis\PostInteressadosRequest;
use App\Http\Requests\Imoveis\PutInteressadosRequest;
use App\mod_imovel;
use Illuminate\Http\Request;
use App\mod_interesse;

class InteressadosController extends Controller
{
    private $interessados;
    private $imoveis;


    public function __construct(mod_interesse $interessados, mod_imovel $imoveis){

        $this-> interessados = $interessados;
        $this-> imoveis = $imoveis;

    }

    public function getInteressados(Request $request)
    {
        $interessados = $this->interessados->with('interest')->orderBy('nome', 'ASC');

        $this->filtros($request,$interessados);

        $data = $interessados->get();

        if($data->count() == 0){
            return response()->json([
                'message' => 'Nenhum interessado cadastrado!',
            ],200);
        }

        return response()->json([
            'data' => $data,
            'message' => 'congratulation',
        ],200);
    }


    public function postInteressados(PostInteressadosRequest $request)
    {
        $interessado =$this->interessados->create([
            'nome' => $request-> nome,
            'email' => $request-> email
        ]);

        if($request->imovel_id !== null){
            $interessado->interest()->attach($request->imovel_id);
        }


        return response()->json([
            'data' => $interessado,
            "message" =>"interesse criado"
        ],200);
    }

    public function putInteressados(PutInteressadosRequest $request, $id)
    {

        if($this->interessados->where('id',$id)->exists()) {

            $interessado = $this->interessados->find($id);

            if ($request->imovel_id !== null) {
                $interessado->interest()->sync($request->imovel_id);
            }

            $interessado->fill($request->all())->save();
            return response()->json([
                'data' => $interessado,
                "message" => "interesse atualizado"
            ], 200);
        }else{
            return response()->json([
                "message"=> "não existe interessados"
            ],404);
        }
    }


    public function deleteInteressados(Request $request,$id)
    {
        if($this->interessados->where('id',$id)->exists()){

            $interesse = $this->interessados->find($id);
            $interesse->delete();

            return response()->json([
                "message" => "interesse deletado"
            ],202);
         }else{
             return response()->json([
                 "message"=> "não existe interesse"
             ],404);
         }
        }

    public function filtros($request, $interessados){

        if($request->nome !== null){
            $interessados->where('nome', $request->nome);
        }

        if($request->email !== null){
            $interessados->where('email', $request->email);
        }

        if($request->imovel_id !== null){
            $imovel_id = $request->imovel_id;
            $interessados->whereHas('interest', function ($q) use ($imovel_id){
                $q->where('imovel_id', $imovel_id);
            });

        }
        return $interessados;

    }
}
