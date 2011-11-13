<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "users_interface";
$route['404_override'] = '';


/***********************************	USERS INTRERFACE	***********************************************/

/* ----------------------------------------	users menu	--------------------------------------------------*/
$route[''] = "users_interface/index";
//$route['ideas'] = "users_interface/ideas";
$route['job'] = "users_interface/job";
$route['about'] = "users_interface/about_project";
$route['contacts'] = "users_interface/contacts";
$route['conditions-cooperation'] = "users_interface/cooperation";
$route['support'] = "users_interface/support";
$route['information'] = "users_interface/information";
$route['for-dealers'] = "users_interface/for_dealers";

$route['dealers-list'] = "users_interface/dealers_list";
$route['dealers-list/region/:num'] = "users_interface/dealers_list";
$route['business-environment/page-locked'] = "users_interface/page_locked";
/* --------------------------------------------- started work ---------------------------------------------*/
$route['started'] = "users_interface/select_settings";
$route['users/select-region'] = "users_interface/create_select_region";
$route['users/select-activity'] = "users_interface/create_select_activity";
$route['users/search-activity'] = "users_interface/create_search_activity";
$route['users/search-region'] = "users_interface/create_search_region";
$route['activity-information/region/:num/activity/:num'] = "users_interface/activity_information";
$route['activity-information/region/:num/activity/:num/product/:num'] = "users_interface/activity_information";
$route['pricing-information/region/:num/activity/:num'] = "users_interface/pricing_information";
$route['season-information/region/:num/activity/:num'] = "users_interface/season_information";
$route['announce-tender/region/:num/activity/:num'] = "users_interface/announce_tender";
$route['manager-list/region/:num/activity/:num'] = "users_interface/manager_list";
$route['product-unit/region/:num/activity/:num'] = "users_interface/product_unit_load";
$route['product-info/region/:num/activity/:num'] = "users_interface/product_unit_info";
$route['offer-list/region/:num'] = "users_interface/offer_list";
$route['consultation/managers/:num'] = "users_interface/consultation_list";
/* ----------------------------------------------- company ------------------------------------------------*/

$route['company-info/:num'] = "users_interface/company_info";
$route['representatives/company/:num'] = "users_interface/representatives_list";
$route['company/products-group-list'] = "users_interface/products_unit_info";

/* ----------------------------------------	registering company -------------------------------------------*/
$route['registering'] 		 = "users_interface/register_step0";
$route['abort-registering']	 = "users_interface/abort_registering";
$route['registering/step-1'] = "users_interface/register_step1";
$route['registering/step-2'] = "users_interface/register_step2";
$route['registering/step-3'] = "users_interface/register_step3";
$route['registering/step-4'] = "users_interface/register_step4";

/* ------------------------------------------	activation -----------------------------------------------*/
$route['activation/([a-zA-Z0-9])*'] = "users_interface/activation";
$route['dealer-activation/([a-zA-Z0-9])*'] = "users_interface/dealer_activation";

/* ----------------------------------- authorization/shutdown ---------------------------------------------*/
$route['lost-password'] = "users_interface/lost_password";
$route['authorization'] = "users_interface/authorization";
$route['shutdown'] = "users_interface/shutdown";
$route['admin']	= "users_interface/admin_login";
$route['dealers']	= "users_interface/dealers_login";
/* ------------------------------------------ views -------------------------------------------------------*/
$route['views/login'] = "users_interface/views";
$route['views/logout'] = "users_interface/views";
$route['views/representative'] = "users_interface/views";
$route['companylogo/viewimage/:num'] = "users_interface/viewimage";
$route['companythumb/viewimage/:num'] = "users_interface/viewimage";
$route['cravatar/viewimage/:num'] = "users_interface/viewimage";
$route['cnavatar/viewimage/:num'] = "users_interface/viewimage";
$route['cshavatar/viewimage/:num'] = "users_interface/viewimage";
$route['mpavatar/viewimage/:num'] = "users_interface/viewimage";
$route['mavatar/viewimage/:num'] = "users_interface/viewimage";
$route['anavatar/viewimage/:num'] = "users_interface/viewimage";
$route['pravatar/viewimage/:num'] = "users_interface/viewimage";
$route['activitynews/viewimage/:num'] = "users_interface/viewimage";
$route['companynews/viewimage/:num'] = "users_interface/viewimage";
$route['davatar/viewimage/:num'] = "users_interface/viewimage";
$route['prsavatar/viewimage/:num'] = "users_interface/viewimage";
$route['docavatar/viewimage/:num'] = "users_interface/viewimage";
$route['bedocavatar/viewimage/:num'] = "users_interface/viewimage";
$route['specials/viewimage/:num'] = "users_interface/viewimage";
$route['puravatar/viewimage/:num'] = "users_interface/viewimage";
$route['curavatar/viewimage/:num'] = "users_interface/viewimage";
$route['shares/viewimage/:num'] = "users_interface/viewimage";
$route['associations/viewimage/:num'] = "users_interface/viewimage";
$route['offers/viewimage/:num'] = "users_interface/viewimage";
$route['activity-news/viewimage/:num'] = "users_interface/viewimage";
$route['company-news/viewimage/:num'] = "users_interface/viewimage";
$route['activity-discounts/viewimage/:num'] = "users_interface/viewimage";
$route['company-discounts/viewimage/:num'] = "users_interface/viewimage";

