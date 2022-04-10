<?php

/**
 * This file is part of the Froxlor project.
 * Copyright (c) 2003-2009 the SysCP Team (see authors).
 * Copyright (c) 2010 the Froxlor Team (see authors).
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code. You can also view the
 * COPYING file online at http://files.froxlor.org/misc/COPYING.txt
 *
 * @copyright  (c) the authors
 * @author     Florian Lippert <flo@syscp.org> (2003-2009)
 * @author     Froxlor team <team@froxlor.org> (2010-)
 * @license    GPLv2 http://files.froxlor.org/misc/COPYING.txt
 * @package    \Froxlor\Settings
 *
 */
return array(
	'groups' => array(
		'dkim' => array(
			'title' => $lng['admin']['dkimsettings'],
			'icon' => 'fa-solid fa-fingerprint',
			'fields' => array(
				'dkim_enabled' => array(
					'label' => $lng['dkim']['use_dkim'],
					'settinggroup' => 'dkim',
					'varname' => 'use_dkim',
					'type' => 'checkbox',
					'default' => false,
					'save_method' => 'storeSettingFieldInsertBindTask',
					'overview_option' => true
				),
				'dkim_prefix' => array(
					'label' => $lng['dkim']['dkim_prefix'],
					'settinggroup' => 'dkim',
					'varname' => 'dkim_prefix',
					'type' => 'text',
					'string_type' => 'dir',
					'default' => '/etc/postfix/dkim/',
					'save_method' => 'storeSettingField'
				),
				'dkim_privkeysuffix' => array(
					'label' => $lng['dkim']['privkeysuffix'],
					'settinggroup' => 'dkim',
					'varname' => 'privkeysuffix',
					'type' => 'text',
					'string_regexp' => '/^[a-z0-9\._]+$/i',
					'default' => '.priv',
					'save_method' => 'storeSettingField',
					'advanced_mode' => true
				),
				'dkim_domains' => array(
					'label' => $lng['dkim']['dkim_domains'],
					'settinggroup' => 'dkim',
					'varname' => 'dkim_domains',
					'type' => 'text',
					'string_regexp' => '/^[a-z0-9\._]+$/i',
					'default' => 'domains',
					'save_method' => 'storeSettingField'
				),
				'dkim_dkimkeys' => array(
					'label' => $lng['dkim']['dkim_dkimkeys'],
					'settinggroup' => 'dkim',
					'varname' => 'dkim_dkimkeys',
					'type' => 'text',
					'string_regexp' => '/^[a-z0-9\._]+$/i',
					'default' => 'dkim-keys.conf',
					'save_method' => 'storeSettingField'
				),
				'dkim_algorithm' => array(
					'label' => $lng['dkim']['dkim_algorithm'],
					'settinggroup' => 'dkim',
					'varname' => 'dkim_algorithm',
					'type' => 'select',
					'default' => 'all',
					'select_mode' => 'multiple',
					'select_var' => array(
						'all' => 'All',
						'sha1' => 'SHA1',
						'sha256' => 'SHA256'
					),
					'save_method' => 'storeSettingFieldInsertBindTask',
					'advanced_mode' => true
				),
				'dkim_servicetype' => array(
					'label' => $lng['dkim']['dkim_servicetype'],
					'settinggroup' => 'dkim',
					'varname' => 'dkim_servicetype',
					'type' => 'select',
					'default' => '0',
					'select_var' => array(
						'0' => 'All',
						'1' => 'E-Mail'
					),
					'save_method' => 'storeSettingFieldInsertBindTask',
					'advanced_mode' => true
				),
				'dkim_keylength' => array(
					'label' => array(
						'title' => $lng['dkim']['dkim_keylength']['title'],
						'description' => sprintf($lng['dkim']['dkim_keylength']['description'], \Froxlor\Settings::Get('dkim.dkim_prefix'))
					),
					'settinggroup' => 'dkim',
					'varname' => 'dkim_keylength',
					'type' => 'select',
					'default' => '1024',
					'select_var' => array(
						'1024' => '1024 Bit',
						'2048' => '2048 Bit'
					),
					'save_method' => 'storeSettingFieldInsertBindTask'
				),
				'dkim_notes' => array(
					'label' => $lng['dkim']['dkim_notes'],
					'settinggroup' => 'dkim',
					'varname' => 'dkim_notes',
					'type' => 'text',
					'string_regexp' => '/^[a-z0-9\._]+$/i',
					'default' => '',
					'save_method' => 'storeSettingFieldInsertBindTask',
					'advanced_mode' => true
				),
				'dkimrestart_command' => array(
					'label' => $lng['dkim']['dkimrestart_command'],
					'settinggroup' => 'dkim',
					'varname' => 'dkimrestart_command',
					'type' => 'text',
					'default' => '/etc/init.d/dkim-filter restart',
					'save_method' => 'storeSettingField'
				)
			)
		)
	)
);
