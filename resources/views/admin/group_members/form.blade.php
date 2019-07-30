{{csrf_field()}}
@php
    $genders = [
        config('users.gender.female') => trans('members.user.variable.gender.female'),
        config('users.gender.male') => trans('members.user.variable.gender.male'),
        config('users.gender.other_gender') => trans('members.user.variable.gender.other_gender'),
    ];
@endphp
<div class="form-group {{ $errors->has('email') ? 'has-error':'' }}">
    <label for="email">{{ trans('members.user.attribute.email.label') }}</label>
    <p class="error_message">{{ $errors->first('email') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-at"></i>
        </div>
        <input type="text"  id="email" name="email"
               placeholder="{{ trans('members.user.attribute.email.placeholder') }}"
               class="form-control">
    </div>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
    <label for="name">{{ trans('members.user.attribute.name.label') }}</label>
    <p class="error_message">{{ $errors->first('name') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-user"></i>
        </div>
        <input type="text" id="name" name="name"
               placeholder="{{ trans('members.user.attribute.name.placeholder') }}"
               class="form-control">
    </div>
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error':'' }}">
    <label for="password">{{ trans('members.user.attribute.password.label') }}</label>
    <p class="error_message">{{ $errors->first('password') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-key"></i>
        </div>
        <input type="password" id="password"
               name="password"
               placeholder="{{ trans('members.user.attribute.password.placeholder') }}"
               class="form-control">
    </div>
</div>

<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error':'' }}">
    <label for="password_confirmation">{{ trans('members.user.attribute.password_confirmation.label') }}</label>
    <p class="error_message">{{ $errors->first('password_confirmation') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-key"></i>
        </div>
        <input type="password"
               id="password_confirmation" name="password_confirmation"
               placeholder="{{ trans('members.user.attribute.password_confirmation.placeholder') }}"
               class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="gender">{{ trans('members.user.attribute.gender.label') }}</label>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-mars"></i>
        </div>
        <select name="gender" id="gender" class="form-control">
            @foreach($genders as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group {{ $errors->has('birthday') ? 'has-error':'' }}">
    <label for="birthday">{{ trans('members.user.attribute.birthday.label') }}</label>
    <p class="error_message">{{ $errors->first('birthday') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="date" class="form-control" id="birthday" name="birthday">
    </div>
</div>

<div class="form-group {{ $errors->has('phone') ? 'has-error':'' }}">
    <label for="phone">{{ trans('members.user.attribute.phone.label') }}</label>
    <p class="error_message">{{ $errors->first('phone') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-phone"></i>
        </div>
        <input type="text"
               id="phone" name="phone"
               placeholder="{{ trans('members.user.attribute.phone.placeholder') }}"
               class="form-control">
    </div>
</div>

<div class="form-group {{ $errors->has('phone') ? 'has-error':'' }}">
    <label for="address">{{ trans('members.user.attribute.address.label') }}</label>
    <p class="error_message">{{ $errors->first('address') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-map-marker"></i>
        </div>
        <input type="text"
               id="address" name="address"
               placeholder="{{ trans('members.user.attribute.address.placeholder') }}"
               class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="avatar">{{ trans('members.user.attribute.avatar.label') }}</label>
    <div class="image-upload">
        <div class="image-edit">
            <input type="file"
                   id="avatar"
                   name="avatar"
                   accept="image/x-png,image/jpeg"
                   class="avatar-picture">
            <label for="avatar" class="avatar-picture-icon-edit"></label>
        </div>
        <div class="avatar-preview">
            <div id="avatar-preview">
            </div>
        </div>
    </div>
</div>
