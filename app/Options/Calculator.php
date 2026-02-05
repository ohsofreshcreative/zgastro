<?php

namespace App\Options;

use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Calculator extends Field
{
    public $name = 'Kalkulator Catering';
    public $title = 'Ustawienia Kalkulatora Catering | Opcje';

    public function fields()
    {
        $calculator = new FieldsBuilder('calculator_catering_settings');

        $calculator
            // === ZUPY ===
            ->addTab('Zupy')
                ->addNumber('soup_price', [
                    'label' => 'Cena zupy za osobę',
                    'default_value' => 15,
                    'prepend' => 'zł',
                ])
                ->addNumber('soup_min_portions', [
                    'label' => 'Minimalna liczba porcji tej samej zupy',
                    'default_value' => 15,
                ])
                ->addRepeater('soups', [
                    'label' => 'Rodzaje zup',
                    'button_label' => 'Dodaj zupę',
                    'layout' => 'table'
                ])
                    ->addText('name', ['label' => 'Nazwa zupy'])
                    ->addTrueFalse('popular', [
                        'label' => 'Popularna?',
                        'ui' => 1,
                        'default_value' => 0
                    ])
                ->endRepeater()
                ->addTextarea('soup_hint', [
                    'label' => 'Podpowiedź dla klienta',
                    'default_value' => 'Najczęściej wybierane: rosół, krem z pomidorów',
                    'rows' => 2
                ])

            // === DANIA GŁÓWNE ===
            ->addTab('Dania główne')
                ->addNumber('main_dish_price', [
                    'label' => 'Cena dania głównego za osobę',
                    'default_value' => 40,
                    'prepend' => 'zł',
                ])
                ->addNumber('main_dish_child_price', [
                    'label' => 'Cena porcji dziecięcej',
                    'default_value' => 29,
                    'prepend' => 'zł',
                ])
                ->addNumber('main_dish_min_portions', [
                    'label' => 'Minimalna liczba porcji tej samej kompozycji',
                    'default_value' => 15,
                ])
                ->addRepeater('meats', [
                    'label' => 'Mięsa/Ryby/Wege',
                    'button_label' => 'Dodaj opcję',
                    'layout' => 'table'
                ])
                    ->addText('name', ['label' => 'Nazwa'])
                ->endRepeater()
                ->addRepeater('sides', [
                    'label' => 'Dodatki skrobiowe',
                    'button_label' => 'Dodaj dodatek',
                    'layout' => 'table'
                ])
                    ->addText('name', ['label' => 'Nazwa'])
                ->endRepeater()
                ->addRepeater('vegetables', [
                    'label' => 'Surówki/Warzywa',
                    'button_label' => 'Dodaj surówkę',
                    'layout' => 'table'
                ])
                    ->addText('name', ['label' => 'Nazwa'])
                ->endRepeater()
                ->addTextarea('main_dish_hint', [
                    'label' => 'Podpowiedź dla klienta',
                    'default_value' => 'Serwowane samodzielnie lub przez obsługę – wybierz poniżej',
                    'rows' => 2
                ])

            // === ZAKĄSKI ===
            ->addTab('Zakąski')
                ->addNumber('appetizer_price', [
                    'label' => 'Cena zakąsek za osobę',
                    'default_value' => 110,
                    'prepend' => 'zł',
                ])
                ->addText('appetizer_rule', [
                    'label' => 'Zasada półmisków',
                    'default_value' => '1 półmisek na każde 15 osób',
                ])
                ->addRepeater('appetizers', [
                    'label' => 'Półmiski zakąsek (16 opcji)',
                    'button_label' => 'Dodaj półmisek',
                    'layout' => 'table'
                ])
                    ->addText('name', ['label' => 'Nazwa półmisku'])
                ->endRepeater()
                ->addTextarea('appetizer_hint', [
                    'label' => 'Podpowiedź dla klienta',
                    'default_value' => 'Sprawdza się na początek spotkania lub jako uzupełnienie',
                    'rows' => 2
                ])

            // === DESERY ===
            ->addTab('Na słodko')
                ->addNumber('dessert_price', [
                    'label' => 'Cena deserów za osobę',
                    'default_value' => 20,
                    'prepend' => 'zł',
                ])
                ->addNumber('dessert_max_choices', [
                    'label' => 'Maksymalna liczba wyborów',
                    'default_value' => 3,
                ])
                ->addRepeater('desserts', [
                    'label' => 'Ciasta/Desery (5 propozycji)',
                    'button_label' => 'Dodaj deser',
                    'layout' => 'table'
                ])
                    ->addText('name', ['label' => 'Nazwa'])
                ->endRepeater()

            // === OBSŁUGA ===
            ->addTab('Obsługa')
                ->addGroup('waiter_service', ['label' => 'Obsługa kelnerska'])
                    ->addNumber('base_price', [
                        'label' => 'Cena bazowa (do 15 gości, 4h)',
                        'default_value' => 500,
                        'prepend' => 'zł',
                    ])
                    ->addNumber('additional_15_guests', [
                        'label' => 'Dopłata za każde kolejne 15 osób',
                        'default_value' => 500,
                        'prepend' => 'zł',
                    ])
                    ->addNumber('additional_hour', [
                        'label' => 'Dopłata za każdą dodatkową godzinę/kelner',
                        'default_value' => 100,
                        'prepend' => 'zł',
                    ])
                ->endGroup()

                ->addGroup('live_cooking', ['label' => 'Live cooking'])
                    ->addNumber('base_price', [
                        'label' => 'Cena bazowa (do 15 gości)',
                        'default_value' => 1000,
                        'prepend' => 'zł',
                    ])
                    ->addNumber('additional_15_guests', [
                        'label' => 'Dopłata za każde kolejne 15 osób',
                        'default_value' => 500,
                        'prepend' => 'zł',
                    ])
                    ->addRepeater('dishes', [
                        'label' => 'Dania do wyboru (5 opcji)',
                        'button_label' => 'Dodaj danie',
                        'layout' => 'table'
                    ])
                        ->addText('name', ['label' => 'Nazwa dania'])
                    ->endRepeater()
                ->endGroup()

                ->addGroup('chef_service', ['label' => 'Serwowanie przez kucharzy'])
                    ->addNumber('base_price', [
                        'label' => 'Cena bazowa (do 15 gości)',
                        'default_value' => 1000,
                        'prepend' => 'zł',
                    ])
                    ->addNumber('additional_15_guests', [
                        'label' => 'Dopłata za każde kolejne 15 osób',
                        'default_value' => 500,
                        'prepend' => 'zł',
                    ])
                ->endGroup()

                ->addNumber('hot_buffet_price', [
                    'label' => 'Bufet ciepły (ryczałt)',
                    'default_value' => 300,
                    'prepend' => 'zł',
                ])

            // === NAPOJE ===
            ->addTab('Napoje')
                ->addNumber('coffee_buffet_price', [
                    'label' => 'Bufet kawowy za osobę',
                    'default_value' => 10,
                    'prepend' => 'zł',
                ])
                ->addText('coffee_buffet_content', [
                    'label' => 'Zawartość bufetu kawowego',
                    'default_value' => 'Kawa z ekspresu, Herbata, cytryna, mleko, warnik',
                ])
                ->addNumber('drinks_price', [
                    'label' => 'Napoje za osobę',
                    'default_value' => 15,
                    'prepend' => 'zł',
                ])
                ->addText('drinks_content', [
                    'label' => 'Zawartość pakietu napojów',
                    'default_value' => 'Woda z cytryną i miętą, Soki owocowe, Napoje gazowane',
                ])

            // === KOMUNIKATY ===
            ->addTab('Komunikaty')
                ->addTextarea('min_portions_message', [
                    'label' => 'Komunikat o minimalnych porcjach',
                    'default_value' => 'Minimalna liczba porcji to 15. Dla mniejszych zamówień skontaktujemy się w sprawie indywidualnej wyceny.',
                    'rows' => 3
                ])
                ->addTextarea('equipment_note', [
                    'label' => 'Informacja o zastawie',
                    'default_value' => 'Koszt zastawy stołowej, naczyń i sprzętu (np. podgrzewaczy) ustalamy indywidualnie – zaznacz, jeśli potrzebujesz, a skontaktujemy się z wyceną.',
                    'rows' => 3
                ]);

        return $calculator->build();
    }
}