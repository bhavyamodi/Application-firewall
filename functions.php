<?php
header('Content-Type: text/html; charset=utf-8');
include "config.php";
include "webservices.php";
require_once("../notification/Firebase.php");


if(isset($_REQUEST['action']))
{
    switch($_REQUEST['action'])
    {
        case 'lawyer_registration': //1
            lawyer_registration($conn);
        break;

        case 'client_registration': //2
            client_registration($conn);
        break;

        case 'lawyer_login': //3
            lawyer_login($conn);
        break;

        case 'lawyer_get': //4
            lawyer_get($conn);
        break;

        case 'lawyer_update': //5
            lawyer_update($conn);
        break;

        case 'lawyer_forget_password': //6
            lawyer_forget_password($conn);
        break;

        case 'lawyer_verify_otp': //7
            lawyer_verify_otp($conn);
        break;

        case 'client_case_get_by_id': //8
            client_case_get_by_id($conn);
        break;

        case 'client_case_get_by_status': //9
            client_case_get_by_status($conn);
        break;

        case 'client_login': //10
            client_login($conn);
        break;

        case 'client_update': //11
            client_update($conn);
        break;

        case 'client_forget_password': //12
            client_forget_password($conn);
        break;

        case 'client_verify_otp': //13
            client_verify_otp($conn);
        break;

        case 'request_client': //14
            request_client($conn);
        break;

        case 'request_lawyer': //15
            request_lawyer($conn);
        break;

        case 'insert_request': //16
            insert_request($conn);
        break;

        case 'id_request': //17 incomplete
            id_request($conn);
        break;

        case 'request_accept_or_decline': //18 (client accept or decline)
            request_accept_or_decline($conn);
        break;

        case 'chat_insert': //19
            chat_insert($conn);
        break;

        case 'chat_get': //20
            chat_get($conn);
        break;

        case 'jurisdiction_get': //21
            jurisdiction_get($conn);
        break;

        case 'update_client_profile_photo': //22
            update_client_profile_photo($conn);
        break;

        case 'update_lawyer_profile_photo': //23
            update_lawyer_profile_photo($conn);
        break;

        case 'client_delete_request_by_lawyer': //24
            client_delete_request_by_lawyer($conn);
        break;

        case 'lawyer_my_case': //25
            lawyer_my_case($conn);
        break;

        case 'client_my_case': //26
            client_my_case($conn);
        break;

        case 'lawyer_change_Password': //27
            lawyer_change_Password($conn);
        break;

        case 'client_change_Password': //28
            client_change_Password($conn);
        break;

         case 'upload_new_case': //29
            upload_new_case($conn);
        break;

         case 'lawyer_notification_list': //30
            lawyer_notification_list($conn);
        break;

        case 'client_notification_list': //31
            client_notification_list($conn);
        break;

        case 'closed_case_by_client': //32
            closed_case_by_client($conn);
        break;

        case 'lawyer_token_update': //33
            lawyer_token_update($conn);
        break;

        case 'client_token_update': //34
            client_token_update($conn);
        break;

        case 'specialization_get': //35
            specialization_get($conn);
        break;

        case 'update_lawyer_and_client_notification_list': //36
            update_lawyer_and_client_notification_list($conn);
        break;

        case 'get_last_chat': //37
            get_last_chat($conn);
        break;

        case 'lawyer_reset_password': //38
            lawyer_reset_password($conn);
        break;

        case 'client_reset_password': //39
            client_reset_password($conn);
        break;

        case 'delete_chat': //40
            delete_chat($conn);
        break;

        case 'lawyer_chat_list': //41
            lawyer_chat_list($conn);
        break;

        case 'client_chat_list': //42
            client_chat_list($conn);
        break;
        
        case 'chat_with_users_list': //43
            chat_with_users_list($conn);
        break;
        
        case 'update_chat_unread_status': //44
            update_chat_unread_status($conn);
        break;
        
        case 'delete_user_chat': //45
            delete_user_chat($conn);
        break;

        case 'get_package': //46
            get_package($conn);
        break;
        
        case 'delete_notification': //46
            delete_notification($conn);
        break;
        
        case 'delete_case': //46
            delete_case($conn);
        break;
        
        case 'edit_case':
            edit_case($conn);
        break;

        case 'subscription':
            subscription($conn);
        break;
        
        case 'update_subscription_status':
            update_subscription_status($conn);
        break;
        
        case 'archiveUnarchive':
            archiveUnarchive($conn);
        break;
        
        case 'choose_lawyer':
            choose_lawyer($conn);
        break;
        
        case 'applied_lawyer_list':
            applied_lawyer_list($conn);
        break;
        
        case 'lawyer_applied_onwhich_cases_list':
            lawyer_applied_onwhich_cases_list($conn);
        break;
    }
}

?>