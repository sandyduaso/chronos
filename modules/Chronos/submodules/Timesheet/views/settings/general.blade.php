@extends('Theme::layouts.admin')

@section('head:title', __('Timesheet Settings'))
@section('page:title', __('Timesheet Settings'))

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <form action="{{ route('settings.store') }}" method="POST">
          @csrf

          <h4 class="h4">{{ __('CSV Heading Columns') }}</h4>
          <p class="small text-muted">{{ __('Heading columns are important when uploading csv file. The values below will dictate what fields will be imported.') }}</p>

          @field('input', [
            'label' => __('Card ID'),
            'name' => 'timesheet_card_id',
            'value' => settings('timesheet_card_id', 'card_id')
          ])

          @field('input', [
            'label' => __('Department'),
            'name' => 'timesheet_department',
            'value' => settings('timesheet_department', 'department')
          ])

          @field('input', [
            'label' => __('Time In'),
            'name' => 'timesheet_time_in',
            'value' => settings('timesheet_time_in', 'time_in')
          ])

          @field('input', [
            'label' => __('Time Out'),
            'name' => 'timesheet_time_out',
            'value' => settings('timesheet_time_out', 'time_out')
          ])

          @field('input', [
            'label' => __('First name'),
            'name' => 'timesheet_firstname',
            'value' => settings('timesheet_firstname', 'firstname')
          ])

          @field('input', [
            'label' => __('Last name'),
            'name' => 'timesheet_lastname',
            'value' => settings('timesheet_lastname', 'lastname')
          ])

          <h3 class="h4 mt-7">{{ __('Default Time Settings') }}</h3>

          @field('input', [
            'label' => __('Time in'),
            'name' => 'timesheet_default_time_in',
            'value' => settings('timesheet_default_time_in', '09:00 AM'),
          ])

          @field('input', [
            'label' => __('Time out'),
            'name' => 'timesheet_default_time_out',
            'value' => settings('timesheet_default_time_out', '06:15 PM'),
          ])

          @field('input', [
            'label' => __('Lunch start'),
            'name' => 'timesheet_default_lunch_start',
            'value' => settings('timesheet_default_lunch_start', '01:00 PM'),
          ])

          @field('input', [
            'label' => __('Lunch end'),
            'name' => 'timesheet_default_lunch_end',
            'value' => settings('timesheet_default_lunch_end', '02:00 PM'),
          ])


          {{-- @field('input', [
            'label' => __('First name'),
            'name' => 'timesheet_firstname',
            'value' => settings('timesheet_firstname', 'firstname')
          ]) --}}

          @field('hidden', ['name' => 'user_id', 'value' => user()->id])

          @submit('Save')
        </form>
      </div>
    </div>
  </div>
@endsection
