<v-card class="elevation-1">
    <v-card-media class="sortable-handle" src="{{ assets('frontier/images/placeholder/windmill.jpg') }}">
        <div class="insert-overlay" style="background: rgba(3, 60, 105, 0.53); position: absolute; width: 100%; height: 100%;"></div>
        <v-layout column class="media">
            <v-card-title class="pa-0">
                <v-spacer></v-spacer>
                <v-menu bottom left>
                    <v-btn icon class="white--text" slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                    <v-list>
                        <v-list-tile @click="" ripple>
                            <v-list-tile-action>
                                <v-icon error class="red--text">remove_circle</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    {{ __('Remove') }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-menu>
            </v-card-title>
            <v-spacer></v-spacer>
            <v-card-text class="white--text text-xs-center">
                <div class="title pb-3">Activities</div>
            </v-card-text>
        </v-layout>
    </v-card-media>
    <v-card-text class="text-xs-center">
        <div class="body-2 accent--text"><v-icon class="green--text text--darken-1" style="font-size: 14px;">lens</v-icon> 13 Online</div>
    </v-card-text>
    <v-divider></v-divider>
    <v-list three-line class="pa-0">
        <v-list-tile avatar ripple  @click="">
            <v-list-tile-avatar small>
                <img src="https://placeimg.com/640/480/any/grayscale/1"/>
              </v-list-tile-avatar>
            <v-list-tile-content>
                <v-list-tile-title>No Classes on 01 September 2017 - Eid Al-Adha</v-list-tile-title>
                <v-list-tile-sub-title>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur laboriosam et ad non maiores autem reprehenderit soluta, voluptatum, natus praesentium adipisci neque culpa nostrum unde exercitationem aperiam fuga eos.</v-list-tile-sub-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-divider></v-divider>
        <v-list-tile avatar ripple  @click="">
            <v-list-tile-avatar>
                <img src="https://placeimg.com/640/480/any/grayscale/1"/>
            </v-list-tile-avatar>
            <v-list-tile-content>
                <v-list-tile-title>No Classes on 26 June 2017 - Hari Raya</v-list-tile-title>
                <v-list-tile-sub-title>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel eveniet deleniti, sed alias modi in aliquam quam sequi ut neque laudantium, laborum earum, debitis accusantium. Tenetur voluptates officia beatae voluptas.</v-list-tile-sub-title>
            </v-list-tile-content>
        </v-list-tile>
    </v-list>
</v-card>

@push('css')
    <style>
        .overlay-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        .media .card__text {
            z-index: 1;
        }
        .weight-600 {
            font-weight: 600 !important;
        }
        .list--three-line .list__tile__sub-title {
            -webkit-box-orient: vertical;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    items: []
                }
            }
        })
    </script>
@endpush