$route['show/contact'] = "users_interface/show_contact";

/* ------------------------------------------ other -------------------------------------------------------*/
$route['script_error'] = "users_interface/showerror";
$route['send-manager-email'] = "users_interface/send_manager_mail";

$route['registration-request/federal-manager'] = "users_interface/registration_request";
$route['registration-request/regional-manager'] = "users_interface/registration_request";

$route['add-pitfall'] = "users_interface/ajax_add_pitfall";
$route['add-question'] = "users_interface/ajax_add_question";
$route['add-tips'] = "users_interface/ajax_add_tips";

/***********************************	MANAGER INTRERFACE	***********************************************/
$route['managers/control-panel/:any'] = "manager_interface/cpanel";
$route['managers/set-cpanel/:any'] = "manager_interface/set_cpanel";
$route['managers/cabinet/:any'] = "manager_interface/profile";
$route['managers/add-job/:any'] = "manager_interface/insert_job";
$route['views/job-list/:any'] = "manager_interface/views";
$route['managers/delete-job/:any'] = "manager_interface/delete_job";
$route['managers/registration/:any'] = "manager_interface/register";
$route['managers/save-profile/:any'] = "manager_interface/save_profile";
$route['views/form-job/:any'] = "manager_interface/views";
$route['views/form-prnposition/:any'] = "manager_interface/views";
$route['views/manager-list/:any'] = "manager_interface/views";
$route['managers/set-manager-region/:any'] = "manager_interface/set_manager_on_region";
$route['managers/manager-list/:any'] = "manager_interface/manager_list";

$route['listbox/product-unit-list/:any'] = "manager_interface/product_unit_load";
$route['listbox/product-unit-form/:any'] = "manager_interface/product_form_load";

$route['managers/edit-product/:any'] = "manager_interface/edit_product";
$route['managers/edit-pitfalls/:any'] = "manager_interface/edit_pitfalls";
$route['managers/delete-pitfalls/:any'] = "manager_interface/delete_pitfalls";
$route['managers/save-pitfalls/:any'] = "manager_interface/save_pitfalls";
$route['managers/edit-questions/:any'] = "manager_interface/edit_questions";
$route['managers/delete-question/:any'] = "manager_interface/delete_question";
$route['managers/save-question/:any'] = "manager_interface/save_question";
$route['managers/edit-news/:any'] = "manager_interface/edit_news";
$route['managers/delete-news/:any'] = "manager_interface/delete_news";
$route['managers/save-news/:any'] = "manager_interface/save_news";
$route['managers/edit-persona/:any'] = "manager_interface/edit_persona";
$route['managers/edit-documents/:any'] = "manager_interface/edit_documents";
$route['managers/delete-document/:any'] = "manager_interface/delete_document";
$route['managers/save-document/:any'] = "manager_interface/save_document";
$route['managers/edit-specials/:any'] = "manager_interface/edit_specials";
$route['managers/delete-specials/:any'] = "manager_interface/delete_specials";
$route['managers/save-specials/:any'] = "manager_interface/save_specials";
$route['managers/edit-tips/:any'] = "manager_interface/edit_tips";
$route['managers/delete-tips/:any'] = "manager_interface/delete_tips";
$route['managers/save-tips/:any'] = "manager_interface/save_tips";
$route['managers/edit-whomain/:any'] = "manager_interface/edit_whomain";
$route['managers/edit-coordinator/:any'] = "manager_interface/edit_coordinator";
$route['managers/product-unit-dalete/:any'] = "manager_interface/product_unit_dalete";
$route['managers/product-unit-info/:any'] = "manager_interface/product_unit_info";
$route['managers/offer-list/:any'] = "manager_interface/offer_list";
$route['managers/consultation/:any'] = "manager_interface/consultation";
$route['managers/delete-consultation/:any'] = "manager_interface/delete_consultation";
$route['managers/save-consultation/:any'] = "manager_interface/save_consultation";
$route['managers/close-consultation/:any'] = "manager_interface/close_consultation";

