<div v-show="loading ? loading : false">
    <v-progress-circular data-progress-circular indeterminate class="primary--text"></v-progress-circular>
</div>

@push('post-css')
    <style scoped>
        [data-progress-circular] {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 9999999;
        }
    </style>
@endpush
