$(function(){
    $('.dataTable .sortable').on('click', function (){
        window.location = $(this).attr('href');
    });

    $('.entry-delete').on('submit', function (){
        event.preventDefault();

        if (confirm('Delete this entry?')){
            this.submit();
        }
    });

    $('.clickable-row').on('click', function (){
        window.location = $(this).attr('href');
    });
});
