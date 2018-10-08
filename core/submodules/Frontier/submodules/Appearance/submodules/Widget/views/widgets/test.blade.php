@viewable(widgets('test'))
	<v-card class="elevation-1 mb-3">
		<v-toolbar card class="transparent">
			<v-toolbar-title primary-title class="subheading">{{ __('Test Widget') }}</v-toolbar-title>
		</v-toolbar>
		<v-card-text>
			<div class="grey--text">{{ __("This is the test widget. The only roles that can view this are: " . implode(", ", widgets('test')->roles()->pluck('code', 'name')->toArray())) }}</div>
		</v-card-text>
	</v-card>
@else
	<v-card class="elevation-1 mb-3">
		<v-card-text>
			<div class="grey--text text-xs-center">{{ __("Your role is not permitted to view this test widget.") }}</div>
		</v-card-text>
	</v-card>
@endviewable
