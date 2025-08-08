<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Offer extends Field
{
	public function fields(): array
	{
		$offer = new FieldsBuilder('offer');

		$offer
			->setLocation('options_page', '==', 'offer')
			->addRepeater('offer', [
				'label' => 'Oferta',
				'layout' => 'table',
				'min' => 1,
				'button_label' => 'Dodaj element oferty',
				'collapsed' => 'offer_title',
			])
			->addImage('offer_image', [
				'label' => 'Obraz',
				'return_format' => 'array',
				'preview_size' => 'small',
				'wrapper' => [
					'width' => '20',
				],
			])
			->addText('offer_title', [
				'label' => 'Nagłówek cechy',
				'wrapper' => [
					'width' => '20',
				],
			])
			->addTextarea('offer_description', [
				'label' => 'Opis cechy',
			])
			->addLink('cta', [
				'label' => 'Link CTA',
				'return_format' => 'array',
			])
			->endRepeater();

		return [$offer];
	}
}