$route['managers/edit-pricing/:any'] = "manager_interface/edit_pricing";
$route['managers/edit-season/:any'] = "manager_interface/edit_season";

/************************************	DEALERS INTRERFACE	***********************************************/

$route['dealer/control-panel/:any'] = "dealer_interface/cpanel";
$route['dealer/shutdown/:any'] = "dealer_interface/shutdown";
$route['dealer/cabinet/:any'] = "dealer_interface/cabinet";

$route['dealer/save-profile/:any'] = "dealer_interface/save_profile";

$route['dealer/get-code/:any'] = "dealer_interface/get_code";
$route['dealer/generate-code/:any'] = "dealer_interface/generate_code";

$route['dealer/register-company/:any/step-1'] = "dealer_interface/register_step1";
$route['dealer/register-company/:any/step-2'] = "dealer_interface/register_step2";
$route['dealer/register-company/:any/step-3'] = "dealer_interface/register_step3";
$route['dealer/register-company/:any/finish'] = "dealer_interface/register_step4";

$route['dealer/register-company/:any'] = "dealer_interface/register_step1";

/************************************	ADMIN INTRERFACE	***********************************************/

$route['admin/control-panel/:any'] = "admin_interface/cpanel";

$route['admin/edit-activity/:any/region/:num/activity/:num'] = "admin_interface/edit_activity";
$route['admin/edit-activity/:any'] = "admin_interface/edit_activity";

$route['admin/manage-whomain/:any/start-auctions'] = "admin_interface/start_auctions";
$route['admin/manage-whomain/:any/finish-auctions'] = "admin_interface/finish_auctions";

$route['admin/begin-auction/:any'] = "admin_interface/begin_auction";
$route['admin/end-auction/:any'] = "admin_interface/end_auction";

$route['admin/edit-activity/:any/activity/:num'] = "admin_interface/manage_whomain";
$route['admin/manage-whomain/:any'] = "admin_interface/manage_whomain";

$route['admin/delete-activity/:any']= "admin_interface/dalete_activity";

$route['admin/search-activity/:any'] = "admin_interface/create_search_activity";
$route['admin/search-region/:any'] = "admin_interface/create_search_region";

$route['admin/page-content/:any/:any'] = "admin_interface/page_content";
$route['admin/activity-content/:any/:any'] = "admin_interface/activity_content";

$route['admin/edit-product/:any'] = "admin_interface/edit_product";
$route['admin/edit-pitfalls/:any'] = "admin_interface/edit_pitfalls";
$route['admin/delete-pitfalls/:any'] = "admin_interface/delete_pitfalls";
$route['admin/save-pitfalls/:any'] = "admin_interface/save_pitfalls";
$route['admin/edit-questions/:any'] = "admin_interface/edit_questions";
$route['admin/delete-question/:any'] = "admin_interface/delete_question";
$route['admin/save-question/:any'] = "admin_interface/save_question";
$route['admin/edit-news/:any'] = "admin_interface/edit_news";
$route['admin/delete-news/:any'] = "admin_interface/delete_news";
$route['admin/save-news/:any'] = "admin_interface/save_news";
$route['admin/edit-persona/:any'] = "admin_interface/edit_persona";
$route['admin/edit-documents/:any'] = "admin_interface/edit_documents";
$route['admin/delete-document/:any'] = "admin_interface/delete_document";
$route['admin/save-document/:any'] = "admin_interface/save_document";
$route['admin/edit-specials/:any'] = "admin_interface/edit_specials";
$route['admin/delete-specials/:any'] = "admin_interface/delete_specials";
$route['admin/save-specials/:any'] = "admin_interface/save_specials";
$route['admin/edit-tips/:any'] = "admin_interface/edit_tips";
$route['admin/delete-tips/:any'] = "admin_interface/delete_tips";
$route['admin/save-tips/:any'] = "admin_interface/save_tips";
$route['admin/edit-whomain/:any'] = "admin_interface/edit_whomain";
$route['admin/edit-coordinator/:any'] = "admin_interface/edit_coordinator";
$route['admin/product-unit-dalete/:any'] = "admin_interface/product_unit_dalete";
$route['admin/product-unit-info/:any'] = "admin_interface/product_unit_info";
$route['admin/offer-list/:any'] = "admin_interface/offer_list";

