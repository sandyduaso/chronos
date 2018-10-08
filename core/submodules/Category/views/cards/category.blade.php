{{-- <v-card class="mb-3 elevation-0"> --}}
    <v-toolbar dense card class="transparent">
        <v-icon left>label</v-icon>
        <v-toolbar-title class="subheading body-2 accent--text">{{ __('Category') }}</v-toolbar-title>
    </v-toolbar>
    <v-card-text>
        <template v-if="resource.categories.length">
            <v-select
            	:items="resource.categories"
            	hint="{{ __('Select Category') }}"
            	label="{{ __('Category') }}"
            	persistent-hint
            	item-text="name"
            	item-value="id"
            	auto clearable
            	v-model="resource.item.category_id"
            >
                <template slot="selection" scope="data">
                    <v-chip
                        close
                        @input="data.parent.selectItem(data.item)"
                        :selected="data.selected"
                        class="chip--select-multi"
                        :key="JSON.stringify(data.item)"
                    >
                        <v-avatar v-if="data.item.icon">
                            <v-icon class="primary primary--text" v-html="data.item.icon"></v-icon>
                        </v-avatar>
                        <span v-html="data.item.name"></span>
                    </v-chip>
                </template>
                <template slot="item" scope="data">
                    <template v-if="typeof data.item !== 'object'">
                        <v-list-tile-content v-text="data.item"></v-list-tile-content>
                    </template>
                    <template v-else>
                        <v-list-tile-avatar v-if="data.item.icon">
                            <v-icon v-html="data.item.icon"></v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title v-html="data.item.name"></v-list-tile-title>
                            <v-list-tile-sub-title v-html="data.item.description"></v-list-tile-sub-title>
                        </v-list-tile-content>
                    </template>
                </template>
            </v-select>
        </template>
        <template v-else>
            <p class="text-xs-center body-1 grey--text">
                {{ __('No categories defined.') }}
            </p>
        </template>
        <input type="hidden" name="category_id" :value="resource.item.category_id">
    </v-card-text>
{{-- </v-card> --}}

@push('pre-scripts')
	<script>
		mixins.push({
			data () {
				return {
					resource: {
						item: {
							category_id: '{{ @(old('category_id') ?? $resource->category->id) }}',
						},
						categories: {!! json_encode((array) $categories) !!},
					}
				};
			},
		});
	</script>
@endpush
