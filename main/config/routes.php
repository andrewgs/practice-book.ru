<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "users_interface";
$route['404_override'] = '';


/***********************************	USERS INTRERFACE	***********************************************/

/* ----------------------------------------	users menu	--------------------------------------------------*/
$route[''] = "users_interface/index";
$route['ideas'] = "users_interface/ideas";
$route['job'] = "users_interface/job";
$route['about'] = "users_interface/about_project";
$route['contacts'] = "users_interface/contacts";
$route['conditions-cooperation'] = "users_interface/cooperation";

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

/* ------------------------------------------ other -------------------------------------------------------*/
$route['script_error'] = "users_interface/showerror";

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
/************************************	ADMIN INTRERFACE	***********************************************/

$route['admin/control-panel/:any'] = "admin_interface/cpanel";

$route['admin/page-content/:any/:any'] = "admin_interface/page_content";
$route['admin/activity-content/:any/:any'] = "admin_interface/activity_content";
$route['admin/information-list/:any/:any'] = "admin_interface/information_list";
$route['admin/registration/:any/:any'] = "admin_interface/registration_users";
$route['admin/cabinet/:any'] = "admin_interface/cabinet";

/************************************	COMPANY INTRERFACE	***********************************************/

$route['company/control-panel/:any'] = "company_interface/cpanel";
$route['company/cabinet/:any'] = "company_interface/profile";
$route['company/representatives/:any'] = "company_interface/management";
$route['company/save-profile/:any'] = "company_interface/save_profile";
$route['company/delete-representatives/:any'] = "company_interface/delele_representatives";
/* ------------------------------------------ view/add/edit ----------------------------------------------------*/
$route['company/news-management/:any'] = "company_interface/news_management";
$route['company/news-save/:any'] = "company_interface/news_save";
$route['company/news-delete/:any'] = "company_interface/news_delete";
$route['company/news-extend-day/:any'] = "company_interface/news_extend_day";

$route['company/shares-management/:any'] = "company_interface/shares_management";
$route['company/shares-save/:any'] = "company_interface/shares_save";
$route['company/shares-delete/:any'] = "company_interface/shares_delete";
$route['company/shares-extend-day/:any'] = "company_interface/shares_extend_day";
