<div id="markPaid" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Enter Info</h4>
            </div>
            <div class="modal-body">
                <div style="text-align: center;display: none;z-index: 999999999;" id="Info_loader">
                    <img class="img-responsive" src="{!! asset('local/public/assets/images/load/waiting.gif') !!}">
                </div>
                <span id="paidDetail"></span>
            </div>
        </div>

    </div>
</div>
