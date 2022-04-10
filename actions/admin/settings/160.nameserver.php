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
 * @package    Settings
 *
 */
return array(
	'groups' => array(
		'nameserver' => array(
			'title' => $lng['admin']['nameserversettings'],
			'icon' => 'fa-solid fa-globe',
			'fields' => array(
				'nameserver_enable' => array(
					'label' => $lng['serversettings']['bindenable'],
					'settinggroup' => 'system',
					'varname' => 'bind_enable',
					'type' => 'checkbox',
					'default' => true,
					'save_method' => 'storeSettingField',
					'overview_option' => true
				),
				'system_dnsenabled' => array(
					'label' => $lng['serversettings']['dnseditorenable'],
					'settinggroup' => 'system',
					'varname' => 'dnsenabled',
					'type' => 'checkbox',
					'default' => false,
					'save_method' => 'storeSettingField'
				),
				'system_dns_server' => array(
					'label' => $lng['serversettings']['dns_server'],
					'settinggroup' => 'system',
					'varname' => 'dns_server',
					'type' => 'select',
					'default' => 'Bind',
					'select_var' => array(
						'Bind' => 'Bind9',
						'PowerDNS' => 'PowerDNS'
					),
					'save_method' => 'storeSettingField'
				),
				'system_bindconf_directory' => array(
					'label' => $lng['serversettings']['bindconf_directory'],
					'settinggroup' => 'system',
					'varname' => 'bindconf_directory',
					'type' => 'text',
					'string_type' => 'dir',
					'default' => '/etc/bind/',
					'save_method' => 'storeSettingField'
				),
				'system_bindreload_command' => array(
					'label' => $lng['serversettings']['bindreload_command'],
					'settinggroup' => 'system',
					'varname' => 'bindreload_command',
					'type' => 'text',
					'default' => '/etc/init.d/bind9 reload',
					'save_method' => 'storeSettingField'
				),
				'system_nameservers' => array(
					'label' => $lng['serversettings']['nameservers'],
					'settinggroup' => 'system',
					'varname' => 'nameservers',
					'type' => 'text',
					'string_regexp' => '/^(([a-z0-9\-\._]+, ?)*[a-z0-9\-\._]+)?$/i',
					'string_emptyallowed' => true,
					'default' => '',
					'save_method' => 'storeSettingFieldInsertBindTask'
				),
				'system_mxservers' => array(
					'label' => $lng['serversettings']['mxservers'],
					'settinggroup' => 'system',
					'varname' => 'mxservers',
					'type' => 'text',
					'string_regexp' => '/^(([0-9]+ [a-z0-9\-\._]+, ?)*[0-9]+ [a-z0-9\-\._]+)?$/i',
					'string_emptyallowed' => true,
					'default' => '',
					'save_method' => 'storeSettingField'
				),
				'system_axfrservers' => array(
					'label' => $lng['serversettings']['axfrservers'],
					'settinggroup' => 'system',
					'varname' => 'axfrservers',
					'type' => 'text',
					'string_type' => 'validate_ip_incl_private',
					'string_delimiter' => ',',
					'string_emptyallowed' => true,
					'default' => '',
					'save_method' => 'storeSettingField'
				),
				'system_powerdns_mode' => array(
					'label' => $lng['serversettings']['powerdns_mode'],
					'settinggroup' => 'system',
					'varname' => 'powerdns_mode',
					'type' => 'select',
					'default' => 'Native',
					'select_var' => array(
						'Native' => 'Native',
						'Master' => 'Master'
					),
					'save_method' => 'storeSettingField',
					'advanced_mode' => true
				),
				'system_dns_createmailentry' => array(
					'label' => $lng['serversettings']['mail_also_with_mxservers'],
					'settinggroup' => 'system',
					'varname' => 'dns_createmailentry',
					'type' => 'checkbox',
					'default' => false,
					'save_method' => 'storeSettingField'
				),
				'system_dns_createcaaentry' => array(
					'label' => $lng['serversettings']['caa_entry'],
					'settinggroup' => 'system',
					'varname' => 'dns_createcaaentry',
					'type' => 'checkbox',
					'default' => true,
					'save_method' => 'storeSettingField',
					'advanced_mode' => true
				),
				'caa_caa_entry' => array(
					'label' => $lng['serversettings']['caa_entry_custom'],
					'settinggroup' => 'caa',
					'varname' => 'caa_entry',
					'type' => 'textarea',
					'default' => '',
					'save_method' => 'storeSettingField',
					'advanced_mode' => true
				),
				'system_defaultttl' => array(
					'label' => $lng['serversettings']['defaultttl'],
					'settinggroup' => 'system',
					'varname' => 'defaultttl',
					'type' => 'number',
					'default' => 604800, /* 1 week */
					'min' => 3600, /* 1 hour */
					'max' => 2147483647, /* integer max */
					'save_method' => 'storeSettingField'
				),
				'system_soaemail' => array(
					'label' => $lng['serversettings']['soaemail'],
					'settinggroup' => 'system',
					'varname' => 'soaemail',
					'type' => 'email',
					'string_emptyallowed' => true,
					'default' => '',
					'save_method' => 'storeSettingField'
				)
			)
		)
	)
);