$route['admin/edit-pricing/:any'] = "admin_interface/edit_pricing";
$route['admin/edit-season/:any'] = "admin_interface/edit_season";

$route['admin-listbox/product-unit-list/:any'] = "admin_interface/product_unit_load";
$route['admin-listbox/product-unit-form/:any'] = "admin_interface/product_form_load";

$route['admin/information-list/:any/users/admins'] = "admin_interface/information_list";
$route['admin/information-list/:any/users/federals'] = "admin_interface/information_list";
$route['admin/information-list/:any/users/regionals'] = "admin_interface/information_list";
$route['admin/information-list/:any/users/representatives'] = "admin_interface/information_list";
$route['admin/information-list/:any/:any'] = "admin_interface/information_list";

$route['admin/registration/:any/:any'] = "admin_interface/registration_users";
$route['admin/cabinet/:any'] = "admin_interface/cabinet";
$route['admin/shutdown/:any'] = "admin_interface/shutdown";

$route['admin/form-job/:any'] = "admin_interface/view_formjob";
$route['admin/form-prnposition/:any'] = "admin_interface/view_prnposition";

$route['admin/save-group/:any']= "admin_interface/save_group";
$route['admin/delete-group/:any']= "admin_interface/dalete_group";

$route['admin/delete-company/:any']= "admin_interface/delete_company";
$route['admin/restore-company/:any']= "admin_interface/restore_company";

$route['admin/save-dealer/:any']= "admin_interface/save_dealer";
$route['admin/delete-dealer/:any']= "admin_interface/dalete_dealer";
$route['admin/activate-dealer/:any']= "admin_interface/activate_dealer";
$route['admin/dealers-regions/:any']= "admin_interface/dealers_regions";
$route['admin/dealers-company/:any']= "admin_interface/dealers_company";

$route['admin/activity-company/:any']= "admin_interface/activity_company";

$route['admin/save-region/:any']= "admin_interface/save_region";
$route['admin/save-activity/:any']= "admin_interface/save_activity";
$route['admin/save-department/:any']= "admin_interface/save_department";
$route['admin/save-user/:any']= "admin_interface/save_user";
$route['admin/delete-user/:any']= "admin_interface/dalete_user";
$route['admin/activate-user/:any']= "admin_interface/activate_user";
$route['admin/save-company/:any']= "admin_interface/save_company";
$route['admin/save-profile/:any']= "admin_interface/save_profile";
$route['admin/delete-message/:any']= "admin_interface/delete_message";

/************************************	COMPANY INTRERFACE	***********************************************/

$route['company/control-panel/:any'] = "company_interface/cpanel";
$route['company/cabinet/:any'] = "company_interface/profile";
$route['company/representatives/:any'] = "company_interface/management";
$route['company/save-profile/:any'] = "company_interface/save_profile";
$route['company/delete-representatives/:any'] = "company_interface/delele_representatives";

$route['representative/cabinet/:any'] = "company_interface/representative_cabinet";
$route['representative/save-profile/:any'] = "company_interface/representative_save_profile";
/* ------------------------------------------ business-environment --------------------------------------------*/

$route['company/full-business-environment/:any'] = "company_interface/business";
$route['company/private-business-environment/:any'] = "company_interface/business";

	/*============================================= discussion ============================================*/

$route['business-environment/discussions/:any/section/:num'] = "company_interface/discussions";
$route['business-environment/discussions/:any/section/:num/count/:num'] = "company_interface/discussions";
$route['business-environment/discussions/:any/create-discussion'] = "company_interface/create_discussion";

$route['business-environment/discussions/:any/create-section'] = "company_interface/create_section";

