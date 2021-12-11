<div class="col-12">
    <h4>Mot de passe</h4>
    @if (is_object($account) && $account->id)
        <div class="form-check ">
            <input type="checkbox" class="form-check-input" name="password_change" id="password_change"/>
            <label class="form-label" for="password_change">Changer le mot de passe</label>
        </div>
    @endif
    <div class="form-check ">
        <input type="checkbox" class="form-check-input" id="random_password" name="random_password">
        <label class="form-label" for="random_password">Générer un mot de passe aléatoire</label>
    </div>
</div>
<div class="col-12">
    <div class="form-group" style="clear: both;">
        <label class="form-label" for="password">Nouveau mot de passe</label>
        <input id="password" type="password" name="password" class="form-control" value="" {{ $account?->id ? 'disabled' : '' }} />
        <span>Au minimum 8 caractères</span>
    </div>
</div>
<div class="col-12">
    <div class="form-group">
        <label class="form-label" for="password_confirmation">Répeter le mot de passe</label>
        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"  {{ $account?->id ? 'disabled' : '' }}/>
    </div>
</div>

@push('js')
    <script>
      $(function () {
        $('#password_change').click(function () {
          if ($(this).is(':checked') && !$('#random_password').is(':checked')) {
            $(':password').removeAttr('disabled');
          } else {
            $(':password').prop('disabled', true);
          }
        });
        $('#random_password').click(function() {
          if ($(this).is(':checked')) {
            $(':password').prop('disabled', true);
            $('#password_change').prop('checked', true);

          } else {
            $(':password').removeAttr('disabled');
          }
        });
      });
    </script>
@endpush
