
@section('modals')

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">  {{__('cruds.modals.confirm_action')}}  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                {{__('cruds.modals.confirm_delete')}}
            </div>
            <div class="modal-footer">
                <form action="" method="post" id="deleteForm">
                    @method('delete')
                    @csrf 
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('global.cancel')}}</button>
                    <button type="submit" class="btn btn-danger" >{{__('cruds.modals.accept_delete')}}</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $(document).ready(function () {   
    $('.delete_link').on('click' ,function () {        
        $('form#deleteForm').attr('action', $(this)[0].href);
    });
});

</script>
@endsection