$route['business-environment/discussions/:any/discussion/:num'] = "company_interface/read_discussion";
$route['business-environment/discussions/:any/discussion/:num/comments/count'] = "company_interface/read_discussion";
$route['business-environment/discussions/:any/discussion/:num/comments/count/:num'] = "company_interface/read_discussion";

$route['business-environment/discussions/:any/discussion/:num/delete-comment/:num'] = "company_interface/delete_comment";

$route['business-environment/discussions/:any/edit-discussion/:num'] = "company_interface/edit_discussion";
$route['business-environment/discussions/:any/share-discussion/:num'] = "company_interface/share_discussion";
$route['business-environment/discussions/:any/delete-discussion/:num'] = "company_interface/delete_discussion";

$route['business-environment/discussions/:any'] = "company_interface/discussions";

	/*============================================= question_answer ============================================*/
$route['business-environment/question-answer/:any/section/:num'] = "company_interface/question_answer";
$route['business-environment/question-answer/:any/section/:num/count/:num'] = "company_interface/question_answer";

$route['business-environment/question-answer/:any/create-section'] = "company_interface/create_section";
$route['business-environment/question-answer/:any/create-question'] = "company_interface/create_question";

$route['business-environment/question-answer/:any/edit-question/:num'] = "company_interface/edit_question";
$route['business-environment/question-answer/:any/share-question/:num'] = "company_interface/share_question";
$route['business-environment/question-answer/:any/delete-question/:num'] = "company_interface/delete_question";

$route['business-environment/question-answer/:any/question/:num/answers'] = "company_interface/read_question";
$route['business-environment/question-answer/:any/question/:num/answers/count'] = "company_interface/read_question";
$route['business-environment/question-answer/:any/question/:num/answers/count/:num'] = "company_interface/read_question";

$route['business-environment/question-answer/:any/question/:num/delete-answer/:num'] = "company_interface/delete_comment";

$route['business-environment/question-answer/:any'] = "company_interface/question_answer";

	/*============================================= interaction ============================================*/

$route['business-environment/interactions/:any/section/:num'] = "company_interface/interactions";
$route['business-environment/interactions/:any/section/:num/count/:num'] = "company_interface/interactions";

$route['business-environment/interactions/:any/create-section'] = "company_interface/create_section";

$route['business-environment/interactions/:any/create-interaction'] = "company_interface/create_interaction";

$route['business-environment/interactions/:any/interaction/:num'] = "company_interface/read_interaction";
$route['business-environment/interactions/:any/interaction/:num/comments/count'] = "company_interface/read_interaction";
$route['business-environment/interactions/:any/interaction/:num/comments/count/:num'] = "company_interface/read_interaction";

$route['business-environment/interactions/:any/interaction/:num/delete-comment/:num'] = "company_interface/delete_comment";

$route['business-environment/interactions/:any/edit-interaction/:num'] = "company_interface/edit_interaction";
$route['business-environment/interactions/:any/share-interaction/:num'] = "company_interface/share_interaction";
$route['business-environment/interactions/:any/delete-interaction/:num'] = "company_interface/delete_interaction";

$route['business-environment/interactions/:any'] = "company_interface/interactions";
	
	/*============================================= articles ============================================*/

$route['business-environment/articles/:any/create-section'] = "company_interface/create_section";
$route['business-environment/articles/:any/create-article'] = "company_interface/create_article";

$route['business-environment/articles/:any/section/:num'] = "company_interface/articles";
$route['business-environment/articles/:any/section/:num/count/:num'] = "company_interface/articles";
$route['business-environment/articles/:any/section/:num/sort-date'] = "company_interface/articles";
$route['business-environment/articles/:any/section/:num/count/:num/sort-date'] = "company_interface/articles";
$route['business-environment/articles/:any/section/:num/sort-views'] = "company_interface/articles";
$route['business-environment/articles/:any/section/:num/count/:num/sort-views'] = "company_interface/articles";

$route['business-environment/articles/:any/article/:num'] = "company_interface/read_article";

$route['business-environment/articles/:any/edit-article/:num'] = "company_interface/edit_article";
$route['business-environment/articles/:any/share-article/:num'] = "company_interface/share_article";
$route['business-environment/articles/:any/delete-article/:num'] = "company_interface/delete_article";

