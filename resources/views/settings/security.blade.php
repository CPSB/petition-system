<div class="panel panel-default">
    <div class="panel-heading"><span class="fa fa-key" aria-hidden="true"></span> Account beveiliging</div>

    <div class="panel-body">
        <form action="" class="form-horizontal">
            {{csrf_field() }}

            <div class="form-group">
                <label class="control-label col-md-3">
                    Wachtwoord: <span class="text-danger">*</span>
                </label>

                <div class="col-md-9">
                    <input type="password" name="password" class="form-control" placeholder="Wachtwoord">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">
                    Wachtwoord bevestiging: <span class="text-danger">*</span>
                </label>

                <div class="col-md-9">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Wachtwoord bevestiging">
                    <small class="help-block">* Moet identiek zijn als de bovenstaande waarde.</small>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button class="btn btn-success" type="submit">
                        <span class="fa fa-check" aria-hidden="true"></span> Aanpassen
                    </button>

                    <button class="btn btn-danger" type="reset">
                        <span class="fa fa-undo" aria-hidden="true"></span> Reset
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
