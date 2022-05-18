<?php
namespace App\Classes;

/**
 * class SUWONPage to build page
 */
class SUWONPage
{
    /**
     * Opening container
     */
    public static function container_open() {
        ?>
        <div class="container-fluid">
        <?php
    }

    /**
     * form area starter
     */
    public static function formarea_start() {
        ?>
        <div class="card">
	        <div class="form-area">
        <?php
    }

    /**
     * form area end
     */
    public static function formarea_end() {
        ?>
            </div><!-- .form-area -->
        </div><!-- .card -->
        <?php
    }

    /**
     * left progress sidebar
     */
    public static function left_progress_bar() {
        ?>
        <div class="left-side">

            <div class="left-heading">
                <h3>SurveWon</h3>
            </div>
            <div class="steps-content">
                <h3>Step <span class="step-number">1</span></h3>
                <p class="step-number-content active">Make sure the respondent is willing to participate.</p>
                <p class="step-number-content d-none">About enumerator and data collection site</p>
                <p class="step-number-content d-none">Household identification cover sheet</p>
                <p class="step-number-content d-none">Information about the respondent</p>
                <p class="step-number-content d-none">Household's information on literacy status and livelihood</p>
                <p class="step-number-content d-none">Composition of the household by age and sex</p>
                <p class="step-number-content d-none">Family members school enrollment</p>
                <p class="step-number-content d-none">Participation of household and its members in different programs</p>
            </div>
            <ul class="progress-bar">
                <li class="active">Informed Consent</li>
                <li>General Information</li>
                <li>Respondent's Information</li>
                <li>Education Status and Livelihood</li>
                <li>Household Composition</li>
                <li>School Enrollment</li>
                <li>Program Participation</li>
            </ul>
                                
            </div>
        <?php
    }

    /**
     * Closing container
     */
    public static function container_close() {
        ?>
        </div>
        <?php
    }
    
}