$route['business-environment/articles/:any/article/:num/comments'] = "company_interface/read_article";
$route['business-environment/articles/:any/article/:num/comments/count'] = "company_interface/read_article";
$route['business-environment/articles/:any/article/:num/comments/count/:num'] = "company_interface/read_article";

$route['business-environment/articles/:any/article/:num/delete-comment/:num'] = "company_interface/delete_comment";	
	
$route['business-environment/articles/:any'] = "company_interface/articles";
	
	/*============================================= documentation ============================================*/

$route['business-environment/documentation/:any/section/:num'] = "company_interface/documentation";
$route['business-environment/documentation/:any/section/:num/count/:num'] = "company_interface/documentation";
$route['business-environment/documentation/:any/create-section'] = "company_interface/create_section";
$route['business-environment/documentation/:any/create-query'] = "company_interface/create_docquery";

$route['business-environment/documentation/:any/document-query/:num/upload-document'] = "company_interface/upload_document";

$route['business-environment/documentation/:any/document-query/:num/documents-list'] = "company_interface/read_documents_list";
$route['business-environment/documentation/:any/document-query/:num/documents-list/count'] = "company_interface/read_documents_list";
$route['business-environment/documentation/:any/document-query/:num/documents-list/count/:num'] = "company_interface/read_documents_list";

$route['business-environment/documentation/:any/document-query/:num/comments'] = "company_interface/read_query";
$route['business-environment/documentation/:any/document-query/:num/comments/count'] = "company_interface/read_query";
$route['business-environment/documentation/:any/document-query/:num/comments/count/:num'] = "company_interface/read_query";

$route['business-environment/documentation/:any/document-query/:num/document/:num/comments'] = "company_interface/read_doc_comments";
$route['business-environment/documentation/:any/document-query/:num/document/:num/comments/count'] = "company_interface/read_doc_comments";
$route['business-environment/documentation/:any/document-query/:num/document/:num/comments/count/:num'] = "company_interface/read_doc_comments";

$route['business-environment/documentation/:any/document-query/:num/document/:num/delete-comment/:num'] = "company_interface/doc_del_comments";

$route['business-environment/documentation/:any/document-query/:num/delete-comment/:num'] = "company_interface/delete_comment";
 
$route['business-environment/documentation/:any/document-query/:num/edit-doc-info/:num'] = "company_interface/edit_doc_info";
$route['business-environment/documentation/:any/document-query/:num/delete-doc-info/:num'] = "company_interface/delete_doc_info";

$route['business-environment/documentation/:any/edit-query/:num'] = "company_interface/edit_query";
$route['business-environment/documentation/:any/share-query/:num'] = "company_interface/share_query";
$route['business-environment/documentation/:any/delete-query/:num'] = "company_interface/delete_query";

$route['business-environment/documentation/:any'] = "company_interface/documentation";
	
	/*============================================= surveys ============================================*/

$route['views/survey-list/:any'] = "company_interface/survey_list";
$route['business-environment/surveys/:any/save-vote'] = "company_interface/save_vote";

$route['business-environment/surveys/:any/section/:num'] = "company_interface/surveys";
$route['business-environment/surveys/:any/section/:num/count/:num'] = "company_interface/surveys";
$route['business-environment/surveys/:any/create-section'] = "company_interface/create_section";
$route['business-environment/surveys/:any/create-survey'] = "company_interface/create_survey";

$route['business-environment/surveys/:any/survey/:num'] = "company_interface/read_survey";
$route['business-environment/surveys/:any/survey/:num/comments/count'] = "company_interface/read_survey";
$route['business-environment/surveys/:any/survey/:num/comments/count/:num'] = "company_interface/read_survey";

$route['business-environment/surveys/:any/survey/:num/delete-comment/:num'] = "company_interface/delete_comment";

$route['business-environment/surveys/:any/edit-survey/:num'] = "company_interface/edit_survey";
$route['business-environment/surveys/:any/share-survey/:num'] = "company_interface/share_survey";
$route['business-environment/surveys/:any/delete-survey/:num'] = "company_interface/delete_survey";

$route['business-environment/surveys/:any'] = "company_interface/surveys";

	/*============================================= association ============================================*/

$route['business-environment/associations/:any/section/:num'] = "company_interface/association";
$route['business-environment/associations/:any/section/:num/count/:num'] = "company_interface/association";
$route['business-environment/associations/:any/create-section'] = "company_interface/create_section";
$route['business-environment/associations/:any/create-association'] = "company_interface/create_association";

