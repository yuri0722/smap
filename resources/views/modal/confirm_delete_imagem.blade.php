<div id="{{$idModal}}" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-center">CONFIRMAÇÃO DE DELETE</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <div class="image" style="background-image:url('{{$caminho}}')">

                    </div>
                    <br>
                    <p class="text-center">Você gostaria de deletar essa imagem?</p>
                </div>
                <div class="modal-footer text-center">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                        <a href="{{route($rota,["id"=>$id,"foto"=>$foto])}}" class="btn btn-danger"  >Sim, Delete</a>
                </div>
            </div>
    </div>
</div>

