@viewable(widgets('quickdraft'))
	<form action="{{ url('pages.store') }}" method="POST">
		{{-----------^^^ should be route('pages.store') --}}
		{{ csrf_field() }}
		<v-card class="elevation-1 mb-3">
			<v-toolbar card class="transparent">
				<v-icon>{{ widgets('quickdraft')->icon }}</v-icon>
				<v-toolbar-title class="subheading">{{ widgets('quickdraft')->name }}</v-toolbar-title>
			</v-toolbar>
			<v-card-text>
				<v-text-field
					name="title"
					label="{{ __("Title") }}"
					value="{{ old('title') }}"
				></v-text-field>
				<v-text-field
					name="title"
					label="{{ __("Draft") }}"
					value="{{ old('body') }}"
					textarea
				></v-text-field>
			</v-card-text>
			<v-card-actions>
				<v-spacer></v-spacer>
				<v-btn type="submit" primary>{{ __('Save') }}</v-btn>
			</v-card-actions>
		</v-card>
	</form>
@endviewable