$route['business-environment/associations/:any/association/:num'] = "company_interface/read_association";

$route['business-environment/associations/:any/association/:num/company'] = "company_interface/collected_company";
$route['business-environment/associations/:any/association/:num/company/count'] = "company_interface/collected_company";
$route['business-environment/associations/:any/association/:num/company/count/:num'] = "company_interface/collected_company";
$route['business-environment/associations/:any/association/:num/delete-company/:num'] = "company_interface/collected_delete_company";

$route['business-environment/associations/:any/association/:num/comments'] = "company_interface/read_association";
$route['business-environment/associations/:any/association/:num/comments/count'] = "company_interface/read_association";
$route['business-environment/associations/:any/association/:num/comments/count/:num'] = "company_interface/read_association";

$route['business-environment/associations/:any/association/:num/delete-comment/:num'] = "company_interface/delete_comment";

$route['business-environment/associations/:any/edit-association/:num'] = "company_interface/edit_association";
$route['business-environment/associations/:any/share-association/:num'] = "company_interface/share_association";
$route['business-environment/associations/:any/delete-association/:num'] = "company_interface/delete_association";

$route['business-environment/associations/:any'] = "company_interface/association";

	/*=============================================== offers ==============================================*/

$route['business-environment/offers/:any/region/:num'] = "company_interface/offers_setregion";

$route['business-environment/offers/:any/offer/:num'] = "company_interface/read_offer";
$route['business-environment/offers/:any/offer/:num/comments'] = "company_interface/read_offer";
$route['business-environment/offers/:any/offer/:num/comments/count'] = "company_interface/read_offer";
$route['business-environment/offers/:any/offer/:num/comments/count/:num'] = "company_interface/read_offer";

$route['business-environment/offers/:any/count'] = "company_interface/offers";
$route['business-environment/offers/:any/count/:num'] = "company_interface/offers";

$route['business-environment/offers/:any/edit-offer/:num'] = "company_interface/edit_offer";
$route['business-environment/offers/:any/delete-offer/:num'] = "company_interface/delete_offer";

$route['business-environment/offers/:any/offer/:num/delete-comment/:num'] = "company_interface/delete_comment";

$route['business-environment/offers/:any'] = "company_interface/offers";

	/*================================================= news ==============================================*/

$route['business-environment/activity-news/:any/news/:num/delete-comment/:num'] = "company_interface/delete_comment";
$route['business-environment/company-news/:any/news/:num/delete-comment/:num'] = "company_interface/delete_comment";

$route['business-environment/company-news/:any/count/:num'] = "company_interface/news";
$route['business-environment/company-news/:any/sort-date'] = "company_interface/news";
$route['business-environment/company-news/:any/sort-views'] = "company_interface/news";

$route['business-environment/activity-news/:any/create-news'] = "company_interface/create_news";	

$route['business-environment/activity-news/:any/news/:num'] = "company_interface/read_news";
$route['business-environment/company-news/:any/news/:num'] = "company_interface/read_news";

$route['business-environment/activity-news/:any/news/:num/comments'] = "company_interface/read_news";
$route['business-environment/activity-news/:any/news/:num/comments/count'] = "company_interface/read_news";
$route['business-environment/activity-news/:any/news/:num/comments/count/:num'] = "company_interface/read_news";

$route['business-environment/company-news/:any/news/:num/comments'] = "company_interface/read_news";
$route['business-environment/company-news/:any/news/:num/comments/count'] = "company_interface/read_news";
$route['business-environment/company-news/:any/news/:num/comments/count/:num'] = "company_interface/read_news";

$route['business-environment/activity-news/:any/edit-news/:num'] = "company_interface/edit_news";
$route['business-environment/activity-news/:any/share-news/:num'] = "company_interface/share_news";
$route['business-environment/activity-news/:any/delete-news/:num'] = "company_interface/delete_news";

$route['business-environment/company-news/:any/edit-news/:num'] = "company_interface/edit_news";
$route['business-environment/company-news/:any/share-news/:num'] = "company_interface/share_news";
$route['business-environment/company-news/:any/delete-news/:num'] = "company_interface/delete_news";

