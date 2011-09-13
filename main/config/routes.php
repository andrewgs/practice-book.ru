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
$route['dilers'] = "users_interface/dilers";

/* --------------------------------------------- started work ---------------------------------------------*/
$route['started'] = "users_interface/select_settings";
$route['users/select-region'] = "users_interface/create_select_region";
$route['users/select-activity'] = "users_interface/create_select_activity";
$route['users/search-activity'] = "users_interface/create_search_activity";
$route['users/search-region'] = "users_interface/create_search_region";
$route['activity-information/region/:num/activity/:num'] = "users_interface/activity_information";
$route['activity-information/region/:num/activity/:num/product/:num'] = "users_interface/activity_information";
$route['announce-tender/region/:num/activity/:num'] = "users_interface/announce_tender";
$route['manager-list/region/:num/activity/:num'] = "users_interface/manager_list";
$route['product-unit/region/:num/activity/:num'] = "users_interface/product_unit_load";
$route['product-info/region/:num/activity/:num'] = "users_interface/product_unit_info";
$route['offer-list/region/:num'] = "users_interface/offer_list";
$route['consultation/manager/:num'] = "users_interface/consultation_list";
/* ----------------------------------------------- company ------------------------------------------------*/

$route['company-info/:num'] = "users_interface/company_info";
$route['representatives/company/:num'] = "users_interface/representatives_list";
$route['company/products-group-list'] = "users_interface/products_unit_info";

/* ----------------------------------------	registering company -------------------------------------------*/
$route['registering/step-1'] = "users_interface/newcompany1";
$route['registering/step-2'] = "users_interface/newcompany2";
$route['registering/step-3'] = "users_interface/newcompany3";
$route['registering/step-4'] = "users_interface/newcompany4";

/* ------------------------------------------	activation -----------------------------------------------*/
$route['activation/([a-zA-Z0-9])*'] = "users_interface/activation";

/* ----------------------------------- authorization/shutdown ---------------------------------------------*/
$route['authorization'] = "users_interface/authorization";
$route['shutdown'] = "users_interface/shutdown";
$route['admin']	= "users_interface/admin_login";
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
$route['prsavatar/viewimage/:num'] = "users_interface/viewimage";
$route['docavatar/viewimage/:num'] = "users_interface/viewimage";
$route['specials/viewimage/:num'] = "users_interface/viewimage";
$route['puravatar/viewimage/:num'] = "users_interface/viewimage";
$route['curavatar/viewimage/:num'] = "users_interface/viewimage";
$route['shares/viewimage/:num'] = "users_interface/viewimage";

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
$route['manager/control-panel/:any'] = "manager_interface/cpanel";
$route['manager/set-cpanel/:any'] = "manager_interface/set_cpanel";
$route['manager/cabinet/:any'] = "manager_interface/profile";
$route['manager/add-job/:any'] = "manager_interface/insert_job";
$route['views/job-list/:any'] = "manager_interface/views";
$route['manager/delete-job/:any'] = "manager_interface/delete_job";
$route['manager/registration/:any'] = "manager_interface/register";
$route['manager/save-profile/:any'] = "manager_interface/save_profile";
$route['views/form-job/:any'] = "manager_interface/views";
$route['views/manager-list/:any'] = "manager_interface/views";
$route['manager/set-manager-region/:any'] = "manager_interface/set_manager_on_region";
$route['manager/manager-list/:any'] = "manager_interface/manager_list";

$route['listbox/product-unit-list/:any'] = "manager_interface/product_unit_load";
$route['listbox/product-unit-form/:any'] = "manager_interface/product_form_load";

$route['manager/edit-product/:any'] = "manager_interface/edit_product";
$route['manager/edit-pitfalls/:any'] = "manager_interface/edit_pitfalls";
$route['manager/delete-pitfalls/:any'] = "manager_interface/delete_pitfalls";
$route['manager/save-pitfalls/:any'] = "manager_interface/save_pitfalls";
$route['manager/edit-questions/:any'] = "manager_interface/edit_questions";
$route['manager/delete-question/:any'] = "manager_interface/delete_question";
$route['manager/save-question/:any'] = "manager_interface/save_question";
$route['manager/edit-news/:any'] = "manager_interface/edit_news";
$route['manager/delete-news/:any'] = "manager_interface/delete_news";
$route['manager/save-news/:any'] = "manager_interface/save_news";
$route['manager/edit-persona/:any'] = "manager_interface/edit_persona";
$route['manager/edit-documents/:any'] = "manager_interface/edit_documents";
$route['manager/delete-document/:any'] = "manager_interface/delete_document";
$route['manager/save-document/:any'] = "manager_interface/save_document";
$route['manager/edit-specials/:any'] = "manager_interface/edit_specials";
$route['manager/delete-specials/:any'] = "manager_interface/delete_specials";
$route['manager/save-specials/:any'] = "manager_interface/save_specials";
$route['manager/edit-tips/:any'] = "manager_interface/edit_tips";
$route['manager/delete-tips/:any'] = "manager_interface/delete_tips";
$route['manager/save-tips/:any'] = "manager_interface/save_tips";
$route['manager/edit-whomain/:any'] = "manager_interface/edit_whomain";
$route['manager/edit-coordinator/:any'] = "manager_interface/edit_coordinator";
$route['manager/product-unit-dalete/:any'] = "manager_interface/product_unit_dalete";
$route['manager/product-unit-info/:any'] = "manager_interface/product_unit_info";
$route['manager/offer-list/:any'] = "manager_interface/offer_list";
$route['manager/consultation/:any'] = "manager_interface/consultation";
$route['manager/delete-consultation/:any'] = "manager_interface/delete_consultation";
$route['manager/save-consultation/:any'] = "manager_interface/save_consultation";
$route['manager/close-consultation/:any'] = "manager_interface/close_consultation";

