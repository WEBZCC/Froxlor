<?php

/**
 * This file is part of the Froxlor project.
 * Copyright (c) 2010 the Froxlor Team (see authors).
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, you can also view it online at
 * https://files.froxlor.org/misc/COPYING.txt
 *
 * @copyright  the authors
 * @author     Froxlor team <team@froxlor.org>
 * @license    https://files.froxlor.org/misc/COPYING.txt GPLv2
 */

use Froxlor\Language;
use Froxlor\Settings;
use Froxlor\System\Crypt;

return [
	'admin_edit' => [
		'title' => lng('admin.admin_edit'),
		'image' => 'fa-solid fa-user-pen',
		'self_overview' => ['section' => 'admins', 'page' => 'admins'],
		'sections' => [
			'section_a' => [
				'title' => lng('admin.accountdata'),
				'image' => 'icons/user_edit.png',
				'fields' => [
					'loginname' => [
						'label' => lng('login.username'),
						'type' => 'label',
						'value' => $result['loginname']
					],
					'deactivated' => [
						'label' => lng('admin.deactivated_user'),
						'type' => 'checkbox',
						'value' => '1',
						'checked' => $result['deactivated'],
						'visible' => $result['adminid'] != $userinfo['userid']
					],
					'admin_password' => [
						'label' => lng('login.password') . '&nbsp;(' . lng('panel.emptyfornochanges') . ')',
						'type' => 'password',
						'autocomplete' => 'off',
						'visible' => $result['adminid'] != $userinfo['userid'],
						'next_to' => [
							'admin_password_suggestion' => [
								'next_to_prefix' => lng('customer.generated_pwd') . ':',
								'type' => 'text',
								'visible' => (Settings::Get('panel.password_regex') == '' && !($result['adminid'] == $userinfo['userid'])),
								'value' => Crypt::generatePassword(),
								'readonly' => true
							]
						]
					],
					'def_language' => [
						'label' => lng('login.language'),
						'type' => 'select',
						'select_var' => Language::getLanguages(),
						'selected' => $result['def_language'],
						'visible' => $result['adminid'] != $userinfo['userid']
					],
					'api_allowed' => [
						'label' => lng('usersettings.api_allowed.title'),
						'desc' => lng('usersettings.api_allowed.description'),
						'type' => 'checkbox',
						'value' => '1',
						'checked' => $result['api_allowed'],
						'visible' => Settings::Get('api.enabled') == '1'
					]
				]
			],
			'section_b' => [
				'title' => lng('admin.contactdata'),
				'image' => 'icons/user_edit.png',
				'fields' => [
					'name' => [
						'label' => lng('customer.name'),
						'type' => 'text',
						'mandatory' => true,
						'value' => $result['name']
					],
					'email' => [
						'label' => lng('customer.email'),
						'type' => 'text',
						'mandatory' => true,
						'value' => $result['email']
					],
					'custom_notes' => [
						'label' => lng('usersettings.custom_notes.title'),
						'desc' => lng('usersettings.custom_notes.description'),
						'type' => 'textarea',
						'cols' => 60,
						'rows' => 12,
						'value' => $result['custom_notes']
					],
					'custom_notes_show' => [
						'label' => lng('usersettings.custom_notes.show'),
						'type' => 'checkbox',
						'value' => '1',
						'checked' => $result['custom_notes_show']
					]
				]
			],
			'section_c' => [
				'title' => lng('admin.servicedata'),
				'image' => 'icons/user_add.png',
				'visible' => $result['adminid'] != $userinfo['userid'],
				'fields' => [
					'ipaddress' => [
						'label' => lng('serversettings.ipaddress.title'),
						'type' => 'select',
						'select_var' => $ipaddress,
						'selected' => $result['ip']
					],
					'change_serversettings' => [
						'label' => lng('admin.change_serversettings'),
						'type' => 'checkbox',
						'value' => '1',
						'checked' => $result['change_serversettings']
					],
					'customers' => [
						'label' => lng('admin.customers'),
						'type' => 'textul',
						'value' => $result['customers'],
						'maxlength' => 9,
						'mandatory' => true
					],
					'customers_see_all' => [
						'label' => lng('admin.customers_see_all'),
						'type' => 'checkbox',
						'value' => '1',
						'checked' => $result['customers_see_all']
					],
					'domains' => [
						'label' => lng('admin.domains'),
						'type' => 'textul',
						'value' => $result['domains'],
						'maxlength' => 9,
						'mandatory' => true
					],
					'domains_see_all' => [
						'label' => lng('admin.domains_see_all'),
						'type' => 'checkbox',
						'value' => '1',
						'checked' => $result['domains_see_all']
					],
					'caneditphpsettings' => [
						'label' => lng('admin.caneditphpsettings'),
						'type' => 'checkbox',
						'value' => '1',
						'checked' => $result['caneditphpsettings']
					],
					'diskspace' => [
						'label' => lng('customer.diskspace') . ' (' . lng('customer.mib') . ')',
						'type' => 'textul',
						'value' => $result['diskspace'],
						'maxlength' => 6,
						'mandatory' => true
					],
					'traffic' => [
						'label' => lng('customer.traffic') . ' (' . lng('customer.gib') . ')',
						'type' => 'textul',
						'value' => $result['traffic'],
						'maxlength' => 4,
						'mandatory' => true
					],
					'subdomains' => [
						'label' => lng('customer.subdomains'),
						'type' => 'textul',
						'value' => $result['subdomains'],
						'maxlength' => 9,
						'mandatory' => true
					],
					'emails' => [
						'label' => lng('customer.emails'),
						'type' => 'textul',
						'value' => $result['emails'],
						'maxlength' => 9,
						'mandatory' => true
					],
					'email_accounts' => [
						'label' => lng('customer.accounts'),
						'type' => 'textul',
						'value' => $result['email_accounts'],
						'maxlength' => 9,
						'mandatory' => true
					],
					'email_forwarders' => [
						'label' => lng('customer.forwarders'),
						'type' => 'textul',
						'value' => $result['email_forwarders'],
						'maxlength' => 9,
						'mandatory' => true
					],
					'email_quota' => [
						'label' => lng('customer.email_quota') . ' (' . lng('customer.mib') . ')',
						'type' => 'textul',
						'value' => $result['email_quota'],
						'maxlength' => 9,
						'visible' => Settings::Get('system.mail_quota_enabled') == '1',
						'mandatory' => true
					],
					'ftps' => [
						'label' => lng('customer.ftps'),
						'type' => 'textul',
						'value' => $result['ftps'],
						'maxlength' => 9
					],
					'mysqls' => [
						'label' => lng('customer.mysqls'),
						'type' => 'textul',
						'value' => $result['mysqls'],
						'maxlength' => 9,
						'mandatory' => true
					]
				]
			]
		]
	]
];
