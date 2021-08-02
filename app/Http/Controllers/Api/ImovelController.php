<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Imoveis\PostImoveisRequest;
use App\Http\Requests\Imoveis\PutImoveisRequest;
use Illuminate\Http\Request;
use App\mod_imovel;

class ImovelController extends Controller
{
    private $imoveis;

    public function __construct(mod_imovel $imoveis){

        $this->imoveis = $imoveis;
    }

    public function getImoveis(Request $request)
    {

        $imoveis = $this->imoveis->orderBy('titulo', 'ASC');

        $this->filtros($request,$imoveis);

        $data = $imoveis->get();

        if($data->count() == 0){
            return response()->json([
                'message' => 'Nenhum imovel cadastrado!',
            ],200);
        }

        return response()->json([
            'data' => $data,
            'message' => 'congratulation',
        ],200);
    }

    public function postImoveis(PostImoveisRequest $request)
    {
        $imovel = $this->imoveis->create([
            'codigo' => $request->codigo,
            'tipo' => $request->tipo,
            'pretensao' => $request->pretensao,
            'titulo' => $request->titulo,
            'detalhes' => $request->detalhes,
            'quartos' => $request->quartos,
            'valor' => $request->valor
        ]);

        return response()->json([
            'data' => $imovel,
            'message' => 'congratulation',
        ],200);
    }

    public function putImoveis(PutImoveisRequest $request, $id)
    {
        if($this->imoveis->where('id',$id)->exists()) {

            $imovel = $this->imoveis->find($id);

            $imovel->fill($request->all())->save();

            return response()->json([
                'data' => $imovel,
                'message' => 'congratulation',
            ], 200);
        }else{
            return response()->json([
                "message"=> "não existe imovel"
            ],404);
        }
    }

    public function deleteImoveis(Request $request, $id)
    {
        if($this->imoveis->where('id',$id)->exists()){

        $imovel = $this->imoveis->find($id);

        $imovel->delete();

        return response()->json([
            'message' => 'congratulation',
        ],200);
        }else{
            return response()->json([
                "message"=> "não existe imovel"
            ],404);
        }
    }

    public function filtros($request, $imoveis){


        if($request->codigo !== null){
            $imoveis->where('codigo', $request->codigo);
        }

        if($request->tipo !== null){
            $imoveis->where('tipo', $request->tipo);
        }

        if($request->pretensao !== null){
            $imoveis->where('pretensao', $request->pretensao);
        }

        if($request->titulo !== null){
            $imoveis->where('titulo', $request->titulo);
        }

        if($request->detalhes !== null){
            $imoveis->where('detalhes', $request->detalhes);
        }

        if($request->quartos !== null){
            $imoveis->where('quartos', $request->quartos);
        }

        if($request->valor !== null){
            $imoveis->where('valor', $request->valor);
        }

        if($request->max !== null && $request->min){
            $imoveis->whereBetween('valor',[$request->min, $request->max]);
        }

        return $imoveis;
    }


}
