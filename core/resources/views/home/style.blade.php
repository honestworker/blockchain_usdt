<script>
    function createCountDown(elementId, distance) {
        var x = setInterval(function() {      
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById(elementId).innerHTML = hours + ": "+ minutes + ": " + seconds + " ";
            if (distance < 0) {
                $.get( "{{route('endRound')}}", function( data ) {if(data==111){location.reload();}});
                clearInterval(x);
                document.getElementById(elementId).innerHTML = "ROUND OVER";
            }
            distance = distance - 1000;
        }, 1000);
    }
    createCountDown('endinTop', '{{$distance}}');
    createCountDown('endinBottom', '{{$distance}}');
</script>