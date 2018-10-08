{{--
Template Name: Index Template
Type: Form
Description: The default home template displaying the title, body, and featured image of the page.
Author: John Lioneil Dionisio
Version: 1.0
--}}

{{-- <v-toolbar dark class="elevation-1 blue">
    <v-toolbar-title>{{ __('Post-evaluation Form') }}</v-toolbar-title>
</v-toolbar>

<v-container fluid grid-list-lg>
    <v-layout row wrap justify-center align-center>
        <v-flex md8 sm10 xs12>
            <form action="" method="POST">

                @foreach ($form->fields as $name => $field)
                <div class="input-group input-group--text-field">
                    <label for=""> {{ __('Label') }} </label>
                    <div class="input-group__input">
                        {!! $field->template($name)->render() !!}
                    </div>
                    <div class="input-group__details">
                        <div class="input-group__messages"></div>
                    </div>
                </div>
                @endforeach

            </form>
        </v-flex>
    </v-layout>
</v-container>
 --}}



{{-- {{ dd($form, $fields) }} --}}


{{-- start of evaluation modal --}}
<v-card-text class="text-xs-center">
    <v-dialog v-model="evaluation.dialog.model" lazy width="auto">
        <v-btn class="purple--text text--lighten-2" outline slot="activator">
            Start
        </v-btn>
        <v-card class="elevation-0" style="min-height: 700px; max-height: 700px; min-width: 700px; max-width: 700px;">
            <v-toolbar dark class="elevation-0 blue lighten-1">
                <v-toolbar-title>{{ __('Post-workshop Evaluation Form') }}</v-toolbar-title>
            </v-toolbar>
            <v-card-text class="pa-0">
                <v-flex xs12>
                    <v-stepper v-model="e1" class="elevation-0">
                        <v-stepper-header class="elevation-0 mb-4 grey lighten-3 sticky">
                            <v-stepper-step step="1" editable :complete="e1 > 1"></v-stepper-step>
                            <v-divider></v-divider>
                            <v-stepper-step step="2" editable :complete="e1 > 2"></v-stepper-step>
                            <v-divider></v-divider>
                            <v-stepper-step step="3" editable :complete="e1 > 3"></v-stepper-step>
                            <v-divider></v-divider>
                            <v-stepper-step step="4" editable :complete="e1 > 4"></v-stepper-step>
                            <v-divider></v-divider>
                            <v-stepper-step step="5" editable :complete="e1 > 5"></v-stepper-step>
                            <v-divider></v-divider>
                            <v-stepper-step step="6" editable :complete="e1 > 6"></v-stepper-step>
                            <v-divider></v-divider>
                            <v-stepper-step step="7" editable :complete="e1 > 7"></v-stepper-step>
                        </v-stepper-header>

                        <v-stepper-content step="1" class="pa-0">
                            <v-layout row wrap class="mb-4">
                                <v-card class="elevation-0">
                                    <div class="text-xs-center title">Section A: E-Learning</div>
                                    <v-card-text class="mt-4 black--text">
                                        The course is generally consistent with the following learning objectives:
                                        (Provide link to the LO in the specific course)

                                        <v-flex offset-xs1 xs12 class="mt-4">
                                            <v-radio-group v-model="a1" column>
                                                <v-radio label="Strongly Agree" color="primary" value="a1-1"></v-radio>
                                                <v-radio label="Agree" color="primary" value="a1-2"></v-radio>
                                                <v-radio label="Neutral" color="primary" value="a1-3"></v-radio>
                                                <v-radio label="Disagree" color="primary" value="a1-4"></v-radio>
                                                <v-radio label="Strongly Disagree" color="primary" value="a1-5" ></v-radio>
                                            </v-radio-group>
                                        </v-flex>

                                    </v-card-text>
                                    <v-card-text class="mt-4 black--text">
                                        The content was presented in a clear and logical way.

                                        <v-flex offset-xs1 xs12 class="mt-4">
                                            <v-radio-group v-model="a2" column>
                                                <v-radio label="Strongly Agree" color="primary" value="a2-1"></v-radio>
                                                <v-radio label="Agree" color="primary" value="a2-2"></v-radio>
                                                <v-radio label="Neutral" color="primary" value="a2-3"></v-radio>
                                                <v-radio label="Disagree" color="primary" value="a2-4"></v-radio>
                                                <v-radio label="Strongly Disagree" color="primary" value="a2-5" ></v-radio>
                                            </v-radio-group>
                                        </v-flex>
                                    </v-card-text>
                                    <v-card-text class="mt-4 mb-4 black--text">
                                        The duration of the online course is just right.

                                        <v-flex offset-xs1 xs12 class="mt-4">
                                            <v-radio-group v-model="a3" column>
                                                <v-radio label="Strongly Agree" color="primary" value="a3-1"></v-radio>
                                                <v-radio label="Agree" color="primary" value="a3-2"></v-radio>
                                                <v-radio label="Neutral" color="primary" value="a3-3"></v-radio>
                                                <v-radio label="Disagree" color="primary" value="a3-4"></v-radio>
                                                <v-radio label="Strongly Disagree" color="primary" value="a3-5" ></v-radio>
                                            </v-radio-group>
                                        </v-flex>
                                    </v-card-text>
                                </v-card>
                            </v-layout>
                            <v-card-text class="text-xs-right">
                                <v-btn @click.native="e1 = 2" flat primary>Next</v-btn>
                            </v-card-text>
                        </v-stepper-content>

                        <v-stepper-content step="2" class="pa-0">
                            <v-card class="elevation-0">
                                <div class="text-xs-center title">Section B: Multimedia</div>
                                <v-card-text class="mt-4 text-xs-center">
                                    <strong>Immersion:</strong><br>
                                    How effective was the multimedia in grabbing your attention?
                                    <v-flex xs12 class="mt-4">
                                        <v-btn icon outline class="grey--text text--darken-2">1</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">2</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">3</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">4</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">5</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">6</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">7</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">8</v-btn>
                                        <v-btn icon class="primary white--text lighten-2">9</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">10</v-btn>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4 text-xs-center">
                                    <strong>Navigation:</strong> <br>
                                    To what extent is the multimedia easy to navigate?
                                    <v-flex xs12 class="mt-4">
                                        <v-btn icon outline class="grey--text text--darken-2">1</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">2</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">3</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">4</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">5</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">6</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">7</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">8</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">9</v-btn>
                                        <v-btn icon class="primary white--text lighten-2">10</v-btn>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4 text-xs-center">
                                    <strong>Comprehension:</strong> <br>
                                    The duration of the online course is just right.
                                    <v-flex xs12 class="mt-4">
                                        <v-btn icon outline class="grey--text text--darken-2">1</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">2</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">3</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">4</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">5</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">6</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">7</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">8</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">9</v-btn>
                                        <v-btn icon class="primary white--text lighten-2">10</v-btn>
                                    </v-flex>
                                </v-card-text>
                            </v-card>
                            <v-card-text class="text-xs-right">
                                <v-btn flat @click.native="e1 = 3" primary>Next</v-btn>
                            </v-card-text>
                        </v-stepper-content>

                        <v-stepper-content step="3" class="pa-0">
                            <v-card class="elevation-0">
                                <div class="text-xs-center title">Section C: Quizzes</div>
                                <v-card-text class="mt-4 text-xs-center">
                                    The feedback in the quiz was helpful.
                                    <v-flex xs12 class="mt-4">
                                        <v-btn icon outline class="grey--text text--darken-2">1</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">2</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">3</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">4</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">5</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">6</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">7</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">8</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">9</v-btn>
                                        <v-btn icon class="primary white--text lighten-2">10</v-btn>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4 text-xs-center">
                                    The quizzes help me recall what I had learnt.
                                    <v-flex xs12 class="mt-4">
                                        <v-btn icon outline class="grey--text text--darken-2">1</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">2</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">3</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">4</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">5</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">6</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">7</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">8</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">9</v-btn>
                                        <v-btn icon class="primary white--text lighten-2">10</v-btn>
                                    </v-flex>
                                </v-card-text>
                            </v-card>
                            <v-card-text class="text-xs-right">
                                <v-btn @click.native="e1 = 4" primary flat>Next</v-btn>
                            </v-card-text>
                        </v-stepper-content>

                        <v-stepper-content step="4" class="pa-0">
                            <v-card class="elevation-0">
                                <div class="text-xs-center title">Section D: Level of Engagement</div>
                                <v-card-text class="mt-4 text-xs-center">
                                    The interactive activities (e.g. quizzes; games, etc.) were fun and engaging.
                                    <v-flex xs12 class="mt-4">
                                        <v-btn icon outline class="grey--text text--darken-2">1</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">2</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">3</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">4</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">5</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">6</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">7</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">8</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">9</v-btn>
                                        <v-btn icon class="primary white--text lighten-2">10</v-btn>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4 text-xs-center">
                                    I participate actively in the Discussion Board with my classmates/ trainer.
                                    <v-flex xs12 class="mt-4">
                                        <v-btn icon outline class="grey--text text--darken-2">1</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">2</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">3</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">4</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">5</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">6</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">7</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">8</v-btn>
                                        <v-btn icon outline class="grey--text text--darken-2">9</v-btn>
                                        <v-btn icon class="primary white--text lighten-2">10</v-btn>
                                    </v-flex>
                                </v-card-text>
                            </v-card>
                            <v-card-text class="text-xs-right">
                                <v-btn @click.native="e1 = 5" primary flat>Next</v-btn>
                            </v-card-text>
                        </v-stepper-content>

                        <v-stepper-content step="5" class="pa-0">
                            <v-card class="elevation-0 text-xs-center">
                               <div class="text-xs-center title">Section E: Overall</div>
                                <v-card-text class="mt-4">
                                    List two key takeaways from this course. How would you apply them to your work?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    What is your confidence level now when applying these new knowledge and skills at work?
                                    <v-flex xs8 offset-xs2>
                                        <v-radio-group v-model="o1" row>
                                            <v-radio label="Confident" color="primary" value="o1-1"></v-radio>
                                            <v-radio label="Not confident" color="primary" value="o1-2"></v-radio>
                                        </v-radio-group>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    How willing are you in applying these new knowledge and skills to your work?
                                    <v-flex xs8 offset-xs2>
                                        <v-radio-group v-model="o2" row>
                                            <v-radio label="Willing" color="primary" value="o2-1"></v-radio>
                                            <v-radio label="Not willing" color="primary" value="o2-2"></v-radio>
                                        </v-radio-group>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    List one area where the course meets your expectation.
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    List one area where the course falls short of your expectation.
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    Based on this experience, would you take another e-learning course? Why or why not?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                            </v-card>
                            <v-card-text class="text-xs-right">
                                <v-btn @click.native="e1 = 6" primary flat>Next</v-btn>
                            </v-card-text>
                        </v-stepper-content>

                        <v-stepper-content step="6" class="pa-0">
                            <v-card class="elevation-0 text-xs-center">
                                <div class="text-xs-center title">Section F: For Trainees to Input</div>
                                <div class="text-xs-center mt-2">(3 months after course end date)</div>
                                <v-card-text class="mt-4">
                                    To what extent have you applied what you had learnt?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    Did you face difficulty in applying what you had learnt? If so, what attributed to your difficulty?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                 <v-card-text class="mt-4">
                                    What would it take for you to start applying what you had learnt?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    In what way has your self-confidence improved after attending the workshop?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    What would you do to ensure that you perform at your best?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    To what extent are you willing to take risk?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    How confident are you in doing your work independently after attending the workshop? <br>
                                    How confident are you in doing your work in teams after attending the workshop?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    After attending the workshop, to what extent are you comitted in lifelong learning?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    What are some innovative ideas that you would propose for the company in the future?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    Where there any recent changes in your life? i.e. change in management, change in working hours, addition of new family member etc. If so, how would you adjust to these changes?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                            </v-card>
                            <v-card-text class="text-xs-right">
                                <v-btn @click.native="e1 = 7" primary flat>Next</v-btn>
                            </v-card-text>
                        </v-stepper-content>

                        <v-stepper-content step="7" class="pa-0">
                            <v-card class="elevation-0 text-xs-center">
                                <div class="title">Section G: For Trainers to Input</div>
                                <div class="mt-2">(3 months after course end date)</div>
                                <v-card-text class="mt-4">
                                    To what extent has the trainee applied what he/she had learnt?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    Did the trainee face difficulty in applying what he/she had learnt? If so, what attributed to his/her difficulty?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                 <v-card-text class="mt-4">
                                    Rate your level of observation on trainee’s behaviour for each of the following.
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    Rate your level of observation on trainee’s behaviour for each of the following.
                                        <v-flex xs12 class="mt-4">
                                            <div class="mb-2"><strong>Insert Critical Behaviour 1</strong></div>
                                            <v-btn icon outline class="grey--text text--darken-2">1</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">2</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">3</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">4</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">5</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">6</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">7</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">8</v-btn>
                                            <v-btn icon class="primary white--text lighten-2">9</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">10</v-btn>
                                        </v-flex>
                                        <v-flex xs12 class="mt-4">
                                            <div class="mb-2"><strong>Insert Critical Behaviour 2</strong></div>
                                            <v-btn icon outline class="grey--text text--darken-2">1</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">2</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">3</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">4</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">5</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">6</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">7</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">8</v-btn>
                                            <v-btn icon class="primary white--text lighten-2">9</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">10</v-btn>
                                        </v-flex>
                                        <v-flex xs12 class="mt-4">
                                            <div class="mb-2"><strong>Insert Critical Behaviour 3</strong></div>
                                            <v-btn icon outline class="grey--text text--darken-2">1</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">2</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">3</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">4</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">5</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">6</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">7</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">8</v-btn>
                                            <v-btn icon class="primary white--text lighten-2">9</v-btn>
                                            <v-btn icon outline class="grey--text text--darken-2">10</v-btn>
                                        </v-flex>
                                </v-card-text>
                                <v-card-text class="mt-4">
                                    What would it take for him/her to start applying what he/she had learnt?
                                    <v-flex xs8 offset-xs2>
                                        <v-text-field
                                            name="input-1"
                                            placeholder="Write answer.."
                                            textarea
                                            row="3"
                                            class="evaluation-field"
                                        ></v-text-field>
                                    </v-flex>
                                </v-card-text>
                            </v-card>
                            <v-card-text class="text-xs-right">
                                <v-btn @click.native="evaluation.dialog.model = false" primary flat>Submit</v-btn>
                            </v-card-text>
                        </v-stepper-content>
                    </v-stepper>
                </v-flex>
            </v-card-text>
        </v-card>
    </v-dialog>
</v-card-text>
{{-- /end of evaluation modal --}}
