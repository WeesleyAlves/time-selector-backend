<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipe;

class ControllerEquipes extends Controller
{
    public function getAll() {
        $equipes = Equipe::get();
        return(json_encode($equipes));
    }

    public function getId($id){
        $equipe = Equipe::where('id_equipe',$id)->get();

        if( !empty($equipe[0]) ){
            return (json_encode($equipe[0]));
        }else{
            return 'Erro: Equipe Não Existente';
        }
    }

    public function autoDelete($id) {
        $equipe = Equipe::where('id_equipe',$id)->get();
        $equipe = $equipe[0];
        $vazio = true;

        if( $equipe->goleiro == null ){
            for($i=1;$i<5;$i++){
                $linha = 'linha'.$i;
            
                if( $equipe->$linha !== null){
                    $vazio = false;
                }
                
            }
            
        }else{
            $vazio = false;
        }

        if($vazio == true) {
            if( Equipe::where('id_equipe', $id)->delete() ){
                return 'Time Deletado';
            }
        }else{
            return 'Time com Jogadores';
        }
    }

    public function delete(Request $request) {
        $data = file_get_contents('php://input');
        $data = json_decode($data);

        $equipe = Equipe::where('id_equipe',$data->id)->get();

        if( !empty($equipe[0]) ){
            $equipe = $equipe[0];
            $erro = 'Jogador não encontrado no time';

            if( $data->posicao == 'linha' ){
                $encontrado = false;
                for($i=1;$i<5;$i++){
                    $linha = 'linha'.$i;

                    if( $equipe->$linha == $data->nomeJogador ){
                        if( Equipe::where('id_equipe',$data->id)->update([$linha=>null]) ){
                            $this->autoDelete($data->id);
                            $encontrado = true;
                            return 'Sucesso!';
                        }else{
                            return 'Erro na Requisição';
                        }
                        break;
                    }
                }

                if(!$encontrado){
                    return 'Jogador não encontrado';
                }

            }else if( $data->posicao == 'goleiro' ){
                if($equipe->goleiro == $data->nomeJogador){
                    if( Equipe::where('id_equipe',$data->id)->update(['goleiro'=>null]) ){
                        $this->autoDelete($data->id);
                        return 'Sucesso';
                    }else{
                        return 'Erro na Requisição!';
                    }
                }else{
                    return $erro;
                }
            }else{
                return 'Posição não existente';
            }
        }else{
            return 'Erro: Equipe não encontrada';
        }
       
    }

    public function montar($id, Request $request){
        $data = file_get_contents('php://input');
        $data = json_decode($data);

        $equipe = Equipe::where('id_equipe',$id)->get();
        

        if(!empty($equipe[0])){
            $equipe = $equipe[0]; 
            $msgSucesso = 'Jogador adicionado com sucesso!';
            
            if($data->posicao == 'goleiro'){
                if(!$equipe->goleiro){

                    if( Equipe::where('id_equipe', $id)->update(['goleiro' => $data->nomeJogador]) ){
                        return $msgSucesso;
                    }else{
                        return 'Erro na requisição';
                    }

                }else{
                    return 'Erro: Equipe já possui goleiro.';
                }
            
            }else if($data->posicao == 'linha'){
                $sucesso = false;
                $erro = 'Linhas já estão completos';

                for($i=1;$i<5;$i++){
                    $linha = 'linha'.$i;

                    if( !$equipe->$linha ){

                        if( Equipe::where('id_equipe', $id)->update(['linha'.$i => $data->nomeJogador]) ){
                            $sucesso = true;
                            break;
                        }else{
                            $erro = 'Erro na Requisição!';
                        }
                    
                    }

                }

                if($sucesso){
                    return $msgSucesso;
                }else{
                    return $erro;
                }

            }else{
               return 'Posição Inválida';
            }
        }else{
            return 'Erro: Time não existente!';
        }
    }

    public function insert(Request $request){
        $data = file_get_contents('php://input');
        $data = json_decode($data);
        $token = md5(uniqid(rand(),true));

        if( Equipe::create([
            'id_equipe'=> $token,
            'nome'=> $data->nome,
            'local'=> $data->local,
            'horaEntrada'=> $data->horaEntrada,
            'horaSaida'=> $data->horaSaida ])
        ){
            
           return $this->montar($token, $request);
            
        }else{
            return 'Erro na requisição';
        }


    }
}
