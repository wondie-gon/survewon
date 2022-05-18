<?php
use App\Classes\SUWONPage;

use App\Classes\Fields\InputField;
use App\Classes\Fields\RadioBoxField;
use App\Classes\Fields\CheckBoxField;
/**
 * Public index page
 */
// html head start
include './includes/header/html-head.php';
SUWONPage::container_open();
// start form area
SUWONPage::formarea_start();
// left progress bar
SUWONPage::left_progress_bar();
?>

	            <div class="right-side">
					<form id="module_100" name="module_100_form" action="">
						<div class="main active">
							<h1><i class="fa fa-users me-2"></i>Household Questionnaire</h1>
							<h3>Informed consent</h3>
							<p class="fw-semibold">My name is 'NAME HERE' and I am working with PReSERVE in Ethiopia. We are collecting information to conduct research which will be used by government and programs to use it for policy decision making. We would like to ask you some general questions. You are free to choose if you want to participate in this survey or not. If you agree to participate, please answer the questions openly and sincerely. If you don't know the answer to a question, please just say so. Everything you say will be kept confidential and your name will not be shared with anybody. This interview will take about 45 minutes.</p>
							<?php
							// agreed
							echo RadioBoxField::get_fields_list(
								array(
									"name"    	   => "agreed",
									"fields_title" => "Do you agree to participate in this survey?", 
									"is_inline"	=> true,
									"value_text_pairs"  => array(
										"1"	=>	"Yes",
										"0"	=>	"No"
									),
								)
							);
							?>
							<div class="buttons">
								<button class="nxt_step_btn">Next Step</button>
							</div>
						</div>
						<div class="main">
							<h3>General Information</h3>
							<?php
							// en_id
							echo InputField::get_field(
								array(
									"input_type"        => "text",
									"id"                => "en_id",
									"name"              => "en_id",
									"label_args"         => array( 
										"for"   =>  "en_id",
										"text"  =>  "Name of the Enumerator"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
								)
							);

							// region
							echo InputField::get_field(
								array(
									"input_type"        => "text",
									"id"                => "region",
									"name"              => "region",
									"label_args"         => array( 
										"for"   =>  "region",
										"text"  =>  "Region"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
								)
							);

							// zone
							echo InputField::get_field(
								array(
									"input_type"        => "text",
									"id"                => "zone",
									"name"              => "zone",
									"label_args"         => array( 
										"for"   =>  "zone",
										"text"  =>  "Zone"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
								)
							);
							// district
							echo InputField::get_field(
								array(
									"input_type"        => "text",
									"id"                => "district",
									"name"              => "district",
									"label_args"         => array( 
										"for"   =>  "district",
										"text"  =>  "District"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
								)
							);

							// kebele
							echo InputField::get_field(
								array(
									"input_type"        => "text",
									"id"                => "kebele",
									"name"              => "kebele",
									"label_args"         => array( 
										"for"   =>  "kebele",
										"text"  =>  "Kebele"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
								)
							);

							// in_psnp
							echo RadioBoxField::get_fields_list(
									array(
										"name"    	   => "in_psnp",
										"fields_title" => "Participation", 
										"value_text_pairs"  => array(
											"1"	=>	"PSNP participant",
											"2"	=>	"PSNP non-participant"
										),
									)
								);
							?>
							<div class="buttons button_space">
								<button class="prev_step_btn">Back</button>
								<button class="nxt_step_btn">Next Step</button>
							</div>
						</div><!-- .main -->
						<div class="main">
							<h3>Respondent's Information</h3>
							<?php
							// name_q0
							echo InputField::get_field(
								array(
									"input_type"        => "text",
									"id"                => "name_q0",
									"name"              => "name_q0",
									"label_args"         => array( 
										"for"   =>  "name_q0",
										"text"  =>  "What is your name (provide all three names)?"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"helptext"	=>	"Enter All Three Names. Example 'Bekele Abebe Kebede' Note: Please use the Ethiopian version of all the three names. Each name should start with a capital letter. There should be no space left after the last name."
								)
							);

							// m1_q1
							echo RadioBoxField::get_fields_list(
									array(
										"name"    	   => "m1_q1",
										"fields_title" => "Sex of respondent", 
										"value_text_pairs"  => array(
											"1"	=>	"Male",
											"0"	=>	"Female"
										),
									)
								);

							// m1_q2
							echo RadioBoxField::get_fields_list(
									array(
										"name"    	   => "m1_q2",
										"fields_title" => "What is your relationship to the head of the household?", 
										"info_text" => "Read the response options out loud and ask the respondent to select the most accurate one. Household members below 15 should not be surveyed.", 
										"value_text_pairs"  => array(
											"1" => "Respondent is Head of Household",
											"2" => "This house is child headed household",
											"3" => "Son",
											"4" => "Daughter",
											"5" => "Father/Mother",
											"6" => "Sister/Brother",
											"7" => "Other relative",
											"8" => "Servant (live-in)",
											"9" => "Co-wife",
											"10" => "Grandmother/father",
											"-99" => "Other (please specify)"
										),
									)
								);
							// m1_q3
							echo InputField::get_field(
								array(
									"input_type"        => "text",
									"id"                => "m1_q3",
									"name"              => "m1_q3",
									"label_args"         => array( 
										"for"   =>  "m1_q3",
										"text"  =>  "Please specify"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
								)
							);
							// m1_q4
							echo InputField::get_field(
								array(
									"input_type"        => "text",
									"id"                => "m1_q4",
									"name"              => "m1_q4",
									"label_args"         => array( 
										"for"   =>  "m1_q4",
										"text"  =>  "What is the name of the head of household (provide all three names)?"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"helptext"	=>	"Enter All Three Names. Example 'Bekele Abebe Kebede' Note: Please use the Ethiopian version of all the three names. Each name should start with a capital letter. There should be no space left after the last name."
								)
							);

							// m1_q5
							echo RadioBoxField::get_fields_list(
									array(
										"name"    	   => "m1_q5",
										"fields_title" => "Sex of the head of the household", 
										"value_text_pairs"  => array(
											"1"	=>	"Male",
											"0"	=>	"Female"
										),
									)
								);

							// m1_q6
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q6",
									"name"              => "m1_q6",
									"label_args"         => array( 
										"for"   =>  "m1_q6",
										"text"  =>  "Age of the head of household"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "15",
									"max" => "120",
								)
							);

							// m1_q7
							echo RadioBoxField::get_fields_list(
									array(
										"name"    	   => "m1_q7",
										"fields_title" => "Current marital status of the head of the household", 
										"value_text_pairs"  => array(
											"1" => "Single",
											"2" => "Married",
											"3" => "Divorced/Separated",
											"4" => "Widow/Widower",
											"-9" => "Refused to answer"
										),
									)
								);
							?>
							<div class="buttons button_space">
								<button class="prev_step_btn">Back</button>
								<button class="nxt_step_btn">Next Step</button>
							</div>
						</div>

						<div class="main">
							<h3>Education Status and Livelihood</h3>
							<?php
							// m1_q8
							echo RadioBoxField::get_fields_list(
								array(
									"name"    	   => "m1_q8",
									"fields_title" => "What is the highest level of education of the head of the household?", 
									"info_text"	=> "Read the response options out loud and ask the respondent to select the most accurate one.",
									"value_text_pairs"  => array(
										"1" => "Religious",
										"2" => "Some primary",
										"3" => "Completed primary",
										"4" => "Some secondary",
										"5" => "Completed secondary",
										"6" => "Some university",
										"7" => "Completed university",
										"8" => "Graduate degree",
										"9" => "No education",
										"10" => "Vocational Training",
										"-77" => "Not applicable", 
										"-88" => "Don't know",
										"-99" => "Refused"
									),
								)
							);
							// m1_q9
							echo RadioBoxField::get_fields_list(
								array(
									"name"    	   => "m1_q9",
									"fields_title" => "What is the highest level of education of the spouse of household?", 
									"info_text" => "Read the response options out loud and ask the respondent to select the most accurate one", 
									"value_text_pairs"  => array(
										"1" => "Religious", 
										"2" => "Some primary",
										"3" => "Completed primary",
										"4" => "Some secondary",
										"5" => "Completed secondary",
										"6" => "Some university",
										"7" => "Completed university",
										"8" => "Graduate degree",
										"9" => "No education",
										"10" => "Vocational Training",
										"-77" => "Not applicable", 
										"-88" => "Don't know",
										"-99" => "Refused"
									),
								)
							);

							// m1_q10
							echo RadioBoxField::get_fields_list(
								array(
									"name"    	   => "m1_q10",
									"fields_title" => "Does the head of the household know how to read and write in any languages?", 
									"value_text_pairs"  => array(
										"1" => "Yes",
										"2" => "No",
										"-8" => "Don't know",
										"-9" => "Refused to answer"
									),
								)
							);
							// m1_q11
							echo RadioBoxField::get_fields_list(
								array(
									"name"    	   => "m1_q11",
									"fields_title" => "Which of the following livelihood zones do best describe your household?", 
									"info_text" => "Read the response options out loud and ask the respondent to select the most accurate one.", 
									"value_text_pairs"  => array(
										"1" => "Crop based", 
										"2" => "Livestock based", 
										"3" => "Mixed agriculture",
										"4" => "fishery",
										"5" => "Pastoral",
										"6" => "Urban"
									),
								)
							);
							?>
							<div class="buttons button_space">
								<button class="prev_step_btn">Back</button>
								<button class="nxt_step_btn">Next Step</button>
							</div>
						</div>

						<div class="main">
							<h3>Household Composition</h3>
							<?php
							// m1_q12_a0
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_a0",
									"name"              => "m1_q12_a0",
									"label_args"         => array( 
										"for"   =>  "m1_q12_a0",
										"text"  =>  "How many of the following people are in your household? Household Composition: 0 to 4 years"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);

							// m1_q12_a1
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_a1",
									"name"              => "m1_q12_a1",
									"label_args"         => array( 
										"for"   =>  "m1_q12_a1",
										"text"  =>  "Children (less than 5 years): Boys"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);

							// m1_q12_a2
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_a2",
									"name"              => "m1_q12_a2",
									"label_args"         => array( 
										"for"   =>  "m1_q12_a2",
										"text"  =>  "Children (less than 5 years): Girls"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);

							// m1_q12_b0
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_b0",
									"name"              => "m1_q12_b0",
									"label_args"         => array( 
										"for"   =>  "m1_q12_b0",
										"text"  =>  "Household Composition: 5 to 17 years"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);

							// m1_q12_b1
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_b1",
									"name"              => "m1_q12_b1",
									"label_args"         => array( 
										"for"   =>  "m1_q12_b1",
										"text"  =>  "Children (5 to 17 years): Male"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);

							// m1_q12_b2
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_b2",
									"name"              => "m1_q12_b2",
									"label_args"         => array( 
										"for"   =>  "m1_q12_b2",
										"text"  =>  "Children (5 to 17 years): Female"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);
							// m1_q12_c0
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_c0",
									"name"              => "m1_q12_c0",
									"label_args"         => array( 
										"for"   =>  "m1_q12_c0",
										"text"  =>  "Household Composition: 18 to 49 years"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);

							// m1_q12_c1
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_c1",
									"name"              => "m1_q12_c1",
									"label_args"         => array( 
										"for"   =>  "m1_q12_c1",
										"text"  =>  "Adults (18 to 49 years): Male"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);

							// m1_q12_c2
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_c2",
									"name"              => "m1_q12_c2",
									"label_args"         => array( 
										"for"   =>  "m1_q12_c2",
										"text"  =>  "Adults (18 to 49 years): Female"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);
							// m1_q12_d0
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_d0",
									"name"              => "m1_q12_d0",
									"label_args"         => array( 
										"for"   =>  "m1_q12_d0",
										"text"  =>  "Household Composition: 50 to 69 years"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);

							// m1_q12_d1
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_d1",
									"name"              => "m1_q12_d1",
									"label_args"         => array( 
										"for"   =>  "m1_q12_d1",
										"text"  =>  "Adults (50 to 69 years): Male"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);

							// m1_q12_d2
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_d2",
									"name"              => "m1_q12_d2",
									"label_args"         => array( 
										"for"   =>  "m1_q12_d2",
										"text"  =>  "Adults (50 to 69 years): Female"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);

							// m1_q12_e0
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_e0",
									"name"              => "m1_q12_e0",
									"label_args"         => array( 
										"for"   =>  "m1_q12_e0",
										"text"  =>  "Household Composition: 70 Years and Above"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);

							// m1_q12_e1
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_e1",
									"name"              => "m1_q12_e1",
									"label_args"         => array( 
										"for"   =>  "m1_q12_e1",
										"text"  =>  "Adults (70 Years and Above): Male"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);

							// m1_q12_e2
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_e2",
									"name"              => "m1_q12_e2",
									"label_args"         => array( 
										"for"   =>  "m1_q12_e2",
										"text"  =>  "Adults (70 Years and Above): Female"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "15",
								)
							);

							// m1_q12_tot
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q12_tot",
									"name"              => "m1_q12_tot",
									"label_args"         => array( 
										"for"   =>  "m1_q12_tot",
										"text"  =>  "TOTAL HH MEMEBERS"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "30",
								)
							);
							?>
							<div class="buttons button_space">
								<button class="prev_step_btn">Back</button>
								<button class="nxt_step_btn">Next Step</button>
							</div>
						</div>

						<div class="main">
							<h3>School Enrollment</h3>
							<?php
							// m1_q13
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q13",
									"name"              => "m1_q13",
									"label_args"         => array( 
										"for"   =>  "m1_q13",
										"text"  =>  "How many household members are literate in your household in total?"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "30",
								)
							);

							// m1_q14
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q14",
									"name"              => "m1_q14",
									"label_args"         => array( 
										"for"   =>  "m1_q14",
										"text"  =>  "How many boys in the household aged 5-17 years are currently enrolled in school?"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "30",
								)
							);

							// m1_q15
							echo InputField::get_field(
								array(
									"input_type"        => "number",
									"id"                => "m1_q15",
									"name"              => "m1_q15",
									"label_args"         => array( 
										"for"   =>  "m1_q15",
										"text"  =>  "How many girls in the household aged 5-17 years are currently enrolled in school?"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"min" 	=> "0",
									"max" => "30",
								)
							);
							?>
							<div class="buttons button_space">
								<button class="prev_step_btn">Back</button>
								<button class="nxt_step_btn">Next Step</button>
							</div>
						</div>

						<div class="main">
							<h3>Program Participation</h3>
							<?php
							// m1_q16
							echo RadioBoxField::get_fields_list(
								array(
									"name"    	   => "m1_q16",
									"fields_title" => "Did you or any of your household member receive or currently receiving any assistance from the PSNP program  implemented in your area?", 
									"value_text_pairs"  => array(
										"1" => "Yes",
										"2" => "No",
										"-8" => "Don't know",
										"-9" => "Refused to answer"
									),
								)
							);

						// m1_q17
						echo CheckBoxField::get_fields_list(
								array(
									"name"    	   => "m1_q17",
									"fields_title" => "What activity or activities did you or any of your household members participate or are currently participating in as part of PSNP implemented", 
									"value_text_pairs"  => array(
										"1" => "Animal treatment services (VACCINATION AND TREATMENT OF ANIMALS)",
										"2" => "Agricultural/pastoral/fisheries' inputs and training",
										"3" => "Distribution of Productive Inputs Distributed Directly at Household Level (Tools, Animals, Carts, Etc)",
										"4" => "Distribution of non-food items for Protection, Shelter or WASH",
										"5" => "Income-generation services (vocational or business training and grants)",
										"6" => "Participation in a VSLA/self-help/savings group",
										"7" => "Cash for Work",
										"8" => "Unconditional cash transfers",
										"9" => "Basic health services",
										"10" => "Basic nutrition services",
										"11" => "Training on nutrition practices (for instance infant and young child feeding)",
										"12" => "New or rehabilitated shelter",
										"13" => "Improved access to clean water",
										"14" => "Fodder production",
										"-88" => "No participation",
										"-99" => "Other (please specify)"
									),
								)
							);

							// m1_q18
							echo InputField::get_field(
								array(
									"input_type"        => "text",
									"id"                => "m1_q18",
									"name"              => "m1_q18",
									"label_args"         => array( 
										"for"   =>  "m1_q18",
										"text"  =>  "Other (please specify)"
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
								)
							);

							// m1_q19
							echo InputField::get_field(
								array(
									"input_type"        => "text",
									"id"                => "m1_q19",
									"name"              => "m1_q19",
									"label_args"         => array( 
										"for"   =>  "m1_q19",
										"text"  =>  "Please estimate the total amount of unconditional cash transfers that your household received in the last 12 month in total."
									),
									"class_list"        => "form-control",
									"wrap"              => true,
									"wrap_args"         => array(
										"class"     =>  "form-group mb-3",
									),
									"helptext"        => "Report it in USD. Exchange rate is 1 USD = 52 ETB",
								)
							);
							?>
							<div class="buttons button_space">
								<button class="prev_step_btn">Back</button>
	                        	<button id="saveMod1Btn" class="btn btn-primary submit_button" type="submit">Save Data</button>
							</div>
						</div>
					</form>
	            </div><!-- .right-side -->
	        
	
<?php
// form area end
SUWONPage::formarea_end();
// closing container
SUWONPage::container_close();
// html foot
include './includes/footer/html-foot.php';