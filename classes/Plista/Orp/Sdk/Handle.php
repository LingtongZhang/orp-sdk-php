<?php
namespace Plista\Orp\Sdk;

interface Handle {

	public function validate($body);
	public function handle($body);

}