<?php

include_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {
    $query_usuario = "DELETE FROM usuarios WHERE id=:id";
    $del_usuario = $conn->prepare($query_usuario);
    $del_usuario->bindParam(':id', $id);

    if ($del_usuario->execute()) {
      
    $query_endereco = "DELETE FROM enderecos WHERE usuario_id=:usuario_id";
    $del_endereco = $conn->prepare($query_endereco);
    $del_endereco->bindParam(':usuario_id', $id);

    if($del_endereco->execute()){

        $retorna = ['status' => true, 'msg' => "<div calss='alert alert-sucess' role='alert'>Usuario apagado com sucesso!</div>"];
    } else {
        $retorna = ['status' => false, 'msg' => "<div calss='alert alert-danger' role='alert'>Erro: Uusario apagado, endereço não apagado com scesso!</div>"];
    }
    } else {
        $retorna = ['status' => false, 'msg' => "<div calss='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"];
    }

    echo json_encode($retorna);
}