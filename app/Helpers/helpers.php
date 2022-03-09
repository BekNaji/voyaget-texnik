<?php 


function getStatusText($text)
{
    switch ($text) {
        case 'passed':
            $newText = __('general.test_passed');
            break;
        case 'failed':
            $newText = __('general.test_failed');
            break;
        case 'wait_payment':
            $newText = __('general.waiting_payment');
            break;
        case 'paid':
            $newText = __('general.paid');
            break;
        case 'sent_to_master':
            $newText = __('general.send_to_master');
            break;
        case 'cancelled':
            $newText = __('general.cancelled');
            break;
        default:
            $newText = $text;
    }
    return $newText;
}

function getStatusColor($text)
{
    switch ($text) {
        case 'passed':
            $newText = 'bg-success';
            break;
        case 'failed':
            $newText = 'bg-danger';
            break;
        case 'wait_payment':
            $newText = 'bg-warning';
            break;
        case 'paid':
            $newText = 'bg-info';
            break;
        case 'sent_to_master':
            $newText = 'bg-primary';
            break;
        case 'cancelled':
            $newText = 'bg-secondary';
            break;
        default:
            $newText = '';
    }
    return $newText;
}