$route['business-environment/activity-news/:any/count/:num'] = "company_interface/news";
$route['business-environment/activity-news/:any/sort-date'] = "company_interface/news";
$route['business-environment/activity-news/:any/sort-views'] = "company_interface/news";

$route['business-environment/company-news/:any'] = "company_interface/news";
$route['business-environment/activity-news/:any'] = "company_interface/news";

$route['business-environment/news/:any'] = "company_interface/news";

	/*============================================== discounts ==============================================*/

$route['business-environment/company-discounts/:any/count/:num'] = "company_interface/discounts";
$route['business-environment/company-discounts/:any/sort-date'] = "company_interface/discounts";
$route['business-environment/company-discounts/:any/sort-views'] = "company_interface/discounts";

$route['business-environment/activity-discounts/:any/create-discount'] = "company_interface/create_discount";	

$route['business-environment/activity-discounts/:any/discount/:num'] = "company_interface/read_discount";
$route['business-environment/company-discounts/:any/discount/:num'] = "company_interface/read_discount";

$route['business-environment/activity-discounts/:any/discount/:num/comments'] = "company_interface/read_discount";
$route['business-environment/activity-discounts/:any/discount/:num/comments/count'] = "company_interface/read_discount";
$route['business-environment/activity-discounts/:any/discount/:num/comments/count/:num'] = "company_interface/read_discount";

$route['business-environment/company-discounts/:any/discount/:num/comments'] = "company_interface/read_discount";
$route['business-environment/company-discounts/:any/discount/:num/comments/count'] = "company_interface/read_discount";
$route['business-environment/company-discounts/:any/discount/:num/comments/count/:num'] = "company_interface/read_discount";

$route['business-environment/activity-discounts/:any/edit-discount/:num'] = "company_interface/edit_discount";
$route['business-environment/activity-discounts/:any/delete-discount/:num'] = "company_interface/delete_discount";

$route['business-environment/company-discounts/:any/edit-discount/:num'] = "company_interface/edit_discount";
$route['business-environment/company-discounts/:any/delete-discount/:num'] = "company_interface/delete_discount";

$route['business-environment/activity-discounts/:any/discount/:num/delete-comment/:num'] = "company_interface/delete_comment";
$route['business-environment/company-discounts/:any/discount/:num/delete-comment/:num'] = "company_interface/delete_comment";

$route['business-environment/activity-discounts/:any/count/:num'] = "company_interface/discounts";
$route['business-environment/activity-discounts/:any/sort-date'] = "company_interface/discounts";
$route['business-environment/activity-discounts/:any/sort-views'] = "company_interface/discounts";

$route['business-environment/company-discounts/:any'] = "company_interface/discounts";
$route['business-environment/activity-discounts/:any'] = "company_interface/discounts";

$route['business-environment/discounts/:any'] = "company_interface/discounts";

	/*============================================== who-main ==============================================*/

$route['business-environment/who-main/:any/region/:num'] = "company_interface/whomain_setregion";

$route['business-environment/who-main/:any'] = "company_interface/who_main";

/*============================================= rating ============================================*/

$route['business-environment/rating-representatives/:any'] = "company_interface/rating";
$route['business-environment/rating-company/:any'] = "company_interface/rating";
$route['business-environment/rating/:any'] = "company_interface/rating";

/* ------------------------------------------ view/add/edit ----------------------------------------------------*/
$route['company/news-management/:any'] = "company_interface/news_management";
$route['company/news-save/:any'] = "company_interface/news_save";
$route['company/news-delete/:any'] = "company_interface/news_delete";
$route['company/news-extend-day/:any'] = "company_interface/news_extend_day";

$route['company/shares-management/:any'] = "company_interface/shares_management";
$route['company/shares-save/:any'] = "company_interface/shares_save";
$route['company/shares-delete/:any'] = "company_interface/shares_delete";
$route['company/shares-extend-day/:any'] = "company_interface/shares_extend_day";
$route['company/price-management/:any'] = "company_interface/price_management";

$route['listbox/group-unit-list/:any'] = "company_interface/group_unit_load";
$route['listbox/product-cmpunit-list/:any'] = "company_interface/group_cmpunit_load";
$route['company/product-cmpunit-form/:any'] = "company_interface/product_cmpunit_form";
$route['company/product-unit-dalete/:any'] = "company_interface/product_unit_dalete";
$route['company/products-unit-info/:any'] = "company_interface/products_unit_info";