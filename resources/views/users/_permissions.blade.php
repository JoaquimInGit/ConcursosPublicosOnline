
<div class="accordion  accordion-toggle-arrow" id="accordionPermissionHeading">
    <div class="card">
        <div class="card-header" id="permissionHeading">
            <div class="card-title {{ $closed ? 'collapsed' : ''}}" data-toggle="collapse" data-target="#dd-permissionHeading" aria-expanded="{{ isset($closed) ? 'true' : 'false' }}" aria-controls="dd-permissionHeading">
                <i class="flaticon-lock"></i> {{ __('Override Permissions') }}&nbsp;&nbsp;  {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
            </div>
        </div>
        <div id="dd-permissionHeading" class="collapse {{ $closed ? '' : 'show' }}" aria-labelledby="dd-permissionHeading" data-parent="#accordionPermissionHeading" style="">
            <div class="card-body">
                <div class="row">
                    @foreach($permissions as $perm)
                        <?php
                        $per_found = null;
                        if( isset($role) ) {
                            $per_found = $role->hasPermissionTo($perm->name);
                        }
                        if( isset($user)) {
                            $per_found = $user->hasDirectPermission($perm->name);
                        }
                        ?>

                        <div class="col-md-3">
                            <div class="checkbox">
                                <label class="{{ Str::contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                    {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
