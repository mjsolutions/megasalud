<div id="flash-overlay-modal" class="modal bottom-sheet {{ $modalClass or '' }}">
        <div class="modal-content">
            <h4>{{ $title }}</h4>
            <div class="modal-body">
                <p>{!! $body !!}</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
            </div>
        </div>
</div>