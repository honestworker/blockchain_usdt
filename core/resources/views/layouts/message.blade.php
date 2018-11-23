@if (session('success'))
<script type="text/javascript">
    $(document).ready(function(){
        $.notify({
            type: 'success',
            allow_dismiss: true,
            title: "Success!",
            message: "{{ session('success') }}"
        });
    });
</script>
@endif

@if (session('alert'))
<script type="text/javascript">
    $(document).ready(function(){
        $.notify({
            type: 'alert',
            allow_dismiss: true,
            title: "Sorry!",
            message: "{{ session('alert') }}"
        },{
            type: 'danger'
           });
    });
</script>
@endif



