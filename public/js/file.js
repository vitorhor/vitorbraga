var removeProduct = function(fileId){

    var content = 'Delete this file?';

    $.confirm({
        title: "File",
        content: content,
        buttons: {
            confirm: {
                text: 'Confirm',
                action: function () {
                    $.LoadingOverlay('show');
                    sendRemoveFileRequest(fileId);
                }
            },
            cancel: {
                text: 'Cancelar',
                action: function () {}
            }

        }
    });

};

var sendRemoveFileRequest = function(fileId){

    $.ajax(
        {
            url: routes.deleteFile,
            type: "post",
            data: {
                fileId: fileId,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){

                $.LoadingOverlay("hide");

                if( !data.success ){
                    alert("Não foi possível realizar a operação");
                    return;
                }

                location.reload();

            }
        }
    );

}
