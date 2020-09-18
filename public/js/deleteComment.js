
$(".deleteComment").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax(
        {
            url: 'comment/delete/'+id,
            type: 'DELETE',
            data: {
                "id": id,
                "_token": token,
            },
            success: function (e){
                console.log(e);
                var comment = document.getElementById('comment ' + id);
                comment.remove();
            }

        });
});
