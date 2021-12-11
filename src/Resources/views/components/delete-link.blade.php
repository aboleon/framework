<a class="btn btn-sm btn-danger"
   href="#"
   data-bs-toggle="modal"
   data-bs-target="#myModal{{ $reference }}">
    <i class="fa fa-times"></i>
</a>
<div id="myModal{{ $reference }}"
     class="modal fade"
     tabindex="-1"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ $route }}">
                @method('delete')
                @csrf
                <div class="modal-header">
                    <h5>{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true" aria-label="{{ __('aboleon.framework::ui.close') }}">
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ $question }}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm" data-bs-dismiss="modal" aria-hidden="true">{{ __('aboleon.framework::ui.cancel') }}</button>
                    <button class="btn btn-warning btn-sm">{{ __('aboleon.framework::ui.confirm') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
