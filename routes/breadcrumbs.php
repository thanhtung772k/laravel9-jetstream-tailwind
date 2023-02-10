<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('lang.home'), route('dashboard'));
});

// Home > Timesheet
Breadcrumbs::for('timesheet', function ($trail) {
    $trail->parent('home');
    $trail->push(__('lang.timesheets'), route('dashboard'));
});

// Home > Timesheet >List
Breadcrumbs::for('timesheet-list', function ($trail) {
    $trail->parent('timesheet');
    $trail->push(__('lang.list_timesheets'), route('dashboard'));
});

// Home > Timesheet >management
Breadcrumbs::for('timesheet-management', function ($trail) {
    $trail->parent('home');
    $trail->push(__('management'), route('management'));
});

// Home >management > Detail
Breadcrumbs::for('timesheet-detail', function ($trail) {
    $trail->parent('timesheet-management');
    $trail->push(__('detail'), route('management'));
});

// Home > Additional Timesheet
Breadcrumbs::for('add_timesheet', function ($trail) {
    $trail->parent('home');
    $trail->push(__('lang.add_timesheet'), route('get_create_addtimesheet'));
});

// Home > Additional Timesheet > create
Breadcrumbs::for('add_timesheet-create', function ($trail) {
    $trail->parent('add_timesheet');
    $trail->push(__('lang.create'), route('get_addtimesheet'));
});

// Home > Additional Timesheet > list
Breadcrumbs::for('add_timesheet-list', function ($trail) {
    $trail->parent('add_timesheet');
    $trail->push(__('lang.list_create'), route('get_create_addtimesheet'));
});

// Home > Additional Timesheet > detail
Breadcrumbs::for('add_timesheet-detail', function ($trail) {
    $trail->parent('add_timesheet');
    $trail->push(__('lang.detail'), route('get_create_addtimesheet'));
});

// Home > Additional Timesheet > update
Breadcrumbs::for('add_timesheet-update', function ($trail) {
    $trail->parent('add_timesheet');
    $trail->push(__('lang.update'), route('get_create_addtimesheet'));
});

// Home > Additional Timesheet > Waiting list for approval
Breadcrumbs::for('add_timesheet-waiting_list', function ($trail) {
    $trail->parent('add_timesheet');
    $trail->push(__('lang.waiting_list'), route('get_create_addtimesheet'));
});

// Home > Additional Project
Breadcrumbs::for('add_project', function ($trail) {
    $trail->parent('home');
    $trail->push(__('lang.add_project'), route('get_project'));
});

// Home > Additional Project > List
Breadcrumbs::for('project-list', function ($trail) {
    $trail->parent('add_project');
    $trail->push(__('lang.project_list'), route('create_project'));
});

// Home > Additional Project > List
Breadcrumbs::for('project-detail', function ($trail) {
    $trail->parent('add_project');
    $trail->push(__('lang.detail'), route('create_project'));
});

// Home > Additional Project > Create
Breadcrumbs::for('project-create', function ($trail) {
    $trail->parent('add_project');
    $trail->push(__('lang.create'), route('create_project'));
});

// Home > Additional Project > Update
Breadcrumbs::for('project-update', function ($trail) {
    $trail->parent('add_project');
    $trail->push(__('lang.update'), route('create_project'));
});

// Home > User Management
Breadcrumbs::for('user', function ($trail) {
    $trail->parent('home');
    $trail->push(__('lang.user_management'), route('index_user'));
});

// Home > User Management > List
Breadcrumbs::for('user-list', function ($trail) {
    $trail->parent('user');
    $trail->push(__('lang.list'), route('create_project'));
});

// Home > User Management > Create
Breadcrumbs::for('user-create', function ($trail) {
    $trail->parent('user');
    $trail->push(__('lang.create'), route('create_project'));
});

// Home > User Management > Edit
Breadcrumbs::for('user-edit', function ($trail) {
    $trail->parent('user');
    $trail->push(__('lang.edit'), route('create_project'));
});
