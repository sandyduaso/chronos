<v-layout row wrap class="media" justify-center align-center>
    <v-flex sm4 xs12 class="text-xs-center">
        <v-layout row wrap>
            <v-flex xs6>
                <v-layout row wrap class="media">
                    <v-card-text class="white--text">
                        <div class="headline"><v-icon dark class="green--text">arrow_drop_up</v-icon>103</div>
                        <div class="caption"> New Students</div>
                    </v-card-text>
                </v-layout>
            </v-flex>
            <v-flex xs6>
                <v-layout row wrap class="media">
                    <v-card-text class="white--text">
                        <div class="headline"><v-icon dark class="green--text">arrow_drop_up</v-icon>124</div>
                        <div class="caption"> New Courses</div>
                    </v-card-text>
                </v-layout>
            </v-flex>
        </v-layout>

        <v-layout row wrap>
            <v-flex xs6>
                <v-layout row wrap class="media">
                    <v-card-text class="white--text">
                        <div class="headline"><v-icon dark class="green--text">arrow_drop_up</v-icon> 567</div>
                        <div class="caption"> Total Students</div>
                    </v-card-text>
                </v-layout>
            </v-flex>
            <v-flex xs6>
                <v-layout row wrap class="media">
                    <v-card-text class="white--text">
                        <div class="headline"><v-icon dark class="green--text">arrow_drop_up</v-icon> 566</div>
                        <div class="caption"> Total Courses</div>
                    </v-card-text>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-flex>

    <v-flex sm4 xs12>
        <v-layout row wrap class="media">
            <v-card-text class="body-2 cyan--text text--lighten-3 pa-3 text-xs-center">Individual Progress vs Overall Progress</v-card-text>
            <v-card-text>
                <div class="white--text body-1">Course X</div>
                <v-progress-linear value="35" color-front="cyan" color-back="accent lighten-4" background-opacity="3" height="10"></v-progress-linear>

                <div class="white--text body-1">Course Y</div>
                <v-progress-linear value="35" color-front="cyan" color-back="accent lighten-4" height="10"></v-progress-linear>

            </v-card-text>
        </v-layout>
    </v-flex>

    <v-flex sm4 xs12 class="text-xs-center">
        <v-layout row wrap class="media">
            <v-card-text class="body-2 cyan--text text--lighten-3">Comparison of Classes</v-card-text>
        </v-layout>
        <v-layout row wrap>
                <v-flex sm6 xs12>
                    <v-progress-circular
                        v-bind:size="100"
                        v-bind:width="10"
                        v-bind:value="value"
                        class="cyan--text text--lighten-1"
                        >
                        @{{ value }}
                    </v-progress-circular>
                    <v-layout row wrap class="media">
                        <v-card-text class="pa-0">
                            <div class="caption white--text">50%</div>
                        </v-card-text>
                    </v-layout>
                </v-flex>
                <v-flex sm6 xs12>
                    <v-progress-circular
                        v-bind:size="100"
                        v-bind:width="10"
                        v-bind:value="value"
                        class="cyan--text text--lighten-1"
                        >
                        @{{ value }}
                    </v-progress-circular>
                    <v-layout row wrap class="media">
                        <v-card-text class="pa-0">
                            <div class="caption white--text">50%</div>
                        </v-card-text>
                    </v-layout>
                </v-flex>
        </v-layout>
    </v-flex>
</v-layout>
