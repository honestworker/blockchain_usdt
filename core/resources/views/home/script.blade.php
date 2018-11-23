<script>
    $(document).ready(function(){
        $('#keyAmount').keyup(function(){
            let key = $('#keyAmount').val();
            let price = '{{$price}}';
            let newPrice = key*price;
            $('#keyPrice').text(newPrice.toFixed(8));
        });
        $('#oneButton').click(function(){
            let key = $('#keyAmount').val();
            let newKey = parseInt(key) + 1;
            $('#keyAmount').val(newKey);
            let price = '{{$price}}';
            let newPrice = newKey*price;
            $('#keyPrice').text(newPrice.toFixed(8));
        });
        $('#twoButton').click(function(){
            let key = $('#keyAmount').val();
            let newKey = parseInt(key) + 2;
            $('#keyAmount').val(newKey);
            let price = '{{$price}}';
            let newPrice = newKey*price;
            $('#keyPrice').text(newPrice.toFixed(8));
        });
        $('#fiveButton').click(function(){
            let key = $('#keyAmount').val();
            let newKey = parseInt(key) + 5;
            $('#keyAmount').val(newKey);
            let price = '{{$price}}';
            let newPrice = newKey*price;
            $('#keyPrice').text(newPrice.toFixed(8));
        });
        $('#tenButton').click(function(){
            let key = $('#keyAmount').val();
            let newKey = parseInt(key) + 10;
            $('#keyAmount').val(newKey);
            let price = '{{$price}}';
            let newPrice = newKey*price;
            $('#keyPrice').text(newPrice.toFixed(8));
        });
        
        $('.selectedTeam').click(function(){
            $('.selectedTeam').removeClass( "bg-secondary" );
            $('.selectedTeam').addClass( "bg-dark" );
            $(this).removeClass( "bg-dark" );
            $(this).addClass( "bg-secondary" );
            let teamID = $(this).data('team');
            $('#teamSlectedID').val(teamID);
        });
        
        //SEND DEPOSIT
        $(document).on('submit','#purchaseForm',function(ev){ ev.preventDefault(); });
        
        $(document).on('click','#sendButton',function(event)
        {
            event.preventDefault();
            $('#delaySpiner').show();
            $.ajax({
                type:"POST",
                url:"{{route('deposit.confirm')}}",       
                data: new FormData(document.getElementById('purchaseForm')),
                contentType: false,
                processData: false,
                success:function(data)
                {
                    console.log(data)
                    if(data==99)
                    {
                        $('#delaySpiner').hide();   
                        $.notify({ allow_dismiss: true,title: "Sorry!",message: "Invalid Amount" }, { type: 'danger' });
                    }
                    else if(data==88)
                    {
                        $('#delaySpiner').hide();   
                        $.notify({ allow_dismiss: true,title: "Sorry!",message: "Error Occured" }, { type: 'danger' });
                    }
                    else if(data==77)
                    {
                        $('#delaySpiner').hide();   
                        $.notify({ allow_dismiss: true,title: "Sorry!",message: "Please Select A Team" }, { type: 'danger' });
                    }
                    else if(data.status==11)
                    {
                        $('#delaySpiner').hide();            
                        $('#depositCard').show();
                        $('#purchaseForm').hide();
                        $('#sendAmount').text(data.amount);
                        $('#depositAddress').text(data.wallet);
                        let qrcode = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='+data.wallet+'&choe=UTF-8';
                        $('#depositQRCode').attr('src', qrcode);    
                    }
                    else
                    {
                        $('#delaySpiner').hide();   
                        $.notify({ allow_dismiss: true,title: "Sorry!",message: "Unexpected Error Occured" }, { type: 'danger' });
                    }
                }
            });
        });
        
        $(document).on('click','#vaultButton',function(e)
        {
            e.preventDefault();
            $('#delaySpiner').show();
            $.ajax({
                type:"POST",
                url:"{{route('user.purchase')}}",       
                data: new FormData(document.getElementById('purchaseForm')),
                contentType: false,
                processData: false,
                success:function(data)
                {
                    console.log(data)
                    if(data==99)
                    {
                        $('#delaySpiner').hide();   
                        $.notify({ allow_dismiss: true,title: "Sorry!",message: "Invalid Amount" }, { type: 'danger' });
                    }
                    else if(data==88)
                    {
                        $('#delaySpiner').hide();   
                        $.notify({ allow_dismiss: true,title: "Sorry!",message: "Insuffucient Vault Balance" }, { type: 'danger' });
                    }
                    else if(data==77)
                    {
                        $('#delaySpiner').hide();   
                        $.notify({ allow_dismiss: true,title: "Sorry!",message: "Please Select A Team" }, { type: 'danger' });
                    }
                    else if(data == 11)
                    {
                        $('#delaySpiner').hide();        
                        $.notify({ allow_dismiss: true,title: "Success!",message: "Key Purchased Successfully" }, { type: 'success' });
                        setTimeout(function(){ location.reload(); }, 3000);    
                    }
                    else
                    {
                        $('#delaySpiner').hide();   
                        $.notify({ allow_dismiss: true,title: "Sorry!",message: "Error Occured" }, { type: 'danger' });
                    }
                }
            });
        });
        
        
        $("#slideshow > div:gt(0)").hide();
        
        setInterval(function() { $('#slideshow > div:first').fadeOut(1000).next().fadeIn(1000).end().appendTo('#slideshow');}, 3000);
    });
</script>