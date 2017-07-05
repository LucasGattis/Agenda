<?php

    function cadastrar(){
//controlador agenda

$contatosAuxiliar = file_get_contents('contatos.json');
$contatosAuxiliar = json_decode($contatosAuxiliar, true);

    $contato = [
        'id'        =>   uniqid(),
        'nome'      =>  $_POST['nome'],
        'email'     =>  $_POST['email'],
        'telefone'  =>  $_POST['telefone']
    ];

    array_push($contatosAuxiliar, $contato);

    $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);

    file_put_contents('contatos.json', $contatosJson);

    print_r($contatosJson);

    header("location: index.php");
    }
    function pegarContatos(){
        $contatosAuxiliar = file_get_contents('contatos.json');
        $contatosAuxiliar = json_decode($contatosAuxiliar, true);

        return $contatosAuxiliar;
    }

    function excluirContato($id){
        $contatosAuxiliar = file_get_contents('contatos.json');
        $contatosAuxiliar = json_decode($contatosAuxiliar, true);

        foreach ($contatosAuxiliar as $posicao => $contato){
            if($id == $contato['id']) {
                unset($contatosAuxiliar[$posicao]);

            }
        }

        $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);
        file_put_contents($filename = 'contatos.json', $contatosJson);

        header('location: index.php');
    }

    function editarContato($id){
       $contatos = file_get_contents('contatos.json');
       $contatos =json_decode($contatos, true);
        foreach ($contatos as $contato){
            if ($contato ['id'] == $id){
                return $contato;
            }
        }

    }

    function salvarContatoEditado($id){
        $contatos = file_get_contents('contatos.json');
        $contatos =json_decode($contatos, true);
        foreach ($contatos as $posicao => $contato){
            if ($contato ['id'] == $id){

                $contatosAuxiliar[$posicao]['nome'] = $_POST['nome'];
                $contatosAuxiliar[$posicao]['email'] = $_POST['email'];
                $contatosAuxiliar[$posicao]['telefone'] = $_POST['telefone'];

                break;
            }
        }

        $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);
        file_put_contents('contatos.json', $contatosJson);
        header('location: index.php');
    }

    if ($_GET['acao'] ==  'cadastrar'){
        cadastrar();
    }elseif ($_GET['acao'] == 'excluir'){
        excluirContato($_GET['id']);
    }elseif ($_GET['acao'] == 'editar'){
        salvarContatoEditado($_POST['id']);
    }