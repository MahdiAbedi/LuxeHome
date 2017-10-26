<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
##***************************{{deal_type_en_to_fa}}*****************************##
if ( ! function_exists('deal_type_en_to_fa'))
{
    function deal_type_en_to_fa($deal_name = 'sell')
    {
    switch ($deal_name)
        {
        case 'sell':
            return 'فروش';
            break;
        
        case 'other':
            return 'متفرقه';
            break;
        
        default:
            return 'رهن و اجاره';
            break;
        }
        //return $var;
    }   
}
##***************************{{SEARCH RESULT PAGE}}*****************************##
if ( ! function_exists('home_type_en_to_fa'))
{
    function home_type_en_to_fa($deal_name = 'sell')
    {
    switch ($deal_name)
        {
        case 'flat':
            return 'آپارتمان';
            break;
        
        case 'home':
            return 'خانه و ویلا';
            break;
         case 'land':
            return 'زمین و گلنگی';
            break;
         case 'office':
            return 'اداری';
            break; 
        case 'shop':
            return 'مغازه';
            break; 
        case 'farm':
            return 'صنعتی';
            break;
        case 'vila':
            return 'ویلا';
            break;
        case 'other':
            return 'متفرقه';
            break; 
        }
        //return $var;
    }   
}