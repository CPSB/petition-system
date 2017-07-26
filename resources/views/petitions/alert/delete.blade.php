{{-- Modal --}}
<div id="petitionDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">

        {{-- Modal content--}}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">U staat op het punt om een petitie te verwijderen.</h4>
            </div>
            <div class="modal-body">
                <p>
                    U staat op het punt om een petitie te verwijderen.
                    Eerst raden we u aan om de handtekeningen te downloaden voor het verder gaan
                    van uw handeling. De data die u hebt verwijderd kan niet worden terug gehaald.
                    Ongeacht welke situatie.
                </p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="petitionId" value="{{ $petition->id }}">

                    <button type="submit" class="btn btn-danger">
                        <span class="fa fa-check" aria-hidden="true"></span> Verwijderen
                    </button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <span class="fa fa-close"></span> Annuleren
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
