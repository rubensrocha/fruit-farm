<?php

$lang = [
    'langSelect' => 'Languages',
    'title' => 'Admin Dashboard',

    'menu_top' => [
        'home' => 'Home',
        'site' => 'Go to Site',
        'exit' => 'Logout',
    ],

    'menu_left' => [
        '_home' => 'Home',
        'home' => 'Home',
        'users' => 'View Users',
        'sender' => 'Mass Mailing',
        'settings' => 'Settings',

        '_transactions' => 'Transactions',
        'purchases' => 'Purchase History',
        'exchanges' => 'Exchanges History',
        'deposits' => 'Deposits History',
        'sales' => 'Sales History',
        'withdraws' => 'Withdraws History',

        '_sections' => 'Sections',
        'news' => 'News',
        'about' => 'About',
        'rules' => 'Rules',
        'contact' => 'Contact',

        'login' => 'Login',
    ],

    'error_messages' => [
        'accountBanned' => 'Account is blocked',
        'wrongLogin' => 'Username and / or Password is incorrect',
        'notfoundAccount' => 'The specified Username is not registered in the system',
        'usernameInUse' => 'The specified login is already in use',
        'passwordMatch' => 'Password and password repeat do not match',
        'emptyPassword' => 'Password is incorrect or empty',
        'emptyLogin' => 'Login incorrect or empty',
        'emailInvalid' => 'Email has an invalid format',
        'invalidData' => 'There were errors with the data you provided',
        'requestReset' => 'Your email or IP has already been sent a password in the last 15 minutes',
        'oldpassword' => 'Old password is incorrect',
        'noresults' => 'No results to show',
        'itemNotFound' => 'Item with such ID not found',
    ],

    'success_messages' => [
        'changesSaved' => 'Changes saved with success!',
        'deleted' => 'Item deleted with success!',
        'created' => 'Item created with success!',
        'cleaned' => 'Data cleaned with success!',
    ],

    'btn' => [
        'send' => 'Send',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'create' => 'Create',
        'cancel' => 'Cancel',
        'update' => 'Update',
        'login' => 'Login',
        'forgotL' => 'Reset Password',
        'forgot' => 'Send Reset Link',
        'save' => 'Save',
        'clear' => 'Clear',
        'search' => 'Search',
        'ban' => 'Ban',
        'unban' => 'Unban',
    ],

    'common' => [
        'email' => 'Email',
        'password' => 'Password',
        'password_old' => 'Old Password',
        'password_new' => 'New Password',
        'auth' => 'Authorization',
        'users' => 'Users',
        'days' => 'Days',
        'username' => 'Username',
        'copyright' => 'All rights reserved.',
        'referrer' => 'Inveted by',
        'p_balance' => 'Puchase Balance',
        'w_balance' => 'Withdraw Balance',
        'ref_earnings' => 'Earning from Referrals',
        'paid' => 'Total Paid',
        'resgetedOn' => 'Registration Date',
        'deposits' => 'Deposits',
        'withdraws' => 'Withdraws',
        'referrals' => 'Referrals',
        'date' => 'Date',
        'qtd' => 'Sum',
        'count' => 'Count',
        'wallet' => 'Wallet',
        'amount' => 'Amount',
        'name' => 'Name',
        'title' => 'Title',
        'content' => 'Content',
        'actions' => 'Actions',
        'status' => 'Status',
        'sold' => 'Sold',
        'gived' => 'Give',
        'received' => 'Received',
        'itemName' => 'Item',
        'price' => 'Price',
        'min' => 'Min.',
        'cost' => 'Cost',
        'yes' => 'Yes',
        'no' => 'No',
        'total' => 'Total',
        'perHour' => 'Per Hour',
        'totalCollected' => 'Total Collected',
        'confirmdelete' => 'Are you sure want to delete this item? This action can not be undone.',
    ],

    'login' => [
        'title' => 'Login',
        'requestSended' => 'Reset link was sent to Email',
        'resetSuccess' => 'Your password was changed with success, you can login into your account now.',
    ],

    'recovery' => [
        'title' => 'Password Recovery',
        'requestSended' => 'Reset link was sent to Email',
        'resetSuccess' => 'Your password was changed with success, you can login into your account now.',
    ],

    'settings' => [
        'title' => 'Settings',
        '_conversions' => 'Conversions',
        '_productions' => 'Productions',
        '_itemprices' => 'Item Prices',
        '_general' => 'General',
        'min_payout' => 'Min. Payment',
        'swapBonus' => 'Bonus Percent on Exchange',
        'sellPercent' => 'Percent to Withdraw on Sale',
        'adminLang' => 'Admin Language',
        'error_paymentMin' => 'The minimum payment amount can not be less than 0',
        'error_percentExt' => 'The percentage to be exchanged must be from 1 to 99',
        'error_percentOut' => '% of silver on the output at the sale should be from 1 to 99',
        'error_minfruits' => 'How many fruits = 1 silver, should be from 1 to 50,000',
        'error_productionMin' => 'Incorrect adjustment of the yield of trees per hour! Minimum 6',
        'error_itemprice' => 'The minimum value of a tree should not be less than 1 silver',
    ],

    'about' => [
        'title' => 'About Page',
        'content' => 'Page Content',
    ],

    'rules' => [
        'title' => 'Rules Page',
        'content' => 'Page Content',
    ],

    'contacts' => [
        'title' => 'Contacts Page',
        'content' => 'Page Content',
    ],

    'news' => [
        'title' => 'News',
        'list' => 'List News',
        'titleError' => 'The title can not be less than 3 characters',
    ],

    'payouts' => [
        'title' => 'Withdraw History',
        '_paid' => 'Paid',
        '_balance' => 'Balance on Payeer',
        '_daily' => 'Daily',
        '_month' => 'Last 30 Days',
        'payments' => 'Payments',
        'legend_graph1' => 'Payment History (Amount)',
        'footer_graph1' => 'Last 30 Days',
        'legend_graph2' => 'Payment History (Amount)',
        'footer_graph2' => 'Last 30 Days',
        'legend_graph3' => 'Payment History (Amount)',
        'footer_graph3' => 'Last 30 Days',
    ],

    'story_insert' => [
        'title' => 'Deposit History',
        '_list' => 'Deposits',
        '_daily' => 'Daily',
        '_month' => 'Last 30 Days',
        'deposits' => 'Deposits',
        'legend_graph1' => 'Deposit History (Amount)',
        'footer_graph1' => 'Last 30 Days',
        'legend_graph2' => 'Deposit History (Amount)',
        'footer_graph2' => 'Last 30 Days',
        'legend_graph3' => 'Deposit History (Amount)',
        'footer_graph3' => 'Last 30 Days',
    ],

    'story_sell' => [
        'title' => 'Sales of Coins',
    ],

    'story_swap' => [
        'title' => 'Exchange History',
    ],

    'story_buy' => [
        'title' => 'Purchase History',
    ],

    'sendermail' => [
        'title' => 'Mass Mailing',
        'list' => 'Mailing List',
        'add' => 'Add Newsletter',
        'sended' => 'Submitted',
        'status_send' => 'Sending',
        'status_ok' => 'Complete',
        'markers' => 'Markers for Replacement',
        'created' => 'Newsletter is queued for execution',
        'error_minContent' => 'Message must be longer than 10 characters',
        'error_minTitle' => 'The title must be greater than 3 characters',
    ],

    'users' => [
        'title' => 'Manage Users',
        'ref_earns' => 'Earn from Referrals',
        'ref_pays' => 'Brought a referrer',
        'lastLogin' => 'Last Login',
        'lastIP' => 'Last IP',
        'bannedStatus' => 'Banned',
        'addTo' => 'Add to Balance',
        'removeFrom' => 'Remove from Balance',
        'itemAdded' => 'Item added with success!',
        'balanceMinus' => 'Removed %s from user balance!',
        'balancePlus' => 'Added %s to user balance!',
        'banned' => 'This user was banned with success!',
        'unbanned' => 'This user was unbanned with success!',
    ],

    'dashboard' => [
        'title' => 'Dashboard',
        'total_users' => 'Registered Users',
        'bought' => 'Bought',
        'warehouses' => 'In Warehouses',
        'collected' => 'Total Collected',
        'profit' => 'Total Profit',
    ],
];