/************************************	ADMIN INTRERFACE	***********************************************/

$route['admin/control-panel/:any'] = "admin_interface/cpanel";

$route['admin/edit-activity/:any/region/:num/activity/:num'] = "admin_interface/edit_activity";
$route['admin/edit-activity/:any'] = "admin_interface/edit_activity";
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

$route['admin/save-group/:any']= "admin_interface/save_group";
$route['admin/delete-group/:any']= "admin_interface/dalete_group";

$route['admin/save-region/:any']= "admin_interface/save_region";
$route['admin/save-activity/:any']= "admin_interface/save_activity";
$route['admin/save-department/:any']= "admin_interface/save_department";
$route['admin/save-user/:any']= "admin_interface/save_user";
$route['admin/delete-user/:any']= "admin_interface/dalete_user";
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

$route['business-environment/discussions/:any/section/:num'] = "company_interface/discussions";
$route['business-environment/discussions/:any/section/:num/count/:num'] = "company_interface/discussions";
$route['business-environment/discussions/:any/create-section'] = "company_interface/discussions_create_section";
$route['business-environment/discussions/:any/create-discussion'] = "company_interface/discussions_create_discussion";
$route['business-environment/discussions/:any/discussion/:num'] = "company_interface/read_discussion";

$route['business-environment/discussions/:any/discussion/:num/comment'] = "company_interface/add_comment";
$route['business-environment/discussions/:any/discussion/:num/comments/count'] = "company_interface/read_discussion";
$route['business-environment/discussions/:any/discussion/:num/comments/count/:num'] = "company_interface/read_discussion";

$route['business-environment/discussions/:any/discussion/:num/edit-comment/:num'] = "company_interface/edit_comment";
$route['business-environment/discussions/:any/discussion/:num/delete-comment/:num'] = "company_interface/delete_comment";

$route['business-environment/discussions/:any/edit-discussion/:num'] = "company_interface/edit_discussion";
$route['business-environment/discussions/:any/track-discussion/:num'] = "company_interface/track_discussion";
$route['business-environment/discussions/:any/share-discussion/:num'] = "company_interface/share_discussion";
$route['business-environment/discussions/:any/delete-discussion/:num'] = "company_interface/delete_discussion";

$route['business-environment/discussions/:any'] = "company_interface/discussions";


$route['business-environment/question-answer/:any/section/:num'] = "company_interface/question_answer";
$route['business-environment/question-answer/:any/section/:num/count/:num'] = "company_interface/question_answer";

$route['business-environment/question-answer/:any/create-section'] = "company_interface/question_create_section";
$route['business-environment/question-answer/:any/create-question'] = "company_interface/question_create_question";

$route['business-environment/question-answer/:any/question/:num/answer'] = "company_interface/add_answer";

$route['business-environment/question-answer/:any/edit-question/:num'] = "company_interface/edit_question";
$route['business-environment/question-answer/:any/track-question/:num'] = "company_interface/track_question";
$route['business-environment/question-answer/:any/share-question/:num'] = "company_interface/share_question";
$route['business-environment/question-answer/:any/delete-question/:num'] = "company_interface/delete_question";

$route['business-environment/question-answer/:any/question/:num/answer'] = "company_interface/add_comment";

$route['business-environment/question-answer/:any/question/:num/answers'] = "company_interface/read_question";
$route['business-environment/question-answer/:any/question/:num/answers/count'] = "company_interface/read_question";
$route['business-environment/question-answer/:any/question/:num/answers/count/:num'] = "company_interface/read_question";

$route['business-environment/question-answer/:any/question/:num/edit-answer/:num'] = "company_interface/edit_answer";
$route['business-environment/question-answer/:any/question/:num/delete-answer/:num'] = "company_interface/delete_answer";

$route['business-environment/question-answer/:any'] = "company_interface/question_answer";


$route['business-environment/rating/:any'] = "company_interface/rating";
$route['business-environment/articles/:any'] = "company_interface/articles";
$route['business-environment/documentation/:any'] = "company_interface/documentation";
$route['business-environment/survey/:any'] = "company_interface/survey";
$route['business-environment/association/:any'] = "company_interface/association";
$route['business-environment/offers/:any'] = "company_interface/offers";
$route['business-environment/news/:any'] = "company_interface/news";
$route['business-environment/discounts/:any'] = "company_interface/discounts";
$route['business-environment/who-main/:any'] = "company_interface/who_main";

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