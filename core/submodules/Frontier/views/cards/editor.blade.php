<v-card class="mb-3 elevation-1 mode" :class="editor.toolbar.modes.distraction.model?'mode-distraction-free':''">
    <v-toolbar card dense class="yellow lighten-3">
        <v-icon>fa-sticky-note</v-icon>
        <v-toolbar-title class="subheading grey--text text--darken-2">{{ __('Content') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <template>
            <v-btn
                icon
                v-model="editor.source.model"
                v-tooltip:left="{'html': '{{ __('Toggle Source Code View') }}'}"
                @click.native="editor.source.model = !editor.source.model"
            >
                <v-icon>code</v-icon>
            </v-btn>
        </template>

        <template>
            <v-btn
                icon
                v-model="editor.preview.model"
                v-tooltip:left="{'html': '{{ __('Toggle Preview') }}'}"
                @click.native="editor.preview.model = !editor.preview.model"
            >
                <v-icon>fa-eye</v-icon>
            </v-btn>
        </template>

        <template>
            <v-btn
                icon
                v-model="editor.toolbar.modes.distraction.model"
                v-tooltip:left="{'html': '{{ __('Toggle Distraction-Free Mode') }}'}"
                @click.native="editor.toolbar.modes.distraction.model = !editor.toolbar.modes.distraction.model"
            >
                <v-icon>@{{ editor.toolbar.modes.distraction.model ? 'fullscreen_exit' : 'fullscreen' }}</v-icon>
            </v-btn>
        </template>
    </v-toolbar>
    <v-card-actions id="quill-toolbar" class="quill-toolbar yellow lighten-5">
        <v-spacer></v-spacer>
        <v-layout row wrap>
            <v-flex>
                <v-spacer></v-spacer>
                <div class="pa-2">
                    <span class="ql-formats">
                        <select class="ql-header">
                            <option value="1">{{ __('Heading 1') }}</option>
                            <option value="2">{{ __('Heading 2') }}</option>
                            <option value="3">{{ __('Heading 3') }}</option>
                            <option value="4">{{ __('Heading 4') }}</option>
                            <option value="5">{{ __('Heading 5') }}</option>
                            <option value="6">{{ __('Heading 6') }}</option>
                            <option selected>{{ __('Normal') }}</option>
                        </select>
                    </span>
                    <span class="ql-formats">
                        <select class="ql-size">
                            <option value="10px">{{ __('Small') }}</option>
                            <option selected>{{ __('Normal') }}</option>
                            <option value="18px">{{ __('Large') }}</option>
                            <option value="32px">{{ __('Huge') }}</option>
                        </select>
                    </span>
                    <span class="ql-formats">
                        <select class="ql-font">
                            <option selected>Roboto</option>
                            <option class="ql-font-montserrat" value="Montserrat">Montserrat</option>
                        </select>
                    </span>
                    <span class="ql-formats">
                        <!-- Add a bold button -->
                        <button title="bold" class="mb-0 ql-bold"></button>
                        <button title="italic" class="mb-0 ql-italic"></button>
                        <button title="underline" class="mb-0 ql-underline"></button>
                        <button title="blockquote" class="mb-0 ql-blockquote"></button>
                    </span>
                    <span class="ql-formats">
                        <button title="left" class="mb-0 ql-align" value=""></button>
                        <button title="center" class="mb-0 ql-align text-xs-center" value="center"></button>
                        <button title="right" class="mb-0 ql-align" value="right"></button>
                        <button title="justify" class="mb-0 ql-align" value="justify"></button>
                    </span>
                    <span class="ql-formats">
                        <button title="ordered" class="mb-0 ql-list" value="ordered"></button>
                        <button title="bulletted" class="mb-0 ql-list" value="bullet"></button>
                    </span>
                    <span class="ql-formats">
                        <button title="subscript" class="mb-0 ql-script" value="sub"></button>
                        <button title="superscript" class="mb-0 ql-script" value="super"></button>
                        <button title="code block" class="mb-0 ql-code-block"></button>
                    </span>
                </div>
                <v-spacer></v-spacer>
            </v-flex>
        </v-layout>
    </v-card-actions>

    <v-layout fill-height row wrap>
        <v-flex xs6 wrap>
            <v-card flat height="100%">
                <div id="quill-editor" class="quill-editor ql-editor--yellow"></div>
            </v-card>
        </v-flex>
        <v-flex xs6 wrap v-show="editor.source.model" fill-height>
            <v-card flat height="100%">
                <textarea id="codemirror-editor" class="codemirror-editor" v-model="editor.content.model"></textarea>
            </v-card>
        </v-flex>
        <v-flex xs12 wrap v-show="editor.preview.model">
            <v-card flat class="grey lighten-5" height="100%">
                <v-card-text>
                    <v-card class="elevation-1" wrap>
                        <v-card-text>
                            <div id="preview-editor" class="preview-editor" v-html="editor.content.model"></div>
                        </v-card-text>
                    </v-card>
                </v-card-text>
            </v-card>
            <input type="hidden" :name="editor.content.inputname.body" :value="editor.content.model">
            <input type="hidden" :name="editor.content.inputname.delta" :value="editor.content.delta">
        </v-flex>
    </v-layout>

    <v-card-actions class="yellow lighten-5 grey--text">
        <v-spacer></v-spacer>
        <small>@{{ editor.content.count }},</small>
        <small>@{{ editor.content.selection }} {{ __('selected') }}</small>
    </v-card-actions>

</v-card>

@push('pre-css')
    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.1/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.1/quill.bubble.css" rel="stylesheet">
    <link href="{{ assets('frontier/vendors/codemirror/lib/codemirror.css') }}" rel="stylesheet">
    <link href="{{ assets('frontier/vendors/codemirror/theme/monokai.css') }}" rel="stylesheet">
@endpush

@push('pre-scripts')
    {{-- compile this --}}
    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.1/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.1/quill.min.js"></script>
    <script src="{{ assets('frontier/vendors/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ assets('frontier/vendors/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ assets('frontier/vendors/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ assets('frontier/vendors/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ assets('frontier/vendors/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
    <script src="{{ assets('frontier/vendors/codemirror/addon/hint/html-hint.js') }}"></script>

    <script>
        mixins.push({
            data () {
                return {
                    editor: {
                        source: {
                            editor: null,
                            model: true,
                        },
                        preview: {
                            editor: null,
                            model: false,
                        },
                        content: {
                            inputname: {
                                body: '{{ isset($name) ? $name['body'] : 'body' }}',
                                delta: '{{ isset($name) ? $name['delta'] : 'delta' }}',
                            },
                            editor: null,
                            options: {
                                lineNumbers: true,
                                lineWrapping: true,
                                matchBrackets: true,
                                styleActiveLine: true,
                                mode: "htmlmixed",
                                theme: "monokai",
                            },
                            model: '',
                            delta: null,
                            count: 0,
                            selection: 0,
                        },
                        toolbar: {
                            model: true,
                            modes: {
                                distraction: {
                                    model: false,
                                },
                            },
                        },
                    },
                };
            },

            watch: {
                'editor.content.model': function (val) {
                    // this.editor.source.editor.setValue(val);

                    // Counter
                    let str = [];
                    str.push(charLength = (this.editor.content.editor.getText().length - 1));
                    str.push(charLength <= 1 ? '{{ __('character') }}' : '{{ __('characters') }}');
                    str.push(wordLength = this.editor.content.editor.getText().split(' ').length);
                    str.push(wordLength <= 1 ? '{{ __('word') }}' : '{{ __('words') }}');
                    this.editor.content.count = str.join(' ');
                },
            },

            methods: {
                codemirror () {
                    let self = this;
                    let target = document.querySelector('#codemirror-editor');

                    this.editor.source.editor = CodeMirror.fromTextArea(target, self.editor.content.options);

                    this.editor.source.editor.on('keyup', function (instance) {
                        self.editor.content.editor.clipboard.dangerouslyPasteHTML(instance.getValue());
                    });

                    self.editor.source.editor.setValue(self.editor.content.model);

                    this.editor.source.model = false;
                },

                quill () {
                    let self = this,
                        Font = Quill.import('formats/font'),
                        SizeStyle = Quill.import('attributors/style/size');

                    Font.whitelist = {!! json_encode(config('editor.fonts.enabled', [])) !!};
                    Quill.register(Font, true);
                    Quill.register(SizeStyle, true);
                    // Quill.register(ImageImport, true);
                    // Quill.register(ImageResize, true);

                    Quill.prototype.getHtml = function() {
                        let content = this.container.querySelector('.ql-editor').innerHTML;

                        if (content.charAt(0) === '"' && content.charAt(content.length -1) === '"') {
                            content = content.substr(1, content.length -2);
                        }

                        return content;
                    };

                    self.editor.content.editor = new Quill('.quill-editor', {
                        modules: {
                            toolbar: '.quill-toolbar',
                        },
                        theme: 'snow',
                        placeholder: '{{ __('Write something...') }}',
                        imageImport: true,
                        imageResize: {
                            displaySize: true
                        },
                    });

                    self.editor.content.editor.on('text-change', function(delta, oldDelta, source) {
                        let htmlContent = self.editor.content.editor.getHtml();
                        htmlContent = htmlContent.replace(/\>\</g, ">\n<");
                        self.editor.content.model = htmlContent;
                        self.editor.content.delta = JSON.stringify(self.editor.content.editor.getContents());
                    });

                    let events = ['keyup', 'click'];
                    let elements = ['#quill-editor .ql-editor', '.quill-editor .ql-editor', '#quill-toolbar'];
                    for (let i in events) {
                        for (let j in elements) {
                            document.querySelector(elements[j]).addEventListener(events[i], function (el) {
                                self.editor.source.editor.setValue(self.editor.content.model);
                            });
                        }
                    }

                    self.editor.content.editor.on('selection-change', function(range, oldRange, source) {
                        self.editor.content.selection = range ? range.length : 0;
                    });

                    return self.editor.content.editor;
                },
            },

            mounted () {
                this.codemirror();
                this.quill();
            }
        })
    </script>
@endpush
