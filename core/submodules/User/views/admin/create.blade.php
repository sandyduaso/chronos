@extends('Theme::layouts.admin')

@section('head:title', __('Add User'))
@section('main:title', '')

@section('page:content')
  <div class="container-fluid">
    <form action="{{ route('users.store') }}" method="POST">
      {{ csrf_field() }}
      <div data-sticky="#page-header"></div>
      <nav id="page-header" data-sticky-class="sticky bg-workspace shadow-sm" class="navbar row px-3">
        <h1 class="page-title">{{ __('Add User') }}</h1>
        <button type="submit" class="btn btn-primary btn-lg"><i class="fe fe-save"></i> {{ __('Save') }}</button>
      </nav>

      <div class="row">
        @section('user.main')
          <div class="col-lg col-sm-12">
            <div class="mb-7">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <h6 class="form-label text-uppercase text-muted mb-4">{{ __('Account') }}</h1>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="firstname">{{ __('First name') }}</label>
                        <div class="input-icon">
                          @if (! $errors->has('firstname'))
                            <span class="input-icon-addon">
                              <i class="fe fe-user"></i>
                            </span>
                          @endif
                          <input id="firstname" type="text" name="firstname" class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}" aria-describedby="firstname" value="{{ old('firstname') }}">
                          @if ($errors->has('firstname'))
                            <div class="invalid-feedback">{{ __($errors->first('firstname')) }}</div>
                          @endif
                        </div>
                      </div>
                    </div>

                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="middlename">{{ __('Middle name') }}</label>
                        <input id="middlename" type="text" name="middlename" class="form-control {{ $errors->has('middlename') ? 'is-invalid' : '' }}" aria-describedby="middlename" value="{{ old('middlename') }}">
                        @if ($errors->has('middlename'))
                          <div class="invalid-feedback">{{ __($errors->first('middlename')) }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="lastname">{{ __('Last name') }}</label>
                        <input id="lastname" type="text" name="lastname" class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" aria-describedby="lastname" value="{{ old('lastname') }}">
                        @if ($errors->has('lastname'))
                          <div class="invalid-feedback">{{ __($errors->first('lastname')) }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="roles[]">{{ __('Roles') }}</label>
                        <select id="roles" data-selectpicker type="text" name="roles[]" class="form-control {{ $errors->has('roles') ? 'is-invalid' : '' }}" aria-describedby="role[]">
                          @foreach ($resources->roles() as $role)
                            <option {{ (in_array($role->id, old('roles') ?? []) ? 'selected="selected"' : '') }} value="{{ $role->id }}">{{ $role->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('roles'))
                          <div class="invalid-feedback">{{ __($errors->first('roles')) }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="email">{{ __('Email') }}</label>
                        <div class="input-icon">
                          @if (! $errors->has('email'))
                            <span class="input-icon-addon">
                              <i class="fe fe-mail"></i>
                            </span>
                          @endif
                          <input id="email" type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" aria-describedby="email" value="{{ old('email') }}">
                          @if ($errors->has('email'))
                            <div class="invalid-feedback">{{ __($errors->first('email')) }}</div>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="username">{{ __('Username') }}</label>
                        <input id="username" type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" aria-describedby="username" value="{{ old('username') }}" autocomplete="off">
                        @if ($errors->has('username'))
                          <div class="invalid-feedback">{{ __($errors->first('username')) }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" aria-describedby="password" value="{{ old('password') }}">
                        @if ($errors->has('password'))
                          <div class="invalid-feedback">{{ __($errors->first('password')) }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="password_confirmation">{{ __('Password Confirmation') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control  {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" aria-describedby="password_confirmation" value="{{ old('password_confirmation') }}">
                        @if ($errors->has('password_confirmation'))
                          <div class="invalid-feedback">{{ __($errors->first('password_confirmation')) }}</div>
                        @else
                          <div class="feedback text-muted small">{{ __('Retype password') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                </div>

                <div class="card-body py-0 border-0">
                  <div class="row">
                    <div class="col-lg-12">
                      <h6 class="form-label text-uppercase text-muted mb-4">{{ __('Additional Background Details') }}</h6>
                    </div>
                  </div>
                </div>

                <table class="table table-no-border" data-dynamic-container>
                  <tbody>
                    <tr>
                      <td class="pl-5">
                        <div class="form-group mb-0">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fe fe-smartphone"></i>
                            </span>
                            <input type="text" readonly name="details[phone][key]" class="form-control" value="Mobile Phone" placeholder="{{ __('Key') }}">
                            <input type="hidden" name="details[phone][icon]" value="fe fe-smartphone">
                          </div>
                        </div>
                      </td>
                      <td colspan="3" class="pr-5">
                        <div class="form-group mb-0">
                          <input type="text" name="details[phone][value]" class="form-control" value="{{ old('details.phone.value') }}" placeholder="+## ### #######" autocomplete="off" maxlength="19">
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td class="pl-5">
                        <div class="form-group mb-0">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-birthday-cake"></i>
                            </span>
                            <input type="text" readonly name="details[birthday][key]" class="form-control" value="Birthday" placeholder="{{ __('Key') }}">
                            <input type="hidden" name="details[birthday][icon]" value="fa fa-birthday-cake">
                          </div>
                        </div>
                      </td>
                      <td colspan="3" class="pr-5">
                        <div class="form-group mb-0">
                          <input type="text" name="details[birthday][value]" class="form-control" data-mask="99/99/9999" data-mask-clearifnotmatch="true" placeholder="MM/DD/YYYY" autocomplete="off" maxlength="10" value="{{ old('details.birthday.value') }}">
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td class="pl-5">
                        <div class="form-group mb-0">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fe fe-map-pin"></i>
                            </span>
                            <input type="text" readonly name="details[address][key]" class="form-control" value="Billing Address" placeholder="{{ __('Key') }}">
                            <input type="hidden" name="details[address][icon]" value="fe fe-map-pin">
                          </div>
                        </div>
                      </td>
                      <td colspan="3" class="pr-5">
                        <div class="form-group mb-0">
                          <textarea name="details[address][value]" cols="30" rows="1" class="form-control">{{ old('details.address.value') }}</textarea>
                        </div>
                      </td>
                    </tr>

                    {{-- Old value --}}
                    {{-- {{ dd(old('details')) }} --}}
                    @if (old('details'))
                      @foreach (collect(old('details'))->except(['address', 'phone', 'birthday']) as $i => $detail)
                        <tr data-dynamic-item data-dynamic-item-number="{{ $i }}">
                          <td class="pl-5">
                            @include('Theme::fields.selecticons', [
                              'name' => 'details['.$i.'][icon]',
                              'value' => $detail['icon'] ?? '',
                              'attr' => 'data-selectpicker data-live-search="true"',
                            ])
                          </td>
                          <td>
                            <div class="form-group mb-0">
                              <input type="text" name="details[{{ $i }}][key]" class="form-control" value="{{ $detail['key'] ?? '' }}" placeholder="{{ __('Key') }}">
                            </div>
                          </td>
                          <td>
                            <div class="form-group mb-0">
                              <input type="text" name="details[{{ $i }}][value]" class="form-control" value="{{ $detail['value'] ?? '' }}" autocomplete="off" placeholder="{{ __('Value') }}">
                            </div>
                          </td>
                          <td class="pr-5 justify-content-end d-flex">
                            <div class="w-100"></div>
                            <button class="btn btn-secondary" type="button" data-dynamic-remove-button><i class="fe fe-x"></i></button>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                    {{-- Old value --}}

                    {{-- Dynamic Template --}}
                    <tr data-dynamic-item-template>
                      <td class="pl-5">
                        @include('Theme::fields.selecticons', [
                          'name' => 'details[#][icon]',
                          'attr' => 'disabled data-live-search="true"',
                        ])
                      </td>
                      <td>
                        <div class="form-group mb-0">
                          <input disabled type="text" data-name="details[#][key]" class="form-control" value="" placeholder="{{ __('Key') }}">
                        </div>
                      </td>
                      <td>
                        <div class="form-group mb-0">
                          <input disabled type="text" data-name="details[#][value]" class="form-control" value="" autocomplete="off" placeholder="{{ __('Value') }}">
                        </div>
                      </td>
                      <td class="pr-5 justify-content-end d-flex">
                        <div class="w-100"></div>
                        <button class="btn btn-secondary" type="button" data-dynamic-remove-button><i class="fe fe-x"></i></button>
                      </td>
                    </tr>
                    {{-- Dynamic Template --}}

                    <tr data-dynamic-after-items>
                      <td colspan="4" class="pl-5 pr-5">
                        <button data-dynamic-add-button type="button" class="btn btn-secondary btn-sm">{{ __('Add Field') }}</button>
                      </td>
                    </tr>

                  </tbody>
                </table>

              </div>
            </div>
          </div>

        @show

        @section('user.sidebar')
          <div class="col-lg-3 col-sm-12">
            <div class="row">
              <div class="col-sm-12 order-lg-2 order-1">
                @section('user.avatar')
                  <div class="card">
                    <div class="card-body">
                      <div class="form-group mb-3">
                        @include('Theme::fields.selectavatars', [
                          'title' => __('Select Avatar'),
                          'name' => 'avatar',
                          'attr' => 'data-selectpicker',
                        ])
                      </div>
                      {{-- <img role="button" data-avatar-img class="avatar-fit rounded-circle mb-4" width="150px" height="150px" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                      <div class="form-group">
                        <input id="avatar" type="file" name="avatar" value="{{ old('avatar') }}" class="form-control">
                        <label for="avatar" class="form-label">{{ __('Avatar') }}</label>
                      </div> --}}
                      {{-- <button data-dropzone-button type="button" class="btn btn-secondary btn-block"><i class="fe fe-upload"></i> {{ __('Upload') }}</button> --}}
                    </div>
                  </div>
                @show
              </div>
            </div>


            @section('user.sidemenu')
            @show
          </div>
        @show
      </div>
    </form>
  </div>
@endsection
