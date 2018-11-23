@auth
<div class="modal fade" id="vaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('purchase')}} {{__('Keys')}} {{__('USING')}}  {{__('Vault')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h5 style="color:#000;">{{__('your')}} {{__('Vault')}}  {{__('balance')}} <strong>{{round(Auth::user()->balance, $gnl->decimal)}}</strong> {{__($gnl->cur)}}</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-block" id="vaultButton"  data-dismiss="modal">{{__('Confirm')}} {{__('purchase')}}</button>
            </div>
        </div>
    </div>
</div>
@endauth

<div class="modal fade" id="rulesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__($front->about_heading)}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>{!!__($front->about_details)!!}</p>
            </div>
        </div>
    </div>
</div>