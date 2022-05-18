<?php
namespace App\Classes;

/**
 * class SUWONPageTabler to build page
 */
class SUWONPageTabler
{
    /**
     * Opening page
     */
    public static function page_open() {
        ?>
        <div class="page">
        <?php
    }
    /**
     * Opening page-wrapper
     */
    public static function page_wrapper_open() {
        ?>
        <div class="page-wrapper">
        <?php
    }

    /**
     * page header
     */
    public static function page_header() {
        ?>
        <div class="container-xl">
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h1 class="fw-bold">
                  Household Questionnaire Module 1
                </h1>
              </div>
            </div>
          </div>
        </div>
        <?php
    }

    /**
     * Opening page main content
     */
    public static function page_main_open() {
        ?>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
        <?php
    }

    /**
     * form starter
     */
    public static function form_start( $id = '' ) {
        ?>
        <form action="" id="<?php echo htmlspecialchars( $id ); ?>" class="card">
        <?php
    }

    /**
     * Card heaader in form
     */
    public static function form_card_header( $title ) {
        ?>
            <div class="card-header">
                <h1 class="card-title"><?php echo htmlspecialchars( $title ) ?></h1>
            </div>
        <?php
    }

    /**
     * card body row starter
     */
    public static function cardbody_start() {
        ?>
        <div class="card-body">
	        <!-- <div class="row"> -->
        <?php
    }

    /**
     * card body row end
     */
    public static function cardbody_end() {
        ?>
            <!-- </div> -->
        </div><!-- .card-body -->
        <?php
    }
    /**
     * Displays the dynamically changing block starter, holding
     * group of input fields
     * @param array $args array of argument to display 
     *              this block starter
     */
    public static function main_fields_block_wrap_start( $args = array() ) {
        $default = array(
            'block_title' =>  'Form Sub Heading',
            'block_desc'    =>  NULL,
        );

        $args = array_merge( $default, $args );
        $html = '<div class="main row">';
        $html .= '<div class="col-12">';
        $html .= '<h2>' . htmlspecialchars( $args['block_title'] ) . '</h2>';

        if ( isset( $args['block_desc'] ) ) {
            $html .= '<p class="lead">' . htmlspecialchars( $args['block_desc'] ) . '</p>';
        }
        $html .= '</div>';
        $html .= '<div class="col-12 fields-box">';

        // printing output
        echo $html;
    }
    /**
     * Closing main fields block
     * @param boolean $has_prev True if it has back button
     * @param boolean $has_nxt Whether it has next button
     * @return html closing of each main field block
     */
    public static function main_fields_block_wrap_end( $has_prev = true, $has_nxt = true ) {
        ?>
            </div><!-- .fields-box.col-12 -->
            <div class="col-12 btns-col">
                <div class="buttons button_space">
                    <?php if ( $has_prev === true ) : ?>
                    <button class="prev_step_btn">Back</button>
                    <?php 
                    endif;
                    if ( $has_nxt === true ) :
                    ?>
                    <button class="nxt_step_btn">Next Step</button>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- .main.row -->
        <?php
    }

    /**
     * Card footer, contains sub,it button
     */
    public static function card_footer_submit_btn() {
        ?>
        <div class="card-footer text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-link">Cancel</a>
                <button type="submit" class="btn btn-primary ms-auto">Send data</button>
            </div>
        </div>
        <?php
    }

    /**
     * form closing
     */
    public static function form_end() {
        ?>
        </form>
        <?php
    }

    /**
     * Closing page main content
     */
    public static function page_main_close() {
        ?>
                        </div><!-- .col-12 -->
                    </div><!-- .row row-cards -->
                </div><!-- .container-xl -->
            </div><!-- .page-body -->
        <?php
    }

    /**
     * aside progress sidebar
     */
    public static function aside_progress_bar() {
        ?>
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href=".">
                    <img src="./static/logo-white.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                    </a>
                </h1>
                <div class="navbar-nav flex-row d-lg-none">
                    <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                        <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                        <div class="d-none d-xl-block ps-2">
                        <div>Wondwossen</div>
                        <div class="mt-1 small text-muted">Enumerator</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="#" class="dropdown-item">Set status</a>
                        <a href="#" class="dropdown-item">Profile & account</a>
                        <a href="#" class="dropdown-item">Feedback</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">Settings</a>
                        <a href="#" class="dropdown-item">Logout</a>
                    </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="navbar-nav pt-lg-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </span>
                            <span class="nav-link-title">
                                Module 1
                            </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Informed Consent</a>
                                <a class="dropdown-item" href="#">General Information</a>
                                <a class="dropdown-item" href="#">Respondent's Information</a>
                                <a class="dropdown-item" href="#">Education Status and Livelihood</a>
                                <a class="dropdown-item" href="#">Household Composition</a>
                                <a class="dropdown-item" href="#">School Enrollment</a>
                                <a class="dropdown-item" href="#">Program Participation</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <?php
    }

    /**
     * Closing page-wrapper
     */
    public static function page_wrapper_close() {
        ?>
        </div><!-- .page-wrapper -->
        <?php
    }

    /**
     * Closing page
     */
    public static function page_close() {
        ?>
        </div><!-- .page -->
        <?php
    }
    
} // class end
