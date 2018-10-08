<div class="row justify-content-center">
  <div class="col-lg-10">
    <div class="form-group">
      <label class="form-label text-left">{{ __('File Name') }}</label>
      <input type="text" name="filename" class="form-control" aria-describedby="filenameHelp" placeholder="{{ __('File name') }}" value="{{ old('filename') ?? 'export-'.date('Y-m-d') }}">
    </div>
    <div class="form-group">
      <label class="form-label text-left">{{ __('File type') }}</label>
      <select name="format" class="w-100" data-selectpicker>
        <optgroup label="{{ __('Can be imported later') }}">
          <option data-icon="text-green fa fa-file-excel" value="csv">{{ __('CSV (.csv)') }}</option>
          <option data-icon="text-green fa fa-file-excel" value="xlsx">{{ __('Microsoft Excel (.xlsx)') }}</option>
          <option data-icon="text-green fa fa-file-excel" value="ods">{{ __('OpenDocument Spreadsheet (.ods)') }}</option>
        </optgroup>
        <optgroup label="{{ __('Presentable') }}">
          <option data-icon="text-red fa fa-file-pdf" value="pdf">{{ __('Portable Document Format (.pdf)') }}</option>
        </optgroup>
      </select>
    </div>
  </div>
</div>
