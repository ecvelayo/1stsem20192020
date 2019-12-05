<div id="flash-overlay-modal" class="modal fade {{ $modalClass or '' }}">
    <div class="modal-dialog">
        <div class="modal-content border border-{{ Session::get('alert-class', 'alert-info') }}" style="border-width: 50px;border-style: solid">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <p style="font-size: 40px" class="text-{{ Session::get('alert-class', 'alert-info') }}"><i class="fas fa-fw fa-check-square"></i>
                {!! $body !!}</p>
            </div>

        </div>
    </div>
</div>
