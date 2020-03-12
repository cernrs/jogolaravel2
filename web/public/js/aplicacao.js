$( document ).ready(function() {
    
    // Data tables
    var iOrderBy = $("#dataTable").attr("orderBy");
    $("#dataTable").DataTable({
        
        "lengthMenu" : [[10, 25, -1], [10, 25, "Todos"]],
        "language"   : { "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json" },
        "order": [ iOrderBy, 'asc' ],
        "paging": true,
    
    });
    
    // Configurações calendário
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        language: 'pt-BR'
    })
    if($('#data').val() == ""){   // Se for nova etapa define data como a atual
        $('.datepicker').datepicker("setDate", new Date());
    }
   
    // Configuraações botão desliza
    $('#inscricoes_abertas').bootstrapToggle({
        on: 'Simm',
        off: 'Não',
        size: 'small',
        onstyle: 'success',
        offstyle: 'danger'
    });

    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? true : false; 
        var etapa_id = $(this).data('id'); 
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/admin/etapas/abreFechaInscricoes/',
            data: {'inscricoes_abertas': status, 'etapa_id': etapa_id},
            success: function(data){
            }
        });
    })


    // Mascara para etapa
    $('#etapaCadastro').mask('99');
    
    // Mascara para celular
    $('#cel').mask('(00) 00000-0009');
    $('#cel').blur(function(event) {
        if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
            $(this).mask('(00) 00000-0009');
        } else {
            $(this).mask('(00) 0000-00009');
        }
    });   

    // Mensagem confirmar exclusão
    $('a[data-confirm]').click(function(ev){
        var href = $(this).attr('href');
        if(!$('#confirm-delete').length){
            $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5><button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true" class="text-white">&times;</span></button></div><div class="modal-body">Tem certeza que deseja excluir ?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><a class="btn btn-primary text-white" id="dataConfirmOk">Confirmar</a></div></div></div></div>');
        }
        $('#dataConfirmOk').attr('href', href);
        $('#confirm-delete').modal({shown:true});
        return false;
    });

    // Preview imagem perfil
    $('#image').change(function(){
        const file = $(this)[0].files[0]
        const fileReader = new FileReader()   
        fileReader.onloadend = function () {
            $('#img').attr('src', fileReader.result)
        }
        fileReader.readAsDataURL(file)
    })

    $("#checkTodos").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

});
