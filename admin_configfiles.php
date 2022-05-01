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

const AREA = 'admin';
require __DIR__ . '/lib/init.php';

use Froxlor\Config\ConfigParser;
use Froxlor\FileDir;
use Froxlor\Froxlor;
use Froxlor\Settings;
use Froxlor\UI\Panel\UI;
use Froxlor\UI\Request;
use Froxlor\UI\Response;

if ($userinfo['change_serversettings'] == '1') {
	if ($action == 'setconfigured') {
		Settings::Set('panel.is_configured', '1', true);
		Response::redirectTo('admin_configfiles.php');
	}

	// get distro from URL param
	$distribution = Request::get('distribution');

	// check for possible setting
	if (empty($distribution)) {
		$distribution = Settings::Get('system.distribution') ?? "";
	}

	$distributions_select = [];

	$services = [];
	$config_dir = FileDir::makeCorrectDir(Froxlor::getInstallDir() . '/lib/configfiles/');

	if (!empty($distribution)) {
		if (!file_exists($config_dir . '/' . $distribution . ".xml")) {
			Response::dynamicError("Unknown distribution");
		}

		// update setting if different
		if ($distribution != Settings::Get('system.distribution')) {
			Settings::Set('system.distribution', $distribution);
		}

		// create configparser object
		$configfiles = new ConfigParser($config_dir . '/' . $distribution . ".xml");

		// get distro-info
		$dist_display = $configfiles->getCompleteDistroName();

		// get all the services from the distro
		$services = $configfiles->getServices();
	} else {
		// show list of available distro's
		$distros = glob($config_dir . '*.xml');
		// read in all the distros
		foreach ($distros as $_distribution) {
			// get configparser object
			$dist = new ConfigParser($_distribution);
			// store in tmp array
			$distributions_select[str_replace(".xml", "", strtolower(basename($_distribution)))] = $dist->getCompleteDistroName();
		}

		// sort by distribution name
		asort($distributions_select);
	}

	if ($distribution != "" && isset($_POST['finish'])) {
		unset($_POST['finish']);
		$params = $_POST;
		$params['distro'] = $distribution;
		$params['system'] = [];
		foreach ($_POST['system'] as $sysdaemon) {
			$params['system'][] = $sysdaemon;
		}
		$params_content = json_encode($params);
		$params_filename = FileDir::makeCorrectFile(Froxlor::getInstallDir() . 'install/' . Froxlor::genSessionId() . '.json');
		file_put_contents($params_filename, $params_content);

		UI::twigBuffer('settings/configuration-final.html.twig', [
			'distribution' => $distribution,
			// alert
			'type' => 'info',
			'alert_msg' => lng('admin.configfiles.finishnote'),
			'basedir' => Froxlor::getInstallDir(),
			'params_filename' => $params_filename
		]);
	} else {
		if (!empty($distribution)) {
			// show available services to configure
			$fields = $services;
			$link_params = ['section' => 'configfiles', 'distribution' => $distribution];
			UI::twigBuffer('settings/configuration.html.twig', [
				'action' => $linker->getLink($link_params),
				'fields' => $fields,
				'distribution' => $distribution
			]);
		} else {
			// @fixme check set distribution from settings

			$cfg_formfield = [
				'config' => [
					'title' => lng('admin.configfiles.serverconfiguration'),
					'image' => 'fa-solid fa-wrench',
					'description' => lng('admin.configfiles.description'),
					'sections' => [
						'section_config' => [
							'fields' => [
								'distribution' => [
									'type' => 'select',
									'select_var' => $distributions_select,
									'label' => lng('admin.configfiles.distribution')
								]
							]
						]
					],
					'buttons' => [
						[
							'class' => 'btn-outline-secondary',
							'label' => lng('panel.cancel'),
							'type' => 'reset'
						],
						[
							'label' => lng('update.proceed')
						]
					]
				]
			];

			UI::twigBuffer('user/form-note.html.twig', [
				'formaction' => $linker->getLink(['section' => 'configfiles']),
				'formdata' => $cfg_formfield['config'],
				'actions_links' => (int)Settings::Get('panel.is_configured') == 0 ? [
					[
						'href' => $linker->getLink([
							'section' => 'configfiles',
							'page' => 'overview',
							'action' => 'setconfigured'
						]),
						'label' => lng('panel.ihave_configured'),
						'class' => 'btn-outline-warning',
						'icon' => 'fa fa-circle-check'
					]
				] : [],
				// alert
				'type' => 'warning',
				'alert_msg' => lng('panel.settings_before_configuration') . ((int)Settings::Get('panel.is_configured') == 1 ? '<br><br>' . lng('panel.system_is_configured') : '')
			]);
		}
	}

	UI::twigOutputBuffer();
} else {
	Response::redirectTo('admin_index.php');
}
