<v-dialog v-model="search" fullscreen transition="dialog-bottom-transition" :overlay=false>
    <v-btn slot="activator" icon v-tooltip:left="{ html: 'Search' }" class="grey--text text--darken-3">
        <v-icon>search</v-icon>
    </v-btn>
    <v-card>
        <v-toolbar class="light-blue">
            <v-btn v-tooltip:right="{html: 'Cancel'}" icon @click="search = false" dark>
                <v-icon>close</v-icon>
            </v-btn>
            {{-- <v-spacer></v-spacer> --}}

            <v-select
                label="Search"
                chips
                tags
                solo
                prepend-icon="search"
                append-icon=""
                clearable
                autofocus
                >
            </v-select>
        </v-toolbar>
    </v-card>
</v-dialog>

{{-- <v-menu transition="slide-y-transition">
    <v-btn slot="activator" icon v-tooltip:left="{ html: 'Search' }" class="grey--text text--darken-3">
        <v-icon>search</v-icon>
    </v-btn>
    <v-list>
        <v-list-tile @click="">
            <v-list-tile-title>test 1</v-list-tile-title>
        </v-list-tile>
    </v-list>
</v-menu>
 --}}

{{-- <nav class="toolbar elevation-0 toolbar--fixed theme--dark light-blue" style="margin-top: 0px; padding-left: 0px; padding-right: 0px;">
    <div class="toolbar__content" style="height: 64px;">
        <button type="button" class="btn btn--icon btn--large btn--raised theme--dark" style="">
            <div class="btn__content"><i class="material-icons icon">arrow_back</i></div>
        </button>
        <div class="input-group input-group--prepend-icon input-group--placeholder input-group--text-field input-group--single-line input-group--solo primary--text">
            <div class="input-group__input"><i aria-hidden="true" class="material-icons icon input-group__prepend-icon">search</i><span class="algolia-autocomplete" style="position: relative; display: inline-block; direction: ltr;"><input id="search" tabindex="0" value="" placeholder="Search" type="text" class="ds-input" autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-labelledby="search" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style="position: relative; vertical-align: top;"><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: Roboto, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; word-spacing: 0px; letter-spacing: normal; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre><span class="ds-dropdown-menu" role="listbox" id="algolia-autocomplete-listbox-0" style="position: absolute; top: 100%; z-index: 100; display: none; left: 0px; right: auto;"><div class="ds-dataset-1"></div></span></span><i aria-hidden="true" class="material-icons icon input-group__append-icon"></i></div>
            <div class="input-group__details">
                <div class="input-group__messages"></div>
            </div>
        </div>
    </div>
</nav> --}}

@push('css')
    <style>
        .algolia-autocomplete {
            width: 100% !important;
        }
        .input-group--select .input-group__input, .input-group--select input {
            cursor: unset !important;
        }
    </style>
@endpush

