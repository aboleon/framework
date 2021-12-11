<div class="col-lg-12 mb-3">
    <x-aboleon.framework-bootstrap-input name="first_name" :label="__('aboleon.framework::accounts.first_name')" :value="$account->first_name ?? old('last_name')"/>
</div>
<div class="col-lg-12 mb-3">
    <x-aboleon.framework-bootstrap-input name="last_name" :label="__('aboleon.framework::accounts.last_name')" :value="$account->last_name ?? old('last_name')"/>
</div>
<div class="col-lg-12 mb-3">
    <x-aboleon.framework-bootstrap-input name="email" type="email" :label="__('crm.email_address')" :value="$account->email ?? old('email')"/>
</div>
