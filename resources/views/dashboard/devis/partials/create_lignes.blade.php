<div id="modalForm" class="hidden modal fade modalForm">
    <div class= "modal-dialog modal-lg ">
        <div class="modal-content">
            

        <form id="lineForm" method="POST" action="#">
            <div class="modal-header">
                <h3 class=" modal-title ">Ajouter une ligne</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <div class="modal-body">                            
                <div class="row">                            
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label for="ad">Libéllé<em
                                    style="color:red">*</em></label></label>
                            <input type="text" class="form-control" id="libelle"
                                name="" value="" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ad"> Prix Unitaire<em
                                    style="color:red">*</em></label>
                            <input type="number" class="form-control required" id="prix_unitaire"
                                name="" value="" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ad"> Quantité<em
                                    style="color:red">*</em></label>
                            <input type="number" class="form-control required" id="quantite"
                                name="" value="" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ad">Commentaire</label>
                            <input type="text" class="form-control" id="commentaire"
                                name="comment" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="button" id="saveLineBtn"
                    class="btn btn-primary">Ajouter</button>
            </div>
          
        </form>
        </div>
        
    </div>
</div>