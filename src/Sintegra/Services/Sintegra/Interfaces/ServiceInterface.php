<?php namespace zServices\Sintegra\Services\Sintegra\Interfaces;

interface ServiceInterface {

	/**
	 * [search description]
	 * @return [type] [description]
	 */
	public function captcha();

	/**
	 * [cookie description]
	 * @return [type] [description]
	 */
	public function cookie();

	/**
	 * [data description]
	 * @return [type] [description]
	 */
	public function data($document, $cookie, $captcha, array $params = []);
}