<script src="jquery/jquery.min.js"></script>
<script>
    $(".sidebar ul li").on('click', function(){ 
        $(".sidebar .active").removeClass('active');
        $(this).addClass('active')
    });
</script>