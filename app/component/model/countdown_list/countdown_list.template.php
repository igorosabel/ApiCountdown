<?php
use OsumiFramework\App\Component\Model\CountdownComponent;

foreach ($values['list'] as $i => $countdown) {
  $component = new CountdownComponent([ 'countdown' => $countdown ]);
	echo strval($component